@extends('layouts.app')

@section('content')
<div class="container mt-5 mr-2">
    <div class="row justify-content-center">
        <div class="col-md-5">
        <div class="login-logo">
    <a href="{{url('/register')}}"><b>HN </b> Wedding Shop</a>
    <img src="{{ asset('icon/wedding.png') }}" width=35>
  </div>
            <div class="card" style="background: rgba(255, 255, 255, 0.3);">
            <div class="card-body ">
      <p class="login-box-msg">Register a new membership</p>


               
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="input-group mb-3">
                           
                            <input id="name" type="text" placeholder="Full name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                           
                            <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                           
                            <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class=" input-group mb-3">
                           
                           
                        <input id="password-confirm" placeholder="Repeat password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
                    </div>
                    <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fa fa-user-plus"></i>&nbsp;{{ __('Register') }}
                            </button>
                        </div>
                    </form>
                    
                </div>
                <a href="{{url('/login')}}" class="text-center">
  <i class="fas fa-sign-in-alt"></i> I already have a membership
</a>

   
            </div>
        </div>
    </div>
</div>
@endsection
