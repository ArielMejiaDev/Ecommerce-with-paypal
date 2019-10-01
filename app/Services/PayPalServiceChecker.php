<?php namespace App\Services;

use Illuminate\Support\Facades\Session;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

class PayPalServiceChecker 
{
    public $total_transaction;
    public $currency_transaction;
    public $payer_email;
    public $payer_id;
    public $payer_country_code;
    public $payment_id;

    public function checkTransactionStatus()
    {
        $paymentId = Session::get('paypalPaymentId');
        Session::forget('paypalPaymentId');
        $payment = Payment::get($paymentId, $this->apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId(request()->get('PayerID'));

        $result = $payment->execute($execution, $this->apiContext);


        $this->total_transaction = $result->transactions[0]->getAmount()->getTotal();
        $this->currency_transaction = $result->transactions[0]->getAmount()->getCurrency();
        $this->payer_email = $result->getPayer()->getPayerInfo()->getEmail();
        $this->payer_id = $result->getPayer()->getPayerInfo()->getPayerId();
        $this->payer_country_code = $result->getPayer()->getPayerInfo()->getCountryCode();
        $this->payment_id = $result->getId();


        return $result->getState() == 'approved';

    }

}