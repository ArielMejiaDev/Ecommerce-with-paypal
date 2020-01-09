@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        @forelse ($products as $product)
        <div class="col-md-3 my-5">
            <div class="bg-white py-2 px-2 rounded shadow">
                <h3>{{ $product->name }}</h3>
                <img 
                    src="{{ $product->image }}" 
                    alt="" 
                    class="img-fluid rounded"
                    style="height: 250px; width:auto"
                >
                <p class="text-secondary my-2">{{ $product->price }} USD</p>
                <form action="{{ route('cart.store') }}" method="POST">
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

