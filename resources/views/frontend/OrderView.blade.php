@extends('frontend.layouts.main')

@section('main-section')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order View</h1>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-between align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('order') }}">Order</li>
                        </ol>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="content ">
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title text-dark" id="msg">Orders</h3>
                        </div>
                        <div class="card-body">
                        <div class="row">


            
           
    <table class="table table-sm table-striped text-dark table-bordered">
        <thead >
            <tr  >
                <th class="text-center" >Code</th>
                <th class="text-center">Customer</th>
                <th class="text-center">Discount</th>
               
                <th class="text-center">Action</th>
               
            </tr>
        </thead>
        <tbody >
           @foreach($orders as $order)
           <tr>
           	<td class="text-center">
           		{{$order->id}}
           	</td>
           	<td class="text-center">
           		{{$order->customer->Name}}
           	</td>
           	<td class="text-center">
           		{{$order->discount}}%
           	</td>
             <td class="text-center">
    <button class="btn btn-info btn-details btn-sm btn-group" title="Details">
        <i class="fas fa-info-circle"></i> 
    </button>
    <button class="btn btn-danger btn-delete btn-sm btn-group" title="Delete">
        <i class="fas fa-trash-alt"></i> 
    </button>
</td>

           	
           </tr>
           @endforeach
        </tbody>
    </table>

	</div>
</div>

</div>
</div>
</div>
@endsection