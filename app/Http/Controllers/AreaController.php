<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;

class AreaController extends Controller
{
    public function area()
    {
        return view('frontend.area');
    }

    public function areasubmit(Request $request)
    {
        $validation = $request->validate([
            'areaname' => ['required'],
        ]);

        $area = new Area;
        $area->Name = $validation['areaname'];
        $area->save();
        return redirect()->route('areaview')->with('success', "Your Area created Successfully..!!");
    }

    public function areaview(Request $request)
    {
        $search = $request['areasearch'] ?? " ";

        if ($search != " ") {
            $area = Area::where('Name', 'LIKE', "%$search%")->orderBy('Name', 'asc')->paginate(4);
            return view('frontend.areaview')->with('area', $area)->with('search', $search);
        } else {
            $area = Area::orderBy('Name', 'asc')->paginate(4);
            return view('frontend.areaview')->with('area', $area)->with('search', $search);
        }
    }

    public function areadel($id)
    {
        $area = Area::find($id);

        if (!$area) {
            return redirect()->route('areaview')->with('error', 'Area not found');
        }

        $area->delete();

        return redirect()->route('areaview')->with('success', 'Area deleted successfully');
    }

    public function areaedit(Request $request, $id)
    {
        $request->validate([
            'areaName' => 'required|string|max:255',
        ]);

        $area = Area::find($id);

        if (!$area) {
            return redirect()->back()->with('error', 'Area not found.');
        }

        $area->Name = $request->input('areaName');
        $area->save();

        return redirect()->back()->with('success', 'Area name updated successfully.');
    }
}
