<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemHot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemHotController extends Controller
{
    public function index()
    {
        $d['items'] = ItemHot::with('product')->get();
        return view('item_hot.index', $d);
    }

    public function create()
    {
        $d['items'] = Item::all();
        return view('item_hot.create', $d);
    }

    public function store(Request $request)
    {
        ItemHot::create([
            'item_id' => $request->item_id,
            'discount_price'=> $request->discount_price,
            'end_deal'=> Carbon::parse($request->end_deal)
        ]);
        return redirect(route('item_hot.index'))->with(['success' => " add new product success"]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $d['itemhot'] = ItemHot::find($id);
        $d['items'] = Item::all();
        return view('item_hot.edit', $d);
    }

    public function update(Request $request, $id)
    {

        $update = ItemHot::find($id);
        $update->item_id = $request->item_id;
        $update->discount_price = $request->discount_price;
        $update->end_deal = Carbon::parse($request->end_deal);
        $update->save();

        return redirect(route('item_hot.index'))->with(['success' => " update product success"]);
    }

    public function destroy($id)
    {
        $category = ItemHot::find($id);
        $category->delete();
        return redirect()->back()->with(['success' => " delete category success"]);
    }
}
