<?php namespace App\Services\Interfaces;

interface PaymentGatewayServiceChecker 
{
    /**
     * It returns a boolean if transaction is approved
     *
     * @return boolean
     */
    public function isApproved();
}