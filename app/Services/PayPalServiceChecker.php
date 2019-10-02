<?php namespace App\Services;

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PayPalServiceChecker 
{
    private $apiContext;
    public  $result;
    public  $total_transaction;
    public  $currency_transaction;
    public  $payer;
    public  $payment_id;
    public  $approvedAction;
    public  $failAction;

    public function __construct()
    {
        $this->apiContext = new ApiContext(new OAuthTokenCredential(config('paypal.client_id'),config('paypal.secret')));
        $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function approved($action)
    {
        $this->approvedAction = $action;
    }

    public function fail($action)
    {
        $this->approvedFail = $action;
    }

    public function isApproved()
    {
        $paymentId = session('paypalPaymentId');
        session()->forget('paypalPaymentId');
        // Session::forget('paypalPaymentId');

        if (empty(request()->get('PayerID')) || empty(request()->get('token'))) {
            //return redirect()->route('home')->with('error', 'There was a problem processing your payment. Please contact support.');
            return false;
        }
        
        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId(request()->get('PayerID'));
        $this->result = $payment->execute($execution, $this->apiContext);

        $this->setCheckerProperties();

        return $this->result->getState() == 'approved';
    }

    private function setCheckerProperties()
    {
        $this->total_transaction = $this->result->transactions[0]->getAmount()->getTotal();
        $this->currency_transaction = $this->result->transactions[0]->getAmount()->getCurrency();
        $this->payer = $this->result->getPayer();
        $this->payment_id = $this->result->getId();
    }

}