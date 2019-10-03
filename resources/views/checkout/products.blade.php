<div class="col-md-4 order-md-2 mb-4">
<h4 class="d-flex justify-content-between align-items-center mb-3">
    <span class="text-muted">Your cart</span>
    <span class="badge badge-secondary badge-pill">{{ Cart::count() }}</span>
</h4>

<ul class="list-group mb-3">
    

        @forelse ($products as $product)
        <li class="list-group-item d-flex justify-content-between lh-condensed">

            <div>
                <h6 class="my-0">{{ $product->name }}</h6>
                {{-- <small class="text-muted">Brief description</small> --}}
            </div>
    
            <span class="text-muted">${{ $product->price }}</span>

        </li>
                
        @empty
            
            <div>
                <h6 class="my-0">No Products in the cart</h6>
            </div>

        @endforelse

    {{-- <li class="list-group-item d-flex justify-content-between bg-light">
        
        <div class="text-success">
            <h6 class="my-0">Promo code</h6>
            <small>EXAMPLECODE</small>
        </div>
        <span class="text-success">-$5</span>

    </li> --}}

    <li class="list-group-item d-flex justify-content-between">

        <span>Subtotal (USD)</span>
        <strong>${{ Cart::subtotal() }}</strong>

    </li>

    <li class="list-group-item d-flex justify-content-between">

        <span>Tax</span>
        <strong>${{ Cart::tax() }}</strong>

    </li>

    <li class="list-group-item d-flex justify-content-between">

        <span>Total (USD)</span>
        <strong>${{ Cart::total() }}</strong>

    </li>

</ul>