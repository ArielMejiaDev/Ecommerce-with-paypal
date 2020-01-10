@component('mail::message')
# Hi {{ $data['firstName'] }} {{ $data['lastName'] }}

This is your purchase detail.

@component('mail::table')
| Product                   | Price                        |
| --------------------------|:----------------------------:|
@foreach (Cart::content() as $product)
| {{ $product->name }}      | {{ $product->price }}        |
@endforeach
| Subttotal                 | {{ Cart::subtotal() }} USD   |
| **Tax**                   | **{{ Cart::tax() }} USD**    |
| **Total**                 | **{{ Cart::total() }} USD**  |
@endcomponent

Thanks for your payment.<br>
{{ config('app.name') }}
@endcomponent
