<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemSelect;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemSelectController extends Controller
{
    public function index()
    {
        $d['items'] = ItemSelect::with('product')->get();
        return view('item_select.index', $d);
    }

    public function create()
    {
        $d['items'] = Item::all();
        return view('item_select.create', $d);
    }

    public function store(Request $request)
    {
        ItemSelect::create([
            'item_id' => $request->item_id,
            'discount_price'=> $request->discount_price,
            'end_deal'=> Carbon::parse($request->end_deal)
        ]);
        return redirect(route('item_select.index'))->with(['success' => " add new product success"]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $d['itemselect'] = ItemSelect::find($id);
        $d['items'] = Item::all();
        return view('item_select.edit', $d);
    }

    public function update(Request $request, $id)
    {

        $update = ItemSelect::find($id);
        $update->item_id = $request->item_id;
        $update->discount_price = $request->discount_price;
        $update->end_deal = Carbon::parse($request->end_deal);
        $update->save();

        return redirect(route('item_select.index'))->with(['success' => " update product success"]);
    }

    public function destroy($id)
    {
        $category = ItemSelect::find($id);
        $category->delete();
        return redirect()->back()->with(['success' => " delete category success"]);
    }
}
