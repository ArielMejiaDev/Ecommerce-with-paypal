<?php namespace App\Services;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\ItemList;
use PayPal\Api\InputFields;
use PayPal\Api\WebProfile;
use PayPal\Api\Amount;
use PayPal\Api\Item;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use URL;
use Session;


class PayPalService
{

    private $apiContext;
    private $payer;
    private $itemList;
    private $inputFields;
    private $webProfile;
    private $createProfile;
    private $amount;
    private $transaction;
    private $redirectURLs;
    private $payment;

    public $redirectSuccessAction;
    public $redirectFailAction;


    public function __construct()
    {
        $this->apiContext = new ApiContext(new OAuthTokenCredential(
                config('paypal.client_id'),
                config('paypal.secret'))
        );
        $this->apiContext->setConfig(config('paypal.settings'));
        $this->setPayer();
    }

    public function setPayer($platform = 'paypal')
    {
        $this->payer = new Payer();
        $this->payer->setPaymentMethod($platform);
        return $this;
    }

    public function addItems(iterable $items, $total, $currency = null)//el iterable cubre un array de arrays una collection de arrays o una colleciton de modelos o un array de modelos
    {
        $this->payer = new Payer();
        $this->payer->setPaymentMethod('paypal');
        # We get all the items from the cart and parse the array into the Item object
        $items = [];

        foreach (Cart::content() as $item) {
            $items[] = (new Item())
                ->setName($item->name)
                ->setCurrency('USD')
                ->setQuantity($item->qty)
                ->setPrice($item->price);
        }

        $this->itemList = new ItemList();
        $this->itemList->setItems($items);
        $this->setIrrelevantAspectsForPayment();
        $this->addAmount($total, $currency);
        return $this;
    }

    public function setIrrelevantAspectsForPayment()
    {
        $this->inputFields = new InputFields();
        $this->inputFields->setAllowNote(true)->setNoShipping(1)->setAddressOverride(0);
        $this->webProfile = new WebProfile();
        $this->webProfile->setName(uniqid())->setInputFields($this->inputFields)->setTemporary(true);
        $this->createProfile = $this->webProfile->create($this->apiContext);
    }

    public function addAmount($total, $currency = 'USD')
    {
        $this->amount = new Amount();
        $this->amount->setCurrency($currency)->setTotal(Cart::subtotal());
    }

    public function setTransaction()
    {
        $this->transaction = new Transaction();
        $this->transaction->setAmount($this->amount);
        $this->transaction->setItemList($this->itemList)->setDescription('Your transaction description');
    }

    public function setUrls()
    {
        $this->redirectURLs = new RedirectUrls();
        $this->redirectURLs->setReturnUrl(URL::to('status'))->setCancelUrl(URL::to('status'));
    }

    public function setPayment()
    {
        $this->payment = new Payment();
        $this->payment->setIntent('Sale')->setPayer($this->payer)->setRedirectUrls($this->redirectURLs)->setTransactions(array($this->transaction));
        $this->payment->setExperienceProfileId($this->createProfile->getId());
        $this->payment->create($this->apiContext);
    }


    public function pay()
    {
        $this->setTransaction();
        $this->setUrls();
        $this->setPayment();

        foreach ($this->payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirectURL = $link->getHref();
                break;
            }
        }
        
        Session::put('paypalPaymentId', $this->payment->getId());

        return $this->redirectToGateway($redirectURL);
    }

    public function redirectToGateway($redirectURL)
    {
        if (isset($redirectURL)) {
            return redirect()->to($redirectURL);//este helper no se modifica ya que es el que arma la url a la que se va dirijir la app
        }

        return $this->redirectFailAction;

    }

}