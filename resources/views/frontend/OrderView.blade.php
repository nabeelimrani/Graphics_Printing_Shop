@extends('frontend.layouts.main')

@section('main-section')
<div class="content-wrapper">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
</table>

            
           
    <table class="table table-sm table-striped  table-bordered">
        <thead >
            <tr style="background-color: antiquewhite;" >
                <th class="text-center" style="width:5%">Code</th>
                <th class="text-center">Customer</th>
                <th class="text-center">Discount</th>
                <th class="text-center" >Details</th>
                <th class="text-center">Action</th>
               
            </tr>
        </thead>
        <tbody >
           @foreach($orders as $order)
           <tr>
           	<td>
           		{{$order->id}}
           	</td>
           	<td>
           		{{$order->customer->Name}}
           	</td>
           	<td>
           		{{$order->discount}}%
           	</td>
           	<td>
           		OrderDetails
           	</td>
           	<td>
           		Delete
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