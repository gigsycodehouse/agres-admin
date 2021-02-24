<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index()
    {
        $d['members'] = Member::all();
        return view('member.index', $d);
    }

    public function create()
    {
        return view('member.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:members,email',
            'phone' => 'required|unique:members,phone',
            'password' => 'required|min:8',
        ]);

        $d['email_verified_at'] = Carbon::now();
        $d['password'] = Hash::make($request->password);
        $request->merge($d);
        Member::create($request->except('_token'));
        return redirect(route('member.index'))->with(['success' => " add new member success"]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $d['member'] = Member::find($id);
        return view('member.edit', $d);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ]);

        $member = Member::find($id);
        $member->name = $request->name;
        $member->phone = $request->phone;
        $member->email = $request->email;

        if ($request->password != null) {
            $request->validate([
                'password' => 'required|min:8',
            ]);
            $member->password = Hash::make($request->password);
        }

        $member->save();

        return redirect(route('member.index'))->with(['success' => " update member $member->name success"]);
    }

    public function destroy($id)
    {
        $member = Member::find($id);
        $name = $member->name;
        $member->delete();
        return redirect()->back()->with(['success' => " delete member $name success"]);
    }
}
