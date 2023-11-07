@extends('frontend.layouts.main')

@section('main-section')
@push('title')
<title>View Area  Hassan Graphics & Printing</title>
@endpush
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Area Table</h1>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-between align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active"><a href="{{ route('areaview') }}">Area</a></li>
                        </ol>
                        <a href="{{ route('area') }}" class="btn btn-info">Add Area</a>
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
                            <h3 class="card-title">Area Table</h3>
                            <div class="card-tools">
                            <form action="{{route('areaview')}}" >
    @csrf
    <div class="input-group input-group-sm" style="width: 150px;">
        <input type="text" name="areasearch" class="form-control float-right" placeholder="Search">
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
                                        <th class="text-center">Area Name</th>
                                        <th class="text-center">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($area as $areadata)
                                    <tr>
                                        <td class="text-center">{{$areadata->id}}</td>
                                        <td class="text-center">{{$areadata->Name}}</td>
                                        <td class="text-center">
                                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{$areadata->id}}" >Edit</button>
                                            <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{$areadata->id}}">Delete</button>
                                        </td>
                                    </tr>
                                    <!-- Delete Modal -->
                                    <div class="modal fade" id="deleteModal{{$areadata->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Delete Area</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this area?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                    <form action="{{ route('areadel', ['id' => $areadata->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Area Modal -->
<div class="modal fade" id="editModal{{$areadata->id}}" tabindex="-1" role="dialog" aria-labelledby="editAreaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editAreaModalLabel">Edit Area</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('areaedit', ['id' => $areadata->id]) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="areaName">Area Name</label>
                        <input type="text" name="areaName" class="form-control" value="{{ $areadata->Name }}">
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
    {{$area->links('pagination::bootstrap-5')}}
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
