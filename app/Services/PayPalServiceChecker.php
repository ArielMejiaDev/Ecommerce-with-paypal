<?php namespace App\Services;

use App\Services\Interfaces\PaymentGatewayServiceChecker;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PayPalServiceChecker implements PaymentGatewayServiceChecker
{
    private $apiContext;
    public  $result;
    public  $transactionInfo;

    public function __construct()
    {
        $this->apiContext = new ApiContext(new OAuthTokenCredential(config('paypal.client_id'),config('paypal.secret')));
        $this->apiContext->setConfig(config('paypal.settings'));
    }

    public function isApproved()
    {
        $paymentId = session('paypalPaymentId');
        session()->forget('paypalPaymentId');

        if (empty(request()->get('PayerID')) || empty(request()->get('token'))) {
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
        $this->transactionInfo = [
            'transactionInfo'   => $this->result->transactions[0],
            'payerInfo'         => $this->result->getPayer()
        ];
    }

}