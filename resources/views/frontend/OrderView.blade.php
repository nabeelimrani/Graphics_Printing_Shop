@extends('frontend.layouts.main')

@section('main-section')
@push('title')
<title>Order View - Hassan Graphics & Printing</title>
@endpush
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
                            <li class="breadcrumb-item active"><a href="{{ route('order') }}">Order</a></li>
                        </ol>
                       
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section >
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
             <td >
             <button class="btn btn-info btn-sm btn-group details" data-bs-id="{{$order->id}}" >
        <i class="fas fa-info-circle"></i> 
    </button>
    <button class="btn btn-danger btn-delete btn-sm btn-group deleteorder" data-bs-id="{{$order->id}}">
        <i class="fas fa-trash-alt"></i> 
    </button>

           	
           </tr>
           @endforeach
        </tbody>
    </table>

	</div>
</div>

</div>
</div>
</div>
</div>
</section>

</div>

<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Order Details</h5>
                <button type="button" class="btn btn-primary btn-close" data-dismiss="modal" aria-label="Cancel">
    <i class="fas fa-times"></i>
</button>


            </div>
            <div class="modal-body">
               
            </div>
        </div>
    </div>
</div>
<!-- Include jQuery before Bootstrap JavaScript -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/js/bootstrap.bundle.min.js"></script>


<script type="text/javascript">
   $(document).ready(function(){
    
    $(".details").on("click", function(){            
        var orderId = $(this).data('bs-id');
        getOrderDetails(orderId)
        
    });
    function getOrderDetails(orderId)
    {
        $.ajax({
            url: '/order/getDeails/' + orderId,
            method: 'GET',
            success: function(data) {
                $('#orderModal .modal-body').html("");
                $('#orderModal .modal-body').html(data);
                $('#orderModal').modal('show');
            }
        });
    }
    $(document).on("click",".deleteproduct",function(){
        var orderId = $(this).data('bs-oid');
        var productID=$(this).data('bs-id');
           $.ajax({
            url: '/order/delproduct',
            method: 'GET',
            data:{order:orderId,product:productID},
            success: function(data) {
          
                if(data=="done")
                {
                $('#orderModal').modal('toggle');
                getOrderDetails(orderId)
                }
                
            }
        });
        });   
         $(document).on("click",".deleteorder",function(){
        var orderId = $(this).data('bs-id');
           $.ajax({
            url: '/order/delorder',
            method: 'GET',
            data:{id:orderId},
            success: function(data) {
                console.log(data);
                if(data=="done")
                {
                location.reload();
                }
                
            }
        });
        });
});
</script>

@endsection
