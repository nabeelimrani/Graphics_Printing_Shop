@extends('frontend.layouts.main')

@section('main-section')
@push('title')
<title>View Customer - Hassan Graphics & Printing</title>
@endpush
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer Table</h1>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-between align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('customerview') }}">Customer</a></li>
                        </ol>
                        <a href="{{ route('customer') }}" class="btn btn-info">Add Customer</a>
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
                            <h3 class="card-title">Customer Table</h3>
                            <div class="card-tools">
                            <form action="{{route('customerview')}}" >
    @csrf
    <div class="input-group input-group-sm" style="width: 150px;">
        <input type="text" name="customersearch" value="@if($search){{$search}}@endif" class="form-control float-right" placeholder="Search">
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
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Address</th>
                                        <th class="text-center">Contact</th>
                                        <th class="text-center">Email</th>
                                        <th class="text-center">Disc %</th>
                                        <th class="text-center">Opening Bal.</th>
                                        <th class="text-center">Area Name</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customer as $customerdata)
                                    <tr>
                                        <td class="text-center">{{$customerdata->id}}</td>
                                        <td class="text-center">{{$customerdata->Name}}</td>
                                        <td class="text-center">{{$customerdata->Address}}</td>
                                        <td class="text-center">{{$customerdata->Contact}}</td>
                                        <td class="text-center">{{$customerdata->Email}}</td>
                                        <td class="text-center">@if($customerdata->Disc){{$customerdata->Disc}}.00% @else --- @endif </td>
                                        <td class="text-center">@if($customerdata->Opening_Bal){{$customerdata->Opening_Bal}}.00 @else ---  @endif</td>
                                        <td class="text-center">@if($customerdata->Area_ID){{ $customerdata->area->Name }} @else --- @endif</td>


                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{$customerdata->id}}" >Edit</button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$customerdata->id}}">Delete</button>
                                        </td>
                                    </tr>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{$customerdata->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete customer</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this customer?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('customerdel', ['id' => $customerdata->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit customer Modal -->
<div class="modal fade" id="editModal{{$customerdata->id}}" tabindex="-1" role="dialog" aria-labelledby="editcustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editcustomerModalLabel">Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('customeredit', ['id' => $customerdata->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="customerName">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $customerdata->Name }}">
                    </div>
                    <div class="form-group">
                        <label for="customerName">Email</label>
                        <input type="text" name="email" class="form-control" value="{{ $customerdata->Email }}">
                    </div>
                    <div class="form-group">
                        <label for="customerName">Address</label>
                        <input type="text" name="address" class="form-control" value="{{ $customerdata->Address }}">
                    </div>
                   
                    <div class="form-group">
                        <div class="row">
                        <div class="col-md-4">
                        <label for="customerName">Disc%</label>
                        <input type="text" name="discount_percentage" class="form-control" value="{{ $customerdata->Disc }}">
                        </div>
                        <div class="col-md-4">
                        <label for="customerName">Contact</label>
                        <input type="text" name="mobile" class="form-control" value="{{ $customerdata->Contact }}">
                  </div>
                        <div class="col-md-4">
                        <label for="customerName">Opening_Bal</label>
                        <input type="text" name="opening_balance" class="form-control" value="{{ $customerdata->Opening_Bal }}">
                    </div></div></div>
                    <div class="form-group">
    <label for="selectField">Select Area:</label>
    <select class="form-control @error('selectField') is-invalid @enderror" id="selectField" name="selectField">
        @if($customerdata->Area_ID)
            <option value="{{ $customerdata->Area_ID }}">{{ $customerdata->area->Name }}</option>
        @else
            <option value="" selected>--- Select Area ---</option>
        @endif
        @foreach($area as $areaname)
            <option value="{{ $areaname->id }}">{{ $areaname->Name }}</option>
        @endforeach
        <!-- Add more options as needed -->
    </select>
    @error('selectField')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

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
    {{$customer->links('pagination::bootstrap-5')}}
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
    });
</script>
@endsection
