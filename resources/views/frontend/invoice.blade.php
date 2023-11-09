@extends('frontend.layouts.main')

@section('main-section')
    @push('title')
        <title>Invoice - Hassan Graphics & Printing</title>
    @endpush
    <style>
        /* Add this CSS in your stylesheet or in a <style> tag in the HTML file */
        .payment-image {
            width: 60px;
            /* Adjust the width as needed */
            height: auto;
            /* Auto height to maintain aspect ratio */
        }

        .icon-image {
            width: 210px;
            /* Adjust the width as needed */
            height: auto;
            /* Auto height to maintain aspect ratio */
        }
    </style>
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Invoice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
                <div class="col-12">
                    <h4>
                        <img src="{{ asset('icon/wedding.png') }}" alt="Company Logo" width="50" height="50">

                        Hassan Graphics & Printing
                        <small class="float-right">
                            DATE: {{ \Carbon\Carbon::now()->setTimezone('Asia/Karachi')->format('m/d/Y') }}<br>
                            TIME: {{ \Carbon\Carbon::now()->setTimezone('Asia/Karachi')->format('h:i:s A') }}
                        </small>
                    </h4>
                </div>
                <!-- /.col -->
            </div>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <i>From</i>
                    <address>
                        <strong>Hassan Graphics &amp; Printing, Inc.</strong><br>
                        State Life Building, PK 29111<br>
                        Phone 1: (+92) 343-0990514<br>
                        Phone 2: (+92) 313-9342055<br>
                        Email 1: Hassangraphicsdik@gmail.com<br>
                        Email 2: Hassanprintingdik@gmail.com
                    </address>

                </div>
                <div class="col-sm-4 invoice-col">
                    <i>To</i>
                    <address>
                        <strong>{{ $customer->Name }}</strong><br>
                        {{ $customer->area->Name }}<br>
                        Phone: {{ $customer->Contact }}<br>
                        Email: {{ $customer->Email }}
                    </address>
                </div>
                <div class="col-sm-4 invoice-col">

                    <b>Order ID: </b> {{ $order->id }}<br>
                    <b>Payment Due: </b> {{ $order->created_at->format('m/d/Y') }}<br>

                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="text-center">Sno</th>
                                <th class="text-center">Detail</th>
                                <th class="text-center">Qty</th>
                                <th class="text-center">SqrFt</th>
                                <th class="text-center">Rate</th>

                                <th class="text-center">Discount</th>
                                <th class="text-center">Total</th>
                            </tr>
                        </thead>
                        @php
                            $grossTotal = 0;
                        @endphp
                        <tbody>
                            @foreach ($prods as $index => $pro)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $pro->Name }} - ({{ $pro->category->Name }})</td>

                                    <td class="text-center">
                                        {{ $pro->pivot->quantity ? $pro->pivot->quantity : '--------' }}
                                    </td>
                                    <td class="text-center">{{ $pro->pivot->sqrFt ? $pro->pivot->sqrFt : '-----' }}</td>
                                    <td class="text-center">{{ $pro->pivot->purchase }}</td>

                                    <td class="text-center">
                                        {{ $pro->pivot->discount ? $pro->pivot->discount . '%' : '-----' }}
                                    </td>
                                    <td class="text-center">{{ $pro->pivot->total }}</td>

                                    @php
                                        $grossTotal += $pro->pivot->total;
                                    @endphp
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                    <p class="lead">Accepted Payment Methods:</p>
                    <img src="{{ asset('frontend/dist/img/credit/download-removebg-preview.png') }}"
                        alt="EasyPaisa & JazzCash" class="icon-image">
                    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                        We offer two convenient payment methods to make your online payment experience secure and
                        hassle-free: <b> EasyPaisa &amp; JazzCash</b>
                        <br>Your payment security is our top priority.
                    </p>
                </div>

                <!-- /.col -->
                <div class="col-6">
                    <br>
                    <br>
                    <br>

                    <div class="table-responsive">
                        <table class="table">
                            @if ($customer->Opening_Bal)
                                <tr>
                                    <th>Previous Balance : </th>
                                    <td>{{ $customer->Opening_Bal }}/-</td>
                                </tr>
                            @endif
                            <tr>
                                <th>Gross Total</th>
                                <td>{{ $grossTotal }}/-</td>
                            </tr>
                            <tr>
                                <th>Discount</th>
                                <td>{{ $order->discount }}%</td>
                            </tr>
                            <tr>
                                <th>Printing Charges</th>
                                <td><input type="text" name="printing_charges" class="form-control" id="printing"
                                        style="width: 100%; border:none;" placeholder="Enter charges"
                                        value={{ $order->Printing_Charges }}></td>

                            </tr>


                            <tr>
                                <th>Grand Total:</th>
                                @if ($customer->Opening_Bal)
                                    @php
                                        $total = $customer->Opening_Bal + $order->Bill;
                                    @endphp
                                    <td id="total">{{ number_format($total, 2, '.', ',') }} /-</td>
                                @else
                                    <td id="total">{{ number_format($order->Bill, 2, '.', ',') }} /-</td>
                                @endif
                            </tr>



                        </table>
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row no-print">
                <div class="col-12">

                    <a href="javascript:window.print();">
                        <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                            <i class="fas fa-print"></i> Print
                        </button>
                    </a>
                    <form method="POST" action="{{ route('savetax') }}">
                        @csrf <!-- Add this to include the CSRF token for form submission -->
                        <input type="hidden" name="printing_taxes" id="show">
                        <input type="hidden" name="orderid" value="{{ $order->id }}">
                        <button type="submit" class="btn btn-success float-right" style="margin-right: 5px;">
                            <i class="fas fa-save"></i> Save
                        </button>
                    </form>


                    <a href="{{ route('orderView') }}">
                        <button type="button" class="btn btn-danger float-right" style="margin-right: 5px;">
                            <i class="fas fa-times"></i> Cancel
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.invoice -->
    </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Get references to the input and total
            var $totalElement = $("#total");
            var $total = parseFloat($totalElement.text().replace(/,/g, ''));

            $("#printing").on('input', function() {
                var $printingChargesInput = parseFloat($(this).val());

                if (isNaN($printingChargesInput)) {
                    // If the input is not a number, keep the original total
                    $totalElement.text($total.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + "/-");
                    $("#show").val("");
                } else {
                    var $grandTotal = $printingChargesInput + $total;
                    // Helper function to format the grand total with commas
                    $("#show").val($printingChargesInput);

                    // Update the #total element with the new grand total
                    $totalElement.text($grandTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + "/-");
                }
            });
        });


        (function() {
            var beforePrint = function() {
                console.log('Functionality to run before printing.');
            };

            var afterPrint = function() {
                setTimeout(function() {
                    window.location = "/order/view";
                }, 1000);
            };

            if (window.matchMedia) {
                var mediaQueryList = window.matchMedia('print');
                mediaQueryList.addListener(function(mql) {
                    if (mql.matches) {
                        beforePrint();
                    } else {
                        afterPrint();
                    }
                });
            }

            window.onbeforeprint = beforePrint;
            window.onafterprint = afterPrint;
        })();
    </script>
@endsection
