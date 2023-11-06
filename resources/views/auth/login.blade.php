@extends('layouts.app')

@section('content')
<div class="container mt-5 mr-2">
    <div class="row justify-content-center">
        <div class="col-md-5">
        <div class="login-logo">
          
    <a href="{{url('/login')}}"><b>Hassan </b> Graphics &amp; Printing</a>
    <img src="{{ asset('icon/wedding.png') }}" width=50>
  </div>
            <div class="card" style="background: rgba(255, 255, 255, 0.3);">
            <div class="card-body ">
      <p class="login-box-msg">Sign in to start your session</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="input-group mb-3">
                            <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                       
                        <div class="input-group mb-3">
                           
                            <input id="password" placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                            <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="row">
                        <div class="col-8">
                        <div class="icheck-primary">
                        <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>

                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">
                                <i class="fa fa-sign-in-alt"></i> Sign In
                            </button>
                        </div>
                        </form>
                        <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
                        @if (Route::has('password.request'))
                            <p class="mb-1">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    <i class="fa fa-key"></i> {{ __('Forgot Your Password?') }}
                                </a>
                            </p>
                        @endif
                        <p class="mb-0">
  <a href="{{url('/register')}}" class="text-center">
    <i class="fas fa-user-plus"></i> Register a new membership
  </a>
</p>

                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
