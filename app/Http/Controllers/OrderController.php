<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Hash;
use Carbon;

class OrderController extends Controller
{

    public function delorder(Request $request)
    {
        $id=$request->id;
        $order=Order::find($id);

        if($order->products)
        {
        foreach($order->products as $pro)
        {
        $qty = $pro->pivot->quantity;
        $sqrFt=$pro->pivot->sqrFt;
        if($sqrFt)
        {
            $pro->update(["SqrFt"=>$pro->SqrFt+$sqrFt]);
        }
        $pro->update(["Quantity"=>$pro->Quantity+$qty]);
        }
    }

        $order->products()->detach();
        $order->delete();
        return "done";
    }
    public function delproduct(Request $request)
    {
$orderId = $request->order;
$proId = $request->product;
$order = Order::find($orderId);
$product = $order->products()->where("product_id", $proId)->first();
$sqrFt=$product->pivot->sqrFt;

$qty=$product->pivot->quantity;
$order->products()->detach($proId);
$product=Product::find($proId);
if($sqrFt!=null)
{
 $product->update(["SqrFt"=>$product->SqrFt+$sqrFt]);
}
$product->update(["Quantity"=>$product->Quantity+$qty]);
return "done";

    }
    public function getDetails($id)
    {
        $order=Order::find($id);
        $customer = Customer::where('id',$order->customer_id)->first();
        $str="
            <table class='table table-sm table-striped text-dark table-bordered'>
        <thead >
            <tr  >
                <th class='text-center' >Sno</th>
                <th class='text-center'>Name</th>
                <th class='text-center'>Quantity</th>
                <th class='text-center'>SqrFt</th>
                <th class='text-center'>Discount</th>
                <th class='text-center'>Total</th>
            </tr>
        </thead>
        <tbody>";
        if($customer->Opening_Bal)
        {
           $str .="<p class='text-light rounded-pill p-2 bg-primary float-right'>Previous Balance: " . $customer->Opening_Bal . '/-' . "</p>";
        }
      foreach($order->products as $index=>$pro)
      {

        $i=$index+1;
        $dis="";
        $sqrFt=null;
        if($pro->pivot->sqrFt)
        {
            $sqrFt=$pro->pivot->sqrFt." ";
        }
        else{
            $sqrFt="---";
        }

        if($pro->pivot->discount)
         {   $dis=$pro->pivot->discount."%";}
        else
          {  $dis="---";}

        $str.="<tr>
    <td class='text-center'>{$i}</td>
    <td class='text-center'>{$pro->Name}</td>
    <td class='text-center'>{$pro->pivot->quantity}</td>
    <td class='text-center'>{$sqrFt}</td>
    <td class='text-center'>{$dis}</td>
    <td class='text-center'>{$pro->pivot->total}/-</td>

</tr>

        ";
      }
      $str .= "</tbody></table>
      <p class='text-light rounded-pill p-2 bg-primary float-right'>Grand Total: " . number_format($order->Bill, 0, '.', ',') . "/-</p>";
     if($order->discount)
     {
        $str .="<p class='text-light rounded-pill p-2 bg-primary float-left'>Customer Discount: " . $order->discount . '%' . "</p>";
     }





       return response()->json($str);

    }
    public function store(Request $request)
    {

        $xs=$request->data;
        $cid=$request->cid;
        $gtotal=$request->grandTotal;
        $discount=$request->discount;

        $or=Order::Create(["customer_id"=>$cid,"discount"=>$discount,"Bill"=>$gtotal]);

        foreach($xs as $x)
        {

        $product=Product::where("Name",$x["itemName"])->first();
        $pid=$product->id;
        $sqrFt=null;
        if ($x["sqrFt"] != null) {

            $salesqrFt = $x["sqrFt"];
            $totalsqrft = $product->Total;
            $persqrft = $product->SqrFt;
            $remainingSquareFeet =  $totalsqrft - $salesqrFt;


            $product->update(["Total" => $remainingSquareFeet]);

            $remainingQuantity =  $remainingSquareFeet /  $persqrft;
            $roundedQuantity = round($remainingQuantity, 1);
            $product->update(["Quantity" => $roundedQuantity]);
        }





        if($x["quantity"]!=null)
    {


        $qty=$product->Quantity;
        $newQty=$qty-$x["quantity"];
        $product->update(["Quantity"=>$newQty]);

    }


                $or->products()->attach($pid,[

                "quantity"=>$x["quantity"],
                "purchase"=>$x["rate"],
                "discount"=>$x["dis"],
                "sqrFt"=> $sqrFt,
                "total"=>$x["total"],
            ]);

        }
          return json_encode(["output"=>"order added"]) ;
    }
    public function order()
    {

        date_default_timezone_set('Asia/Karachi');
        $date = date("Y-m-d h:i A");

        $random_no =  str_pad(rand(1, 9999), 5, '0', STR_PAD_LEFT);



        $customer = Customer::all();
        $category = Category::all();
        $categories = Category::orderBy('Name','asc')->get();
        $product = Product::all();

        return view('frontend.order')
        ->with('date',$date)
        ->with('random_no',$random_no)
        ->with('category',$category)
        ->with('categories',$categories)
        ->with('customer',$customer)
        ->with('product',$product);
    }
    public function orderView(Request $request)

    {
        $search = $request->categorysearch;
        if($search)
        {

            $orders = Order::where('created_at','LIKE',"%$search%")->paginate(4);

            if($orders)
            {


            return view('frontend.OrderView')->with('orders',$orders)->with('search',$search);
            }
            else
            {
             return view('frontend.OrderView')->with('orders',$orders)->with('search',$search)->with('error', 'Order not found');

            }
        }
        else
        {


      $orders = Order::latest()->paginate(4); // You can specify the number of items per page (e.g., 10).

        return view('frontend.OrderView')->with('orders',$orders)->with('search',$search);
    }


    }

    public function savetax(Request $request)
    {
        $orderid = $request->orderid;
        $tax = $request->printing_taxes;

        // Find the order by its ID
        $order = Order::find($orderid);

        if ($order) {
            // Update the Printing_Charges
            $order->Printing_Charges = $tax;
            $order->save(); // Save the changes to the database
        }
        $orders = Order::latest()->paginate(4);
        return redirect()->route('orderView')->with('orders',$orders);

    }
}
