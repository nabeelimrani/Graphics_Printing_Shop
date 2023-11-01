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
        $qty=$product->Quantity;
        $newQty=$qty-$x["quantity"];
        $product->update(["Quantity"=>$newQty]);
                $or->products()->attach($pid,[

                "quantity"=>$x["quantity"],
                "purchase"=>$x["rate"],
                "discount"=>$x["dis"],
                "sqrFt"=>$x["sqrFt"],
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
    public function orderView()
    {
        $orders=Order::all();
        return view("frontend.OrderView")
        ->with("orders",$orders);
    }
}
