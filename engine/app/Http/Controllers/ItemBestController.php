<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemBest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemBestController extends Controller
{
    public function index()
    {
        $d['items'] = ItemBest::with('product')->get();
        return view('item_best.index', $d);
    }

    public function create()
    {
        $d['items'] = Item::all();
        return view('item_best.create', $d);
    }

    public function store(Request $request)
    {
        ItemBest::create([
            'item_id' => $request->item_id,
            'discount_price' => $request->discount_price,
            'end_deal' => Carbon::parse($request->end_deal)
        ]);
        return redirect(route('item_best.index'))->with(['success' => " add new product success"]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $d['itembest'] = ItemBest::find($id);
        $d['items'] = Item::all();
        return view('item_best.edit', $d);
    }

    public function update(Request $request, $id)
    {

        $update = ItemBest::find($id);
        $update->item_id = $request->item_id;
        $update->discount_price = $request->discount_price;
        $update->end_deal = Carbon::parse($request->end_deal);
        $update->save();

        return redirect(route('item_best.index'))->with(['success' => " update product success"]);
    }

    public function destroy($id)
    {
        $item = ItemBest::find($id);
        $item->delete();
        return redirect()->back()->with(['success' => " delete success"]);
    }
}
