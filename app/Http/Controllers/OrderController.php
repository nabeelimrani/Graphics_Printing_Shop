<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Category;
use Hash;
use Carbon;

class OrderController extends Controller
{
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
}
