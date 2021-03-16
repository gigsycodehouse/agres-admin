<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemNewest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemNewestController extends Controller
{
    public function index()
    {
        $d['items'] = ItemNewest::with('product')->get();
        return view('item_newest.index', $d);
    }

    public function create()
    {
        $d['items'] = Item::all();
        return view('item_newest.create', $d);
    }

    public function store(Request $request)
    {
        ItemNewest::create([
            'item_id' => $request->item_id,
            'discount_price' => $request->discount_price,
            'end_deal' => Carbon::parse($request->end_deal)
        ]);
        return redirect(route('item_newest.index'))->with(['success' => " add new product success"]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $d['itemnewest'] = ItemNewest::find($id);
        $d['items'] = Item::all();
        return view('item_newest.edit', $d);
    }

    public function update(Request $request, $id)
    {

        $update = ItemNewest::find($id);
        $update->item_id = $request->item_id;
        $update->discount_price = $request->discount_price;
        $update->end_deal = Carbon::parse($request->end_deal);
        $update->save();

        return redirect(route('item_newest.index'))->with(['success' => " update product success"]);
    }

    public function destroy($id)
    {
        $item = ItemNewest::find($id);
        $item->delete();
        return redirect()->back()->with(['success' => " delete success"]);
    }
}
