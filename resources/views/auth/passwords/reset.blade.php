@extends('layouts.app')

@section('content')
<div class="container mt-5 mr-2">
    <div class="row justify-content-center">
    <div class="col-md-4">
        <div class="login-logo">
    <a href="#"><b>Hassan </b> Graphics &amp; Printing</a>
    <img src="{{ asset('icon/wedding.png') }}" width=35>
  </div>
  <div class="card" style="background: rgba(255, 255, 255, 0.3);">
            <div class="card-body ">
            <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="input-group mb-3">
                                <input id="email" type="email"  placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
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
                           
                                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
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

                        <div class="input-group mb-3">
                           

                            
                                <input id="password-confirm" placeholder="Confirm Password" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    <i class="fas fa-unlock-alt"></i>&nbsp; {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <p class="mt-3 mb-1">
        <a href="{{url('/login')}}"> <i class="fas fa-sign-in-alt"></i>&nbsp;Login</a>
      </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
