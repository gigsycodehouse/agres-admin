<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    public function index()
    {
        $d['sub_categories'] = SubCategory::with('category')->get();
        return view('sub_category.index', $d);
    }

    public function create()
    {
        $d['categories'] = Category::all();
        return view('sub_category.create', $d);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        SubCategory::create($request->except('_token'));
        return redirect(route('sub_category.index'))->with(['success' => " add new category success"]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $d['sub_category'] = SubCategory::find($id);
        $d['categories'] = Category::all();
        return view('sub_category.edit', $d);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $category = SubCategory::find($id);
        $category->name = $request->name;
        $category->category_id = $request->category_id;
        $category->save();

        return redirect(route('sub_category.index'))->with(['success' => " update category $category->name success"]);
    }

    public function destroy($id)
    {
        $category = SubCategory::find($id);
        $category->delete();
        return redirect()->back()->with(['success' => " delete category success"]);
    }
}
