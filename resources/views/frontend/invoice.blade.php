

  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> AdminLTE, Inc.
          <small class="float-right">Date: {{\Carbon\Carbon::now()->format('m/d/Y')}}</small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong>Admin, Inc.</strong><br>
          795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (804) 123-5432<br>
          Email: info@almasaeedstudio.com
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong>{{$customer->Name}}</strong><br>
          {{$customer->area->name}}<br>
          
          Phone: {{$customer->Contact}}<br>
          Email: {{$customer->Email}}
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
       
        <br>
        <b>Order ID:</b>{{$order->id}}<br>
        <b>Payment Due:</b>{{$order->created_at->format('m/d/Y')}}<br>
   
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
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
            <td>{{$pro->pivot->discount?$pro->pivot->discount."%":"nill"}}</td>
            <td>{{$pro->pivot->total}}</td>
          </tr>
          @endforeach


          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
     
      <!-- /.col -->
      <div class="col-6">
  

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
  </section>
  <!-- /.content -->

<script type="text/javascript"> 
window.addEventListener("load", () => {
    window.print();
});

</script>
