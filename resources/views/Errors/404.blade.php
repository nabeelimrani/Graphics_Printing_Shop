<!-- resources/views/errors/404.blade.php -->

@extends('layouts.app')

<style>
.error-container {
    background: rgba(255, 255, 255, 0.3);
    border: 1px solid #ccc;
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.error-title {
    font-size: 3rem;
    color: #d9534f;
    margin-top: 20px;
}

.error-message {
    font-size: 1.5rem;
    color: #333;
    margin-bottom: 20px;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
    border: none;
}

.btn-primary:hover {
    background-color: #0056b3;
}
</style>
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="error-container">
                    <h1 class="error-title">404 - Page Not Found</h1>
                    <p class="error-message">The page you are looking for does not exist.</p>
                    <a href="{{ url('/home') }}" class="btn btn-primary">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
@endsection
