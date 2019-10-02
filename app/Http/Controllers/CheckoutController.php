<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use PayPal\Api\Item;
use App\Services\PayPalService;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment = new PayPalService;
        $payment->redirectSuccessAction = redirect()->route('home')->with('status', 'Thanks for your payment!');
        $payment->redirectFailAction = redirect()->route('home')->with('status', 'Whoops your payment cannot be process please try again later...');

        $items = Cart::content()->map(function($cartItem){
            return (new Item())->setName($cartItem->name)->setCurrency('USD')->setQuantity($cartItem->qty)->setPrice($cartItem->price);
        })->toArray();

        return $payment->addItems($items, Cart::total(), 'USD')->pay();
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
    public function store(ProductRequest $request)
    {
        $product = Product::find($request->id);
        Cart::setGlobalTax(12);
        Cart::add($product->id, $product->name, 1, $product->price);
        return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //ddd($id);
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
        Cart::destroy();
        return redirect()->route('home');
    }
}
