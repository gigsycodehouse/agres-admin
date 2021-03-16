<?php

namespace App\Http\Controllers;

use App\Models\MemberRequest;
use Illuminate\Http\Request;

class MemberRequestController extends Controller
{
    public function index()
    {
        $d['data'] = MemberRequest::all();
        return view('member_request.index', $d);
    }

    public function create()
    {
        return view('member_request.create');
    }

    public function store(Request $request)
    {
        $store = new MemberRequest;
        $store->name = $request->name;
        $store->email = $request->email;
        $store->phone = $request->phone;
        $store->subject = $request->subject;
        $store->message = $request->message;
        $store->save();
        return redirect(route('member_request.index'))->with(['success' => " add success"]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $d['data'] = MemberRequest::find($id);
        return view('member_request.edit', $d);
    }

    public function update(Request $request, $id)
    {

        $update = MemberRequest::find($id);
        $update->name = $request->name;
        $update->email = $request->email;
        $update->phone = $request->phone;
        $update->subject = $request->subject;
        $update->message = $request->message;
        $update->save();

        return redirect(route('member_request.index'))->with(['success' => " update success"]);
    }

    public function destroy($id)
    {
        $delete = MemberRequest::find($id);
        $delete->delete();
        return redirect()->back()->with(['success' => " delete success"]);
    }
}
