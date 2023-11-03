@extends('frontend.layouts.main')

@section('main-section')
@push('title')
<title>Product - Hassan Graphics & Printing</title>
@endpush
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Registration</h1>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-between align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Product</li>
                        </ol>
                        <a href="{{route('productview')}}" class="btn btn-info">View Products</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if(session('success'))
    <div class="alert alert-success" id="alert">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger" id="alert">
        {{ session('error') }}
    </div>
    @endif
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 offset-md-3">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Registration</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{route('productstore')}}" method="post">
                                @csrf

                                <div class="form-group">
                                    <select class="form-control  @error('categoryid') is-invalid @enderror " id="categoryid" name="categoryid">
                                        <option value="" disabled selected>Select Category or Find:</option>
                                        @foreach($category as $categoryname)
                                            <option value="{{$categoryname->id}}">{{$categoryname->Name}}</option>
                                        @endforeach
                                        <!-- Add more options as needed -->
                                    </select>
                                    @error('categoryid')
    <span class="text-danger">{{ $message }}</span>
    @enderror
                                </div>

                                <div class="form-group">
                                    
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-shopping-cart"></i></span>
                                        </div>
                                        <input type="text" name="productname" class="form-control @error('productname') is-invalid @enderror" placeholder="Enter Product Name" value="{{old('productname')}}">
                                    </div>
                                    @error('productname')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">

                                    <div class="row">
                                        <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-sort-numeric-up"></i></span>
                                        </div>
                                        <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" placeholder="Enter Product Quantity" value="{{old('quantity')}}">
                                    </div>
                                    @error('quantity')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-chart-area"></i></span>
                                        </div>
                                        <input type="text" name="sqrft" id="sqrft" class="form-control @error('sqrft') is-invalid @enderror" placeholder="Enter Product Sqr.Ft" value="{{old('sqrft')}}">
                                    </div>
                                    @error('sqrft')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                </div>
                                
                                
                            </div>
                            <div class="form-group">

<div class="row">
    <div class="col-md-4">
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
    </div>
    <input type="number" name="rate" class="form-control @error('rate') is-invalid @enderror" placeholder="Rate" value="{{old('rate')}}">
</div>
@error('rate')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>
<div class="col-md-4">
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-tags"></i></span>
    </div>
    <input type="number" name="disc" class="form-control @error('disc') is-invalid @enderror" placeholder="Disc%" value="{{old('disc')}}">
</div>
@error('disc')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>
<div class="col-md-4">
<div class="input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-barcode"></i></span>
    </div>
    <input type="text" name="total" class="form-control" readonly placeholder="Total" value="" id="total">
</div>
@error('total')
<span class="text-danger">{{ $message }}</span>
@enderror
</div>

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
        
       $("#quantity , #sqrft").on("input", function(){
        
            var quantity = parseFloat($("#quantity").val());
            var sqrft = parseFloat($("#sqrft").val());

            if(!isNaN(quantity) && !isNaN(sqrft))
            {
                var total=quantity*sqrft;
                $("#total").val(total);
            }
            else
            {
                $("#total").val("");
            }
       });
    });

    </script>
@endsection
