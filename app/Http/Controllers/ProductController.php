<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Category;
use Hash;

class ProductController extends Controller
{
    
      public function checkQty(Request $request)
{
    $name = $request->name;
    $qty = $request->qty;
    
    $product = Product::where("Name", $name)->first();
    
    $availableQty = $product->Quantity;
    
    if ($availableQty < $qty) {
        return 1;
    } else {
        return 0;
    }
}
public function checkSqrft(Request $request)
{
    $name = $request->name;
    $qty = $request->qty;
    
    $product = Product::where("Name", $name)->first();
    
    $availableQty = $product->Total;
    
    if ($availableQty < $qty) {
        return 1;
    } else {
        return 0;
    }
}

    public function product()
    {
        $category = Category::all();
        return view ('frontend.product')->with('category', $category);
    }

    public function productstore(Request $request)
    {
       
     // Validate the form data
     $request->validate([
        'categoryid' => 'required',
         'productname' => 'required|string',
         'total' => 'nullable',
         'quantity' => 'nullable|numeric',
         'sqrft' => 'nullable',
         'rate' => 'nullable|numeric',
         'disc' => 'nullable|numeric',
         
     ]);

     // Create a new Customer instance
     $product = new Product;
     $product->Category_ID = $request->input('categoryid');
     $product->Total = $request->input('total');
     $product->Name = $request->input('productname');
     $product->Quantity = $request->input('quantity');
     $product->SqrFt = $request->input('sqrft');
     $product->Rate = $request->input('rate');
     $product->Disc = $request->input('disc');
    

     // Save the product data to the database
     $product->save();

     // Redirect back to the form with a success message
    
     return redirect()->route('productview')->with('success', 'Product added successfully');
 
    }

    public function productview(Request $request)
    {
        $search = $request['productsearch']?? " ";
        if($search != " ")
        {
            $product = Product::where('Name','LIKE',"%$search%")->orderBy('Name', 'asc')->paginate(4);
           
            if($product)
            {

            
            return view('frontend.productview')->with('product',$product)->with('search',$search);
            }
            else
            {
             return view('frontend.productview')->with('product',$product)->with('search',$search)->with('error', 'Customer not found');

            }
        }
        else
        {

        
      $product = Product::orderBy('Name', 'asc')->paginate(4); // You can specify the number of items per page (e.g., 10).
      
        return view('frontend.productview')->with('product',$product)->with('search',$search);
    }
    
 }
 public function productdel($id)
 {
     // Find the area by ID and delete it
     $product = Product::find($id);

     if (!$product) {
         return redirect()->route('productview')->with('error', 'Product not found');
     }
 
     // Delete the product
     $product->delete();
 
     return redirect()->route('productview')->with('success', 'Product deleted successfully');
 }

 public function productedit(Request $request, $id)
 {

    
     // Validate the request data if needed
     $request->validate([
        'productname' => 'required|string',
        'quantity' => 'nullable|numeric',
        'total' => 'nullable',
        'sqrft' => 'nullable',
        'rate' => 'nullable|numeric',
        'disc' => 'nullable|numeric',
     ]);

 
     // Find the area by ID
     $product = Product::find($id);
 
     if (!$product) {
         // Handle the case where the area is not found
         return redirect()->back()->with('error', 'Product not found.');
     }
 
     // Update the area name
     $product->Name = $request->input('productname');
     $product->Quantity = $request->input('quantity');
     $product->Total = $request->input('total');
     $product->SqrFt = $request->input('sqrft');
     $product->Rate = $request->input('rate');
     $product->Disc = $request->input('disc');
     $product->save();
 
     // Redirect back with a success message
     return redirect()->back()->with('success', 'Product updated successfully.');
 }

//  public function getProductByCategory(Request $request)
//     {
//         $categoryId = $request->input('categoryId');

//         // Implement your logic to retrieve products by category from the database
//         $products = Product::where('Category_ID', $categoryId)->get();

//         return response()->json($products);
//     }
public function getProducts($category)
{
    $products = Product::where('category_id', $category)->get();
    return response()->json($products);
}
public function getItemName($product)
{
    // Assuming you have an 'item_name' column in the 'products' table
    $item = Product::find($product);

    if ($item) {
        return response()->json($item);
    }

    return response()->json(['itemName' => '']);
}
public function saveorder(Request $request)
{
    dd($request->all());
    }


}

