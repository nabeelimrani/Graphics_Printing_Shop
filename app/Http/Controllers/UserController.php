<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;

class UserController extends Controller
{
    public function submit(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|email|exists:users,email',
            'password' => 'nullable|min:6',
            'confirmpassword' => 'nullable|same:password',
        ],
        [
            'name.required' => 'The name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.exists' => 'The email does not exist in our records.',
            'password.min' => 'The password must be at least 6 characters long.',
            'confirmpassword.same' => 'The confirm password must match the password.',
        ]);

        $user = User::find($request->id);

        $user->name = $validation['name'];
        $user->email = $validation['email'];

        // Check if a new password is provided
        if (!empty($validation['password'])) {
            $user->password = Hash::make($validation['password']);
        }

        $user->save();
        return redirect()->back()->with('msg', "Your Profile Updated Successfully..!!");
    }
}
