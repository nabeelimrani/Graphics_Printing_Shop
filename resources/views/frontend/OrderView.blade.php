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
                                <li class="breadcrumb-item active"><a href="{{ route('orderView') }}">Order</a></li>
                            </ol>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if (session('success'))
            <div class="alert alert-success" id="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger" id="alert">
                {{ session('error') }}
            </div>
        @endif
        <section>
            <div class="container-fluid ">
                <div class="row ">
                    <div class="col-md-12 ">
                        <div class="card ">
                            <div class="card-header">
                                <h3 class="card-title text-dark" id="msg">Orders</h3>
                                <div class="card-tools">
                                    <form action="{{ route('orderView') }}">
                                        @csrf
                                        <div class="input-group input-group-sm" style="width: 150px;">
                                            <input type="date" name="categorysearch"
                                                class="form-control float-right datepicker" placeholder="Search"
                                                data-provide="datepicker"
                                                value="@if (isset($search)) {{ $search }} @endif">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">




                                    <table class="table table-sm table-striped text-dark table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Code</th>
                                                <th class="text-center">Customers</th>
                                                <th class="text-center">Discount</th>
                                                <th class="text-center">Printing Charges</th>
                                                <th class="text-center">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    <td class="text-center">
                                                        {{ $order->id }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $order->customer->Name }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $order->discount }}%
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $order->Printing_Charges }}/-
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group">
                                                            <button class="btn btn-sm btn-outline-primary details"
                                                                data-bs-id="{{ $order->id }}">
                                                                <i class="fas fa-info-circle"></i>&nbsp;Detail
                                                            </button>
                                                            <form action="{{ route('invoicepay') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" value="{{ $order->id }}"
                                                                    name="orderid">
                                                                <button class="btn btn-sm btn-outline-success"
                                                                    type="submit" data-bs-id="{{ $order->id }}">
                                                                    <i class="fas fa-file-invoice"></i>&nbsp;Invoice
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </td>





                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <div class="float-right align-right mr-3 p-2">
                                {{ $orders->links('pagination::bootstrap-5') }}
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
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="orderModalLabel">Order Details</h5>
                    <button type="button" class="btn btn-dark btn-close" data-dismiss="modal" aria-label="Cancel">
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

            $(".details").on("click", function() {
                var orderId = $(this).data('bs-id');
                getOrderDetails(orderId)

            });

            function getOrderDetails(orderId) {
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

        });
    </script>
@endsection
