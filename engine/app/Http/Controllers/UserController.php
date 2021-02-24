<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $d['users'] = User::all();
        return view('user.index', $d);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|min:8',
        ]);

        $d['password'] = Hash::make($request->password);
        $request->merge($d);
        User::create($request->except('_token'));
        return redirect(route('user.index'))->with(['success' => " add new user success"]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $d['user'] = User::find($id);
        return view('user.edit', $d);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $user = User::find($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;

        if ($request->password != null) {
            $request->validate([
                'password' => 'required|min:8',
            ]);
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect(route('user.index'))->with(['success' => " update user $user->name success"]);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $name = $user->name;
        $user->delete();
        return redirect()->back()->with(['success' => " delete user $name success"]);
    }
}
