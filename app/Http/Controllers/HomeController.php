<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;
use App\Models\Order_Product;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $customer = Customer::count();
        $productcount = Product::count();
        $user = User::count();
        $order = Order::count();

        $customerdata = Customer::orderBy('created_at','desc')->latest()->take(8)->get();

        $currentDate = Carbon::now()->toDateString();


        $latestCustomers = Customer::whereDate('created_at', $currentDate)->count();

        $orderdata = Order_Product::orderBy('created_at','desc')->latest()->take(5)->get();
        $product = Product::orderBy('created_at','desc')->latest()->take(4)->get();


        return view('frontend.home')
        ->with('order',$order)
        ->with('customer',$customer)
        ->with('productcount',$productcount)
        ->with('product',$product)
        ->with('user',$user)
        ->with('customerdata',$customerdata)
        ->with('orderdata',$orderdata)
        ->with('latestCustomers',$latestCustomers);
    }
    public function profile()
    {
        $customer = Customer::count();
        $productcount = Product::count();
        $user = User::count();

        return view('frontend.profile')->with('customer',$customer)->with('productcount',$productcount)->with('user',$user);
    }
    public function invoice()
    {
            $order = Order::orderBy('id', 'desc')->first();
           $customer=$order->customer;
           $prods=$order->products;


        return view("frontend.invoice")->with("customer",$customer)->with("order",$order)->with("prods",$prods);
    }
    public function invoicepay(Request $request)
    {

            $order = Order::where('id',$request->orderid)->first();
           $customer=$order->customer;
           $prods=$order->products;


        return view("frontend.invoice")->with("customer",$customer)->with("order",$order)->with("prods",$prods);
    }

}
