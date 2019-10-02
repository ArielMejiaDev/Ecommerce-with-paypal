@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        @forelse ($products as $product)
        <div class="col-md-3 my-5">
            <div class="bg-white py-2 px-2 rounded shadow">
                <h3>{{ $product->name }}</h3>
                <img 
                    src="https://images.unsplash.com/photo-1564584217132-2271feaeb3c5?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1350&q=80" 
                    alt="" 
                    class="img-fluid rounded"
                >
                <p class="text-secondary my-2">{{ $product->price }} USD</p>
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <button style="submit" class="btn btn-outline-primary btn-block">BUY</button>
                </form>
            </div>
        </div>
        @empty
            <h1 class="text-center text-secondary">There are no products available in this moment.</h1>
        @endforelse

    </div>
</div>

@endsection

