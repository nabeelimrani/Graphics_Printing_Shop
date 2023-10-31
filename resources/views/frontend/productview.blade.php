@extends('frontend.layouts.main')

@section('main-section')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Table</h1>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-between align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('productview') }}">Product</a></li>
                        </ol>
                        <a href="{{ route('product') }}" class="btn btn-info">Add Product</a>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Product Table</h3>
                            <div class="card-tools">
                            <form action="{{route('productview')}}" >
    @csrf
    <div class="input-group input-group-sm" style="width: 150px;">
        <input type="text" name="productsearch" value="@if($search){{$search}}@endif" class="form-control float-right" placeholder="Search">
        <div class="input-group-append">
            <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </div>
</form>

                            </div>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                    <tr>
                                        <th class="text-center">ID</th>
                                        <th class="text-center">Category Name</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Sqr.Ft</th>
                                        <th class="text-center">Total Sqr.Ft</th>
                                        <th class="text-center">Rate</th>
                                        <th class="text-center">Disc %</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($product as $productdata)
                                    <tr>
                                    <td class="text-center">{{$productdata->id}}</td>
                                    <td class="text-center ">
    {{ optional($productdata->category)->Name ?? 'Category Not Found' }}
</td>

                                  
                                        <td class="text-center">{{$productdata->Name}}</td>
                                        <td class="text-center">{{$productdata->Quantity}}</td>
                                        <td class="text-center">@if($productdata->SqrFt){{$productdata->SqrFt}} @else --- @endif</td>
                                        <td class="text-center">@if($productdata->Total){{$productdata->Total}} @else --- @endif</td>
                                        <td class="text-center">{{$productdata->Rate}}.00</td>
                                        <td class="text-center ">@if($productdata->Disc){{$productdata->Disc}}.00 % @else --- @endif </td>
                                       

                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{$productdata->id}}" >Edit</button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$productdata->id}}">Delete</button>
                                        </td>
                                    </tr>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{$productdata->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Product</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this Product?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('productdel', ['id' => $productdata->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit customer Modal -->
<div class="modal fade" id="editModal{{$productdata->id}}" tabindex="-1" role="dialog" aria-labelledby="editcustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editcustomerModalLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('productedit', ['id' => $productdata->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="productName">Name</label>
                        <input type="text" name="productname" class="form-control" value="{{ $productdata->Name }}">
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                        <label for="customerName">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ $productdata->Quantity }}">
                    </div>
                  
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="customerName">SqrFt</label>
                        <input type="text" name="sqrft" id="sqrft" class="form-control" value="{{ $productdata->SqrFt }}">
                    </div>
                    </div></div>
                    <div class="form-group">
                        <div class="row">
                        <div class="col-md-6">
                        <label for="customerName">Disc%</label>
                        <input type="number" name="disc" class="form-control" value="{{ $productdata->Disc }}">
                        </div>
                        <div class="col-md-6">
                        <label for="customerName">Rate</label>
                        <input type="number" name="rate" class="form-control" value="{{ $productdata->Rate }}">
                  </div>
                        </div>
                        <div class="form-group">
                        <label for="productName">Total</label>
                        <input type="text" name="total" id="total" readonly class="form-control" value="{{ $productdata->Total }}">
                    </div></div>
                    

                    <!-- Add any other form fields for editing here -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pagination Links -->
    <div class="float-right align-right mr-3 p-2">
    {{$product->links('pagination::bootstrap-5')}}
</div>

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
