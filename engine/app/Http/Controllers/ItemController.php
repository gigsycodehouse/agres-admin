<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $d['items'] = Item::with('category', 'sub_category', 'image', 'long_desc')->withCount('review')->get();
        return view('item.index', $d);
    }

    public function create()
    {
        $d['categories'] = Item::all();
        return view('item.create', $d);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $store = new Item;
        $store->name = $request->name;
        $store->price = $request->price;
        $store->stock = $request->stock;
        $store->description = $request->description;
        $store->category_id = $request->category_id;
        $store->sub_category_id = $request->sub_category_id;
        $store->spesification = json_encode($request->spesification);
        $store->save();
        return redirect(route('item.index'))->with(['success' => " add new product success"]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $d['item'] = Item::find($id);
        $d['categories'] = Category::all();
        $d['sub_categories'] = SubCategory::where('category_id', $d['item']->category_id)->get();
        return view('item.edit', $d);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $update = Item::find($id);
        $update->name = $request->name;
        $update->price = $request->price;
        $update->stock = $request->stock;
        $update->description = $request->description;
        $update->category_id = $request->category_id;
        $update->sub_category_id = $request->sub_category_id;
        $update->spesification = json_encode($request->spesification);
        $update->save();

        return redirect(route('item.index'))->with(['success' => " update product $update->name success"]);
    }

    public function destroy($id)
    {
        $category = Item::find($id);
        $category->delete();
        return redirect()->back()->with(['success' => " delete category success"]);
    }
}