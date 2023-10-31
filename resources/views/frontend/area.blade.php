@extends('frontend.layouts.main')

@section('main-section')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Area Registration</h1>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-between align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Area</li>
                        </ol>
                        <a href="{{route('areaview')}}" class="btn btn-info">View Area</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="col-md-4 offset-8"id="alert" >
    @if(session()->has('msg'))
        <div class="alert alert-success" >{{ session('msg') }}</div>
    @endif
</div>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Area Registration</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('areasubmit') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="areaname">Area Name</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
                                        </div>
                                        <input type="text" name="areaname" class="form-control @error('areaname') is-invalid @enderror" placeholder="Enter area name">
                                    </div>
                                    @error('areaname')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

$(document).ready(function() {
            setTimeout(function() {
                $("#alert").animate({
                    opacity: 0,
                    height: 0,
                    padding: 0
                }, 1000, function() {
                    $(this).hide();
                });
            }, 1000);
        });
    </script>
@endsection
