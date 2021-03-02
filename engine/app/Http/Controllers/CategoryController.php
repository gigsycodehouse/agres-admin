<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $d['categories'] = Category::all();
        return view('category.index', $d);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'spesification' => 'required',
        ]);

        Category::create([
            'name' => $request->name,
            'spesification' => json_encode($request->spesification),
        ]);
        return redirect(route('category.index'))->with(['success' => " add new category success"]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $d['category'] = Category::find($id);
        return view('category.edit', $d);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'spesification' => 'required',
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->spesification = json_encode($request->spesification);
        $category->save();

        return redirect(route('category.index'))->with(['success' => " update category $category->name success"]);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->back()->with(['success' => " delete category success"]);
    }
}
