<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use App\Models\Product;
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

        $customerdata = Customer::orderBy('created_at','desc')->latest()->take(8)->get();
        
        $currentDate = Carbon::now()->toDateString();

        
        $latestCustomers = Customer::whereDate('created_at', $currentDate)->count();
        
        
        $product = Product::orderBy('created_at','desc')->latest()->take(4)->get();

       
        return view('frontend.home')->with('customer',$customer)->with('productcount',$productcount)->with('product',$product)->with('user',$user)->with('customerdata',$customerdata)->with('latestCustomers',$latestCustomers);
    }
    public function profile()
    {
        $customer = Customer::count();
        $productcount = Product::count();
        $user = User::count();

        return view('frontend.profile')->with('customer',$customer)->with('productcount',$productcount)->with('user',$user);
    }
    
}
