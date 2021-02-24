<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberAddress;
use App\Models\User;
use Illuminate\Http\Request;

class MemberAddressController extends Controller
{
    public function index()
    {
        $d['members'] = Member::all();
        return view('member_address.index', $d);
    }

    public function create($id)
    {
        $d['member'] = Member::where('id', $id)->first();
        return view('member_address.create', $d);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        MemberAddress::create($request->except('_token'));
        return redirect(route('member_address.index'))->with(['success' => " add new member success"]);
    }

    public function show($id)
    {
        $d['member'] = Member::where('id', $id)->with('address')->first();
        return view('member_address.show', $d);
    }

    public function edit($id)
    {
        $d['member'] = MemberAddress::find($id);
        return view('member_address.edit', $d);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
        ]);

        $member = MemberAddress::find($id);
        $member->name = $request->name;
        $member->phone = $request->phone;

        if ($request->password != null) {
            $request->validate([
                'password' => 'required|min:8',
            ]);
            $member->password = Hash::make($request->password);
        }

        $member->save();

        return redirect(route('member_address.index'))->with(['success' => " update member $member->name success"]);
    }

    public function destroy($id)
    {
        $member = MemberAddress::find($id);
        $name = $member->name;
        $member->delete();
        return redirect()->back()->with(['success' => " delete member $name success"]);
    }
}
