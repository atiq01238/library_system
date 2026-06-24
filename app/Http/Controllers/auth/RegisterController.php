<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    //
    public function register(Request $request)
    {
        $request->validate([
            "name" => "required|string|max:25",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6",
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        // dd($data);
       user::create($data);([
        'name'=> $data['name'],
       'email'=> $data['email'],
       'password'=> $data['password'],
       ]);

       return redirect('/auth/login')
    ->with('success', 'Account created successfully! Please login.');    

    }
    public function index()
    {
        $users = User::latest()->get();
        return view('users.index', compact('users'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return redirect()->back()
                        ->with('success', 'User deleted successfully 🗑️');
    }
    public function updateRole(Request $request, $id)
    {
        $request->validate([
            'role' => 'required|in:admin,member,user'
        ]);

        $user = User::findOrFail($id);

        $user->role = $request->role;
        $user->save();

        return back()->with('success', 'User role updated successfully.');
    }
    
}
