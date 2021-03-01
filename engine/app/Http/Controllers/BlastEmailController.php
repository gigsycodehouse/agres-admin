<?php

namespace App\Http\Controllers;

use App\Models\BlastEmail;
use App\Models\BlastEmailQueue;
use App\Models\Member;
use Illuminate\Http\Request;

class BlastEmailController extends Controller
{
    public function index()
    {
        $d['blasts'] = BlastEmail::all();
        return view('blast_email.index', $d);
    }
    public function show($id)
    {
        $d['blasts'] = BlastEmailQueue::where('blast_email_id', $id)->get();
        return view('blast_email.show', $d);
    }
    public function create()
    {
        $d['members'] = Member::select('id', 'name', 'email')->get();
        return view('blast_email.create', $d);
    }
    public function store(Request $request)
    {
        if ($request->has('chooseall')) {
            $total_recipients = Member::get()->pluck('email')->toArray();
        }else {
            $total_recipients = $request->member_email;
        }
        $blast = BlastEmail::create([
            'message' => $request->message,
            'total_recipients' => count($total_recipients),
        ]);

        foreach ($total_recipients as $member) {
            $queue = BlastEmailQueue::create([
                'blast_email_id' => $blast->id,
                'member_email' => $member
            ]);
        }
        return redirect(route('blast_email.index'))->with('success', 'success send blast');
    }
}
