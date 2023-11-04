@extends('frontend.layouts.main')

@section('main-section')
@push('title')
<title>Invoice - Hassan Graphics & Printing</title>
@endpush
<style>
  /* Add this CSS in your stylesheet or in a <style> tag in the HTML file */
.payment-image {
    width: 60px; /* Adjust the width as needed */
    height: auto; /* Auto height to maintain aspect ratio */
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
              <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
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
                  From
                  <address>
                    <strong>Hassan Graphics &amp; Printing, Inc.</strong><br>
                     State Life Building, PK 29111<br>
                    Phone: (+92) 334-7237975<br>
                    Email: hassan@graphics.com
                  </address>
                </div>
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{$customer->Name}}</strong><br>
                    {{$customer->area->Name}}<br>
                    Phone: {{$customer->Contact}}<br>
          Email: {{$customer->Email}}
                  </address>
                </div>
                <div class="col-sm-4 invoice-col">
                  
                  <b>Order ID: </b> {{$order->id}}<br>
                  <b>Payment Due: </b> {{$order->created_at->format('m/d/Y')}}<br>
                 
                </div>
                <!-- /.col -->
              </div>
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                    <th>Sno</th>
            <th>Qty</th>
            <th>Product</th>
            <th>Category</th>
            <th>Discount</th>
            <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($prods as $index=>$pro)
          <tr>
            <td>{{$index+1}}</td>
            <td>{{$pro->pivot->quantity}}</td>
            <td>{{$pro->Name}}</td>
            <td>{{$pro->category->Name}}</td>
            <td>{{$pro->pivot->discount?$pro->pivot->discount."%":"null"}}</td>
            <td>{{$pro->pivot->total}}</td>
          </tr>
          @endforeach


          </tbody>
        </table>
</div>
</div>
<div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  <p class="lead">Payment Methods:</p>
                  <img src="{{ asset('frontend/dist/img/credit/jazzcash.png') }}" alt="Easypaisa" class="payment-image">
    <img src="{{ asset('frontend/dist/img/credit/easypaisa.png') }}" alt="Mastercard" class="payment-image">
   

    <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
        We accept the following payment methods to make your shopping experience seamless and secure:
        Visa, Mastercard, American Express, and PayPal. Your payment security is our priority.
    </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Amount Due:  <b> {{$order->created_at->format('m/d/Y')}}</b></p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                      <th>Discount</th>
              <td>{{$order->discount}}%</td>
                      </tr>
                      <tr>
                      <th>Total:</th>
              <td>{{$order->Bill}}/-</td>
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

                <script type="text/javascript">
 

  (function () {
    var beforePrint = function () {
      console.log('Functionality to run before printing.');
    };

    var afterPrint = function () {
      setTimeout(function () {
        window.location = "/order/view";
      }, 1000);
    };

    if (window.matchMedia) {
      var mediaQueryList = window.matchMedia('print');
      mediaQueryList.addListener(function (mql) {
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