<?php namespace App\Services\Interfaces;

interface PaymentGatewayServiceInterface 
{
    /**
     * add products paresed as specific gateway implementation needs
     *
     * @return App\Services\Intefaces\PaymentGatewayInterface
     */
    public function addItems(iterable $items, $total, $currency = NULL);

    /**
     * execute the payment and redirect to specific platform
     *
     * @return Illuminate\Http\Responseñ
     */
    public function pay();
}