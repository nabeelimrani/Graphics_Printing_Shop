@extends('frontend.layouts.main')

@section('main-section')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Order</h1>
                </div>
                <div class="col-sm-6">
                    <div class="d-flex justify-content-between align-items-center">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Order</li>
                        </ol>
                        <a href="{{ route('orderView') }}" class="btn btn-info">View Order</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="content ">
        <div class="container-fluid ">
            <div class="row ">
                <div class="col-md-12 ">
                    <div class="card card-primary ">
                        <div class="card-header">
                            <h3 class="card-title" id="msg">Purchase Transaction</h3>
                        </div>
                        <div class="card-body bg-secondary">
                        <div class="row">
    <div class="col-md-6">
        <b class="badge badge-primary badge-lg rounded-pill">Date: {{$date}}</b>
    </div>
    <div class="col-md-6 text-right">
        <b class="badge badge-primary badge-lg rounded-pill" value="{{$random_no}}" id="codeget">No: {{$random_no}}</b>
    </div>
</div>
<br>

                            <div class="form-group ">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group" >
                                            <div class="input-group-prepend">
                                                <span class="input-group-text "><i class="fas fa-user"></i></span>
                                            </div>
                                            <select name="customerfield" id="customer" class="form-control">
                                                <option value="" selected disabled>Select Customer or Find...</option>
                                                @foreach($customer as $customerdata)
                                                <option value="{{$customerdata->id}}">{{$customerdata->Name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group" id="categoryfield">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-folder"></i></span>
                                            </div>
                                            <select name="categoryfield" id="category"  class="form-control" disabled>
                                                <option value="" selected disabled>Select Category or Find...</option>
                                                @foreach($category as $categorydata)
                                                <option value="{{$categorydata->id}}">{{$categorydata->Name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @error('categoryfield')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-4">
    <div class="input-group" id="productfield">
        <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-shopping-cart"></i></span>
        </div>
        <select name="productfield" id="product" class="form-control" disabled>
            <option disabled selected>Please select a Category first...</option>
            
        </select>
    </div>
    @error('productfield')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

                                </div>
                                </div>
                                
                                <!-- -------------- -->
                                <table class="table table-bordered bg-light">
    <thead>
        <tr>
            <th class="text-center">Category</th>
            <th class="text-center">Item Name</th>
            <th class="text-center">Total Quantity</th>
            <th class="text-center">Quantity</th>
            <th class="text-center">Available SqrFt</th>
            <th class="text-center">Sale SqrFt</th>
            <th class="text-center">Disc%</th>
            <th class="text-center">Rate</th>
            <th class="text-center">Total</th>
            <th class="text-center">Actions</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="text-center" style="padding: 0; margin: 0;">
                <span id="showcategory"></span>
            </td>
            <td class="text-center" style="padding: 0; margin: 0;">
                <span id="showproduct"></span>
            </td>
            <td class="text-center" style="padding: 0; margin: 0;">
                <input type="number" id="totalquantity" class="form-control text-center" style="width: 100%; border:none;">
            </td>
            <td class="text-center" style="padding: 0; margin: 0;">
                <input type="number" id="quantityInput" class="form-control text-center" style="width: 100%; border:none;">
            </td>
            <td class="text-center" style="padding: 0; margin: 0;">
                <input type="number" id="sqftSpan" readonly class="form-control text-center" style="width: 100%; border:none;">
            </td>
            <td class="text-center" style="padding: 0; margin: 0;">
                <input type="number" id= "avasqrft" class="form-control text-center" style="width: 100%; border:none;">
            </td>
            <td class="text-center" style="padding: 0; margin: 0;">
                <span id="showitemdisc"></span>
            </td>
            <td class="text-center" style="padding: 0; margin: 0;">
                <span id="showitemprice"></span>
            </td>
            <td class="text-center" style="padding: 0; margin: 0;">
                <span id="totalSpan"></span>
            </td>
            <td class="text-center" style="padding: 0; margin: 0;">
    
    <button class="btn btn-success" type="submit" id="saveRow"><i class="fas fa-save"></i> </button>
</td>

        </tr>
     
    </tbody>
</table>

            </div><br><br><br>
            <div class="container mt-2" style="width:95%">
    <table class="table table-sm table-striped table-hover table-bordered">
        <thead style="font-size:12px">
            <tr style="background-color: antiquewhite;">
                <th class="text-center" style="width:5%">Code</th>
                <th class="text-center">Item Name</th>
                <th class="text-center">Quantity</th>
                <th class="text-center" style="width:7%">Rate</th>
                <th class="text-center" style="width:7%; text-align:end;">Disc</th>
                <th class="text-center" style="width:11%; text-align:end;">SqrFt</th>
                <th class="text-center" style="width:11%; text-align:end;">Total</th>
              
                <th class="text-center" style="width:13%; text-align:center;">Action</th>
            </tr>
        </thead>
        <tbody id="newtd">
           
        </tbody>
    </table>
</div>

</div>
</div>
            <div class="offset-9 col-md-3">
                <div class="bg-light float-left">
                    <h5 id="grosstotal">Gross Total: </h5>
                    <h5 id="customerdisc">Discount: </h5>
                    <h4 id="grandtotal">Grand Total: </h4>
                </div>
               
            </div>
            <div class="offset-9 col-md-3">
                 <div class="my-3">
                    <button class="btn btn-primary" id="submitbtn">Submit</button>
                    <button class="btn btn-primary" >Print And Submit</button>
                </div>
            </div>
        </div>
    </div>


                                <!-- ------------- -->
                           
   

</section>
</div>

<style>
  
    .badge-lg {
        font-size: 14px; 
        padding: 10px;
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    var customerID="";
    $(document).ready(function () 
    { 
        $("#category").prop('disabled', true);
     
        $("#customer").on('change', function () {

            var selectedcustomer = $(this).val();
            customerID = $(this).val();
        $("#category").prop('disabled', false);

            $.ajax({
                url: '/get-disc/' + selectedcustomer,
                method: 'GET',
                success: function(data) {
                    var dics = data.Disc;
                    if (data.Disc) {
                        $("#customerdisc").html("Discount: " + dics + "%");
                    } else {
                        $("#customerdisc").html("Discount: 0.0%");
                    }
                    
                }
            });
        });

        $("#category").on('change', function () {
            $("#showproduct").text("");
            $("#showitemprice").text("");
            $("#showitemdisc").text("");
            $("#quantityInput").val("");
            $("#totalquantity").val("");
            $("#sqftSpan").val("");
            $("#avasqrft").val("");
            $("#totalSpan").text("");

            $("#avasqrft, #showproduct, #showitemprice, #showitemdisc, #sqftSpan, #totalSpan").prop('disabled', false);

            var selectedCategory = $(this).val();
            var productSelect = $("#product");
            var showCategoryElement = $("#showcategory");
            showCategoryElement.text($("#category option:selected").text());

            if (selectedCategory === "") {
                productSelect.prop('disabled', true);
                productSelect.empty();
                productSelect.append($('<option>', {
                    value: '',
                    text: 'Please select a category first...',
                    disabled: true,
                    selected: true
                }));
            } else {
                $.ajax({
                    url: '/get-products/' + selectedCategory,
                    method: 'GET',
                    success: function (data) {
                        
                        productSelect.prop('disabled', false);
                        productSelect.empty();
                        productSelect.append($('<option>', {
    value: '',
    text: 'Select Product or Find...',
    disabled: true,
    selected: true
                            
}));
                        if (data.length === 0) {
                            productSelect.append($('<option>', {
                                value: '',
                                text: 'No products available for this category'
                            }));
                        } else {
                            $.each(data, function (index, product) {
                                productSelect.append($('<option>', {
                                    value: product.id,
                                    text: product.Name
                                }));
                              
                                if (product.SqrFt) {
        $("#avasqrft").prop('disabled', false);
    } else {
        $("#avasqrft").prop('disabled', true);

    }
    
                            });
                           
                           
                        }
                       

                    }
                });
            }
        });
           $("#quantityInput").on("change",function()
        {
            var name=$("#showproduct").text();
            var val=$(this).val();
            
            $.ajax({
                url: '/checkqty',
                data:{name:name,qty:val},
                method: 'GET',
                success: function(data) 
                {
                    if(data==1)
                    alert("Sorry, the product is in low stock. We can't sell the requested quantity at the moment. Please contact support for assistance.");
                    $("#saveRow").prop('disabled', true);
                    if(data==0)
                    $("#saveRow").prop('disabled', false);

            }
            });
        });

        $("#product").on('change', function () {
            var selectedProduct = $(this).val();
            var showProductElement = $("#showproduct");
            var showItemPriceElement = $("#showitemprice");
            var showItemDiscElement = $("#showitemdisc");
            var quantityInput = $("#quantityInput");
            var totalquantity = $("#totalquantity");
            var sqftSpan = $("#sqftSpan");
            var totalSpan = $("#totalSpan");
           
            $("#showproduct").text("");
            $("#showitemprice").text("");
            $("#showitemdisc").text(" ");
            $("#quantityInput").val("");
            $("#quantityInput").prop('disabled', false);
              $("#totalquantity").val("");
            $("#totalquantity").prop('disabled', true);
            $("#sqftSpan").val("");
            
            $("#totalSpan").text("");

            if (selectedProduct) {
                $.ajax({
                    url: '/get-itemname/' + selectedProduct,
                    method: 'GET',
                    success: function (data) {
                        showProductElement.text(data.Name);
                        showItemPriceElement.text(data.Rate + "/-");
                        totalquantity.val(data.Quantity);
                        if (!data.Disc) {
                            showItemDiscElement.text("---");
                        } else {
                            showItemDiscElement.text(data.Disc + ".00%");
                        }

                        if (!data.SqrFt) {
                            $("#sqftSpan").val("---");
                        }
                        else
                        {
                            $("#sqftSpan").val(data.SqrFt);
                        }

                        quantityInput.on('input', function () {
                            var quantity = parseFloat($(this).val());
                            var rate = parseFloat(data.Rate);
                            var disc = parseFloat(data.Disc);
                            var total = quantity * rate;
                            if (disc) {
                                var totalwithdisc = (total * disc) / 100;
                                var actualtotal = total - totalwithdisc;
                                var formattedTotal = actualtotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + "/-";
                                totalSpan.text(formattedTotal);
                            } else {
                                totalSpan.text(total.toFixed(2) + "/-");
                            }
                        });
                    }
                });
            } else {
                showProductElement.empty();
                showItemPriceElement.empty();
                sqftSpan.empty();
                avasqrf.empty();
                totalSpan.empty();
                quantityInput.val('');
                totalquantity.val('');
            }
        });

        $("#saveRow").show();

        $("#saveRow").on('click', function () {
            var text = $("#codeget").text();
            var code = parseFloat(text.match(/\d+/));
            var itemname = $("#showproduct").text();
            var quantity = $("#quantityInput").val();
            var price = $("#showitemprice").text();
            var disc = $("#showitemdisc").text();
            var sqrt = $("#avasqrft").val();
            var totalsqrt = $("#sqftSpan").text();
            var total = $("#totalSpan").text();

            // Create a new row with the data
            var newRow = $("<tr>");
            newRow.append("<td class='text-center'>" + code + "</td>");
            newRow.append("<td class='text-center'>" + itemname + "</td>");
            newRow.append("<td class='text-center'>" + quantity + "</td>");
            newRow.append("<td class='text-center'>" + price + "</td>");
            newRow.append("<td class='text-center'>" + disc + "</td>");
            newRow.append("<td class='text-center'>" + sqrt + "</td>");
            newRow.append("<td class='text-center'>" + total + "</td>");
            newRow.append("<td class='text-center'><button class='btn btn-danger m-0 p-0 delete-row'>DEL</button> " + "<button class='btn btn-primary m-0 p-0 edit-row'>EDIT</button>" + "</td>");

            // Append the new row to the table
            $("#newtd").append(newRow);
            $("#showproduct").text("");
            $("#quantityInput").val("");
            $("#showitemprice").text(""); 
            $("#showitemdisc").text("");
            $("#avasqrft").val("");
            $("#sqftSpan").val("");
            $("#totalSpan").text("");
           

             // Calculate the gross total
    calculateGrossTotal();
    
        });

        $("#quantityInput,#totalquantity, #showproduct, #showitemprice, #showitemdisc, #avasqrft, #sqftSpan, #totalSpan").prop('disabled', true);
       
        $(document).on('click', '.delete-row', function () {
    var row = $(this).closest('tr');
    var totalText = row.find('td:eq(6)').text();
    var total = parseFloat(totalText.replace(/[^0-9.-]+/g,""));

    // Remove the row
    row.remove();

    // Subtract the deleted row's total from the gross total
    updateGrossTotal(-total);
    $("#grandtotal").text("Grand Total:  ");
});
function updateGrossTotal(amount) {
    var grossTotalElement = $("#grosstotal");
    var grossTotalText = grossTotalElement.text();
    var currentTotal = parseFloat(grossTotalText.replace(/[^0-9.-]+/g,""));

    // Update the gross total by adding or subtracting the amount
    var newTotal = currentTotal + amount;

    // Display the updated gross total
    grossTotalElement.text("Gross Total: " + newTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + " /-");
}


$(document).on('click', '.edit-row', function () {
    var row = $(this).closest('tr');
    var totalText = row.find('td:eq(6)').text();
    var total = parseFloat(totalText.replace(/[^0-9.-]+/g,""));

    // Subtract the original row's total from the gross total
    updateGrossTotal(-total);

    var row = $(this).closest('tr');
    var code = row.find('td:eq(0)').text();
    var itemname = row.find('td:eq(1)').text();
    var quantity = row.find('td:eq(2)').text();
    var price = row.find('td:eq(3)').text();
    var disc = row.find('td:eq(4)').text();
    var sqrt = row.find('td:eq(5)').text();
    var total = row.find('td:eq(6)').text();

    // Populate the input fields with the row's data for editing
    $("#codeget").text(code);
    $("#showproduct").text(itemname);
    $("#quantityInput").val(quantity);
    $("#showitemprice").text(price);
    $("#showitemdisc").text(disc);
    $("#avasqrft").val(sqrt);
    $("#totalSpan").text(total);

    // Remove the row
    row.remove();
    $("#grandtotal").text("Grand Total:  ");

});
function calculateGrossTotal() {
    var grossTotal = 0;
    $("#newtd tr").each(function() {
        var totalText = $(this).find('td:eq(6)').text();
        var total = parseFloat(totalText.replace(/[^0-9.-]+/g,""));
        if (!isNaN(total)) {
            grossTotal += total;
        }
    });

    
    $("#grosstotal").text("Gross Total: " + grossTotal.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + "/-");

    var discountText = $("#customerdisc").text(); // Assuming $("#customerdisc") contains the 
    var discountValue = parseInt(discountText.match(/\d+/)[0]); 

    var discountAmount = (grossTotal * discountValue) / 100;
    var grandTotal = grossTotal - discountAmount;
    $("#grandtotal").text("Grand Total:"+grandTotal+"/-");
}

$(document).on("click","#submitbtn",function(){
var dataArray = [];
$('#newtd tr').each(function() {
    // Get the values of <td> elements within current <tr>
    var column1 = $(this).find('td:eq(0)').text(); // First <td>
    var column2 = $(this).find('td:eq(1)').text(); // Second <td>
    var column3 = $(this).find('td:eq(2)').text(); // Third <td>
    var column4 = $(this).find('td:eq(3)').text().replace('/-', ''); // Fourth <td> without '/-'
    var column5 = $(this).find('td:eq(4)').text().replace('%', ''); // Fifth <td> without '%'
    var column6 = $(this).find('td:eq(5)').text(); // Sixth <td>
    var column7 = $(this).find('td:eq(6)').text().replace('/-', ''); // Seventh <td> without '/-'
    
     if(column5=="---")
    {
        column5=null;
    }
    dataArray.push({
        code: column1,
        itemName: column2,
        quantity: column3,
        rate: column4,
        dis: column5,
        sqrFt: column6,
        total: column7
    });
});
        var discountText = $("#customerdisc").text(); 
        
    var discountValue = parseInt(discountText.match(/\d+/)[0]); 

    var grandtotal=$("#grandtotal").text();
    var gtotal=parseInt(grandtotal.match(/\d+/)[0]);

    var req={
        
        data:dataArray,
        cid:customerID,
        grandTotal:gtotal,
        discount:discountValue,
    }
 $.ajax({
                url: '/storeorder', 
                type: 'GET',
                dataType: 'json',
                data: req,
                success: function(data) {
                   alert(data.output);
                },
                error: function(error) {
         console.error('Error sending data:', error);
     }
            });
       


});



   });
</script>

@endsection
