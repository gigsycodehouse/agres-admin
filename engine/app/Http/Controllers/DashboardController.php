<?php

namespace App\Http\Controllers;

use App\Models\ItemStockVariant;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $members = Member::latest()->take(5)->get();
        foreach ($members as $member) {
            $member->joined_at = Carbon::parse($member->created_at)->diffForHumans();
        }
        $d['members'] = $members;
        $d['variant_stocks'] = ItemStockVariant::orderBy('stock', 'asc')->take(5)->get();
        return view('dashboard', $d);
    }
}
