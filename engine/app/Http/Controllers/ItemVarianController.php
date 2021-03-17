<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemStockVariant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemVarianController extends Controller
{
    public function index($item_id)
    {
        $d['item'] = Item::with('variants')->where('id', $item_id)->first();
        return view('item_variant.index', $d);
    }
    public function create($item_id)
    {
        $d['item'] = Item::find($item_id);
        return view('item_variant.create', $d);
    }
    public function store(Request $request, $item_id)
    {
        $item = new ItemStockVariant;
        $item->item_id = $item_id;
        $item->variant = $request->variant;
        $item->stock = $request->stock;
        $item->price = $request->price;
        $item->discount_price = $request->discount_price;
        $item->start_deal = Carbon::parse($request->start_deal);
        $item->end_deal = Carbon::parse($request->end_deal);
        $item->save();
        return redirect(route('variant.index', $item_id))->with(['success' => "create variant success"]);
    }

    public function edit($item_id, $variant_id)
    {
        $d['item'] = Item::find($item_id);
        $d['variant'] = ItemStockVariant::find($variant_id);
        return view('item_variant.edit', $d);
    }

    public function update(Request $request, $item_id, $variant_id)
    {
        $item = ItemStockVariant::find($variant_id);
        $item->variant = $request->variant;
        $item->stock = $request->stock;
        $item->price = $request->price;
        $item->discount_price = $request->discount_price;
        $item->start_deal = Carbon::parse($request->start_deal);
        $item->end_deal = Carbon::parse($request->end_deal);
        $item->save();
        return redirect(route('variant.index', $item_id))->with(['success' => "update variant success"]);
    }

    public function destroy($id, $variant_id)
    {
        $delete = ItemStockVariant::find($variant_id);
        $delete->delete();
        return redirect()->back()->with(['success' => " delete variant success"]);
    }
}
