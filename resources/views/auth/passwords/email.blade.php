@extends('layouts.app')

@section('content')

<div class="container mt-5 mr-2">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="login-logo">
            <a href="#"><b>Hassan </b> Graphics &amp; Printing</a>
                <img src="{{ asset('icon/wedding.png') }}" width=35>
            </div>
            <div class="card" style="background: rgba(255, 255, 255, 0.5);">
                <div class="card-body">
                    <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
                    
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="input-group mb-3">
                                <input id="email" placeholder="Email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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

                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-paper-plane"></i> Send Password Reset Link
                                    </button>
                                </div>
                            </div>
                        </form>

                        <p class="mt-3 mb-1">
                            <a href="{{ url('/login') }}">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        </p>
                        <p class="mb-0">
                            <a href="{{ url('/register') }}">
                                <i class="fas fa-user-plus"></i> Register a new membership
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
