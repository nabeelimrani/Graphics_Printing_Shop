<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Area;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Category;
use Hash;

class CategoryController extends Controller
{
    
    public function category()
    {
        return view ('frontend.category');
    }
    public function categorysubmit(Request $request)
    {
        $validation = $request->validate([
            'categoryname' => ['required'],
        ],
        [
            'categoryname.required' => 'The Category Name field is required.',
        ]);
        $category = new Category;
        $category->Name = $validation['categoryname'];
        $category->save();
        return redirect()->route('categoryview')->with('success', "Category Created Successfully..!!");
        

    }
    public function categoryview(Request $request)
    {
        $search = $request['categorysearch']?? " ";
        if($search != " ")
        {
            $category = Category::where('Name','LIKE',"%$search%")->orderBy('Name', 'asc')->paginate(4);
            
            return view('frontend.categoryview')->with('category',$category)->with('search',$search);

        }
        else
        {

        
      $category =Category::orderBy('Name', 'asc')->paginate(4); // You can specify the number of items per page (e.g., 10).

        return view('frontend.categoryview')->with('category',$category)->with('search',$search);
    }
}

public function categorydel($id)
{
    // Find the category by ID and delete it
    $category = Category::find($id);

    if (!$category) {
        return redirect()->route('categoryview')->with('error', 'Category not found');
    }

    // Delete the category
    $category->delete();

    return redirect()->route('categoryview')->with('success', 'Category Deleted Successfully');
}
public function categoryedit(Request $request, $id)
{
    // Validate the request data if needed
    $request->validate([
        'categoryName' => 'required',
    ]);

    // Find the category by ID
    $category = Category::find($id);

    if (!$category) {
        // Handle the case where the category is not found
        return redirect()->back()->with('error', 'Category not found.');
    }

    // Update the category name
    $category->Name = $request->input('categoryName');
    $category->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Category Updated Successfully.');
}


}
