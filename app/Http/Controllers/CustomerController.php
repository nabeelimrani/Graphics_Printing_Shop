<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Category;
use Hash;

class CustomerController extends Controller
{
    public function customer()
    {
        $area = Area::all();
        return view('frontend.customer')->with('area', $area);
    }

    public function customerstore(Request $request)
    {
     // Validate the form data
     $request->validate([
         'name' => 'required|string',
         'email' => 'nullable|email',
         'address' => 'nullable|string',
         'mobile' => 'nullable|string|max:11',
         'discount_percentage' => 'nullable|numeric',
         'opening_balance' => 'nullable|numeric',
         'selectField' => 'nullable|integer',
     ]);

     // Create a new Customer instance
     $customer = new Customer;
     $customer->Name = $request->input('name');
     $customer->Email = $request->input('email');
     $customer->Address = $request->input('address');
     $customer->Contact = $request->input('mobile');
     $customer->Disc = $request->input('discount_percentage');
     $customer->Opening_Bal = $request->input('opening_balance');
     $customer->Area_ID = $request->input('selectField');

     // Save the customer data to the database
     $customer->save();

     // Redirect back to the form with a success message
     $area = Area::all();
     return redirect()->route('customerview')->with('success', 'Customer added successfully')->with('area',$area);
 
    }

    public function customerview(Request $request)
    {
        $search = $request['customersearch']?? " ";
        if($search != " ")
        {
            $customer = Customer::where('Name','LIKE',"%$search%")->orderBy('Name', 'asc')->paginate(4);
            $area = Area::all();
            if($customer)
            {

            
            return view('frontend.customerview')->with('customer',$customer)->with('area',$area)->with('search',$search);
            }
            else
            {
             return view('frontend.customerview')->with('customer',$customer)->with('area',$area)->with('search',$search)->with('error', 'Customer not found');

            }
        }
        else
        {

        
      $customer = Customer::orderBy('Name', 'asc')->paginate(4); // You can specify the number of items per page (e.g., 10).
         $area = Area::all();
        return view('frontend.customerview')->with('customer',$customer)->with('area',$area)->with('search',$search);
    }
    
 }
 public function customerdel($id)
 {
     // Find the area by ID and delete it
     $customer = Customer::find($id);

     if (!$customer) {
         return redirect()->route('customerview')->with('error', 'Customer not found');
     }
 
     // Delete the customer
     $customer->delete();
 
     return redirect()->route('customerview')->with('success', 'Customer deleted successfully');
 }

 public function customeredit(Request $request, $id)
 {

    
     // Validate the request data if needed
     $request->validate([
         'name' => 'required|string',
         'email' => 'nullable|email',
         'address' => 'nullable|string',
         'mobile' => 'nullable|string|max:11',
         'discount_percentage' => 'nullable|numeric',
         'opening_balance' => 'nullable|numeric',
         'selectField' => 'nullable|integer',
     ]);

 
     // Find the area by ID
     $customer = Customer::find($id);
 
     if (!$customer) {
         // Handle the case where the area is not found
         return redirect()->back()->with('error', 'Area not found.');
     }
 
     // Update the area name
     $customer->Name = $request->input('name');
     $customer->Email = $request->input('email');
     $customer->Address = $request->input('address');
     $customer->Contact = $request->input('mobile');
     $customer->Disc = $request->input('discount_percentage');
     $customer->Opening_Bal = $request->input('opening_balance');
     $customer->Area_ID = $request->input('selectField');

     $customer->save();
 
     // Redirect back with a success message
     return redirect()->back()->with('success', 'Customer updated successfully.');
 }

 public function getDiscount($customerId)
 {

    $customer = Customer::find($customerId);

    if ($customer) {
        return response()->json($customer);
    }

    return response()->json(['customerName' => '']);
    
 }

}
