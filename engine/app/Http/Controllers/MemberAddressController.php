<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\MemberAddress;
use App\Models\Province;
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
        $d['provinces'] = Province::all();
        return view('member_address.create', $d);
    }

    public function store(Request $request,$id)
    {
        $request->validate([
            // 'name' => 'required',
            // 'phone' => 'required',
        ]);

        $d['member_id'] = $id;
        $request->merge($d);
        MemberAddress::create($request->except('_token'));
        return redirect(route('member_address.show', $id))->with(['success' => " add member address success"]);
    }

    public function show($id)
    {
        $d['member'] = Member::where('id', $id)->with(['address.province', 'address.city', 'address.district'])->first();
        return view('member_address.show', $d);
    }

    public function edit($id,$address_id)
    {
        $d['member'] = Member::find($id);
        $d['address'] = MemberAddress::find($address_id);
        $d['provinces'] = Province::all();
        return view('member_address.edit', $d);
    }

    public function update(Request $request, $id, $address_id)
    {
        $request->validate([
            // 'name' => 'required',
            // 'phone' => 'required',
        ]);

        $address = MemberAddress::find($address_id);
        $address->name = $request->name;
        $address->phone = $request->phone;
        $address->address = $request->address;
        $address->province_id = $request->province_id;
        $address->city_id = $request->city_id;
        $address->district_id = $request->district_id;
        $address->area_id = $request->area_id;
        $address->postal_code = $request->postal_code;
        $address->save();

        return redirect(route('member_address.show', $id))->with(['success' => " update member address success"]);
    }

    public function destroy($id, $address_id)
    {
        $address = MemberAddress::find($address_id);
        $address->delete();
        return redirect()->back()->with(['success' => " delete member address success"]);
    }
}
