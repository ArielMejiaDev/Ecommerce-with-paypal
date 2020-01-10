<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Mail\PayDetail;
use App\Mail\PayDetailMail;
use App\Services\PayPalService;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use PayPal\Api\Item;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PaymentRequest $request)
    {
        session(['buyer' => [
            'firstName' => $request->firstName,
            'lastName'  => $request->lastName,
            'email'     => $request->email,
        ]]);
        $payment = new PayPalService;
        $payment->redirectUrl = route('status');
        $items = Cart::content()->map(function($cartItem){
            return (new Item())->setName($cartItem->name)->setCurrency('USD')->setQuantity($cartItem->qty)->setPrice($cartItem->price);
        })->toArray();

        return $payment->addItems($items, Cart::total(), 'USD')->pay();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
