@extends('layouts.app')

@section('content')

<div class="container">
    <div class="py-5 text-center">
      <img class="d-block mx-auto mb-4" src="{{ asset('images/logo.png') }}" alt="" width="72" height="72">
      <h2>Checkout</h2>
      <p class="text-secondary">
        This app is a demo, your credentials are not stored anywhere anytime, to test the paypal payment the sandbox provide a fake positive balance. 
        feel free to fill fake credentials (please add a valid email to receive a payment detail email).
      </p>
    </div>
  
    <div class="row">

       @include('checkout.products')
  
        {{-- <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Promo code">
            <div class="input-group-append">
              <button type="submit" class="btn btn-secondary">Redeem</button>
            </div>
          </div>
        </form> --}}
      </div>
      <div class="col-md-8 order-md-1">
        <h4 class="mb-3">Billing address</h4>
        <form class="needs-validation" method="POST" action="{{ route('pay') }}" >
          @csrf
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="firstName">First name</label>
              <input type="text" class="form-control" id="firstName" name="firstName" value="{{ old('firstName') }}" >
              @error('firstName')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="lastName">Last name</label>
              <input type="text" class="form-control" id="lastName" name="lastName" value="{{ old('lastName') }}">
              @error('lastName')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
  
          <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="{{ old('email') }}">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
  
          <div class="mb-3">
            <label for="address">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="1234 Main St" value="{{ old('address') }}">
            @error('address')
            <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>
  
          <div class="mb-3">
            <label for="second-address">Address 2 <span class="text-muted">(Optional)</span></label>
            <input type="text" class="form-control" id="second-address" name="second-address" placeholder="Apartment or suite" value="{{ old('second-address') }}">
          </div>
  
          <div class="row">
            <div class="col-md-5 mb-3">
              <label for="country">Country</label>
              <select class="custom-select d-block w-100" id="country" name="country" value="{{ old('country') }}" >
                <option value="">Choose...</option>
                <option value="United States" {{ old('country') == 'United States' ? 'selected' : '' }} >United States</option>
              </select>
              @error('country')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-4 mb-3">
              <label for="state">State</label>
              <select class="custom-select d-block w-100" id="state" name="state" value="{{ old('state') }}">
                <option value="">Choose...</option>
                <option value="California" {{ old('state') == 'California' ? 'selected' : '' }}>California</option>
              </select>
              @error('state')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="zip">Zip</label>
              <input type="text" class="form-control" id="zip" name="zip" value="{{ old('zip') }}" >
              @error('zip')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <hr class="mb-4">
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="same-address" name="same-address" >
            <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
          </div>
          @guest
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input" id="save-info" name="save-info">
            <label class="custom-control-label" for="save-info">Save this information for next time</label>
          </div>
          @endguest
          <hr class="mb-4">
  
          <h4 class="mb-3">Payment</h4>
  
          <div class="d-block my-3">
            <div class="custom-control custom-radio">
              <input id="credit" name="payment-method" type="radio" class="custom-control-input" >
              <label class="custom-control-label" for="credit">Credit card</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="debit" name="payment-method" type="radio" class="custom-control-input" >
              <label class="custom-control-label" for="debit">Debit card</label>
            </div>
            <div class="custom-control custom-radio">
              <input id="paypal" name="payment-method" type="radio" class="custom-control-input" checked="" >
              <label class="custom-control-label" for="paypal">PayPal</label>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6 mb-3">
              <label for="cc-name">Name on card</label>
              <input type="text" class="form-control" id="cc-name" name="cc-name" value="{{ old('cc-name') }}">
              <small class="text-muted">Full name as displayed on card</small>
              @error('cc-name')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-6 mb-3">
              <label for="cc-number">Credit card number</label>
              <input type="text" class="form-control" id="cc-number" name="cc-number" value="{{ old('cc-number') }}" >
              @error('cc-number')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 mb-3">
              <label for="cc-expiration">Expiration</label>
              <input type="text" class="form-control" id="cc-expiration" name="cc-expiration" value="{{ old('cc-expiration') }}" >
              @error('cc-expiration')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-md-3 mb-3">
              <label for="cc-cvv">CVV</label>
              <input type="text" class="form-control" id="cc-cvv" name="cc-cvv" value="{{ old('cc-cvv') }}" >
              @error('cc-cvv')
              <div class="text-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <hr class="mb-4">
          <button class="btn btn-primary btn-lg btn-block" type="submit" >Pay</button>
        </form>
      </div>
    </div>
  
    <footer class="my-5 pt-5 text-muted text-center text-small">
      <p class="mb-1">© {{ date('Y') }} {{  config('app.name', 'Shopi')   }}</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#">Privacy</a></li>
        <li class="list-inline-item"><a href="#">Terms</a></li>
        <li class="list-inline-item"><a href="#">Support</a></li>
      </ul>
    </footer>
  </div>
    
@endsection