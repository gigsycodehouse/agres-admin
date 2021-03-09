<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Image;

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

        $category = Category::create([
            'name' => $request->name,
            'spesification' => json_encode($request->spesification),
        ]);
        if ($request->has('icon')) {
            $file = $request->file('icon');
            $imagePath = 'assets/images/category/';
            $imageName =  uniqid() . '_' . $file->getClientOriginalName();
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0777, true);
            }
            $img = Image::make($file->path());

            $img->resize(122, 122, function ($constraint) {
                $constraint->aspectRatio();
            })->save($imagePath.$imageName);

            $category->icon = $imagePath.$imageName;
        }
        $category->save();
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
        if ($request->has('icon')) {
            $file = $request->file('icon');
            $imagePath = 'assets/images/category/';
            $imageName =  uniqid() . '_' . $file->getClientOriginalName();
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0777, true);
            }
            $img = Image::make($file->path());

            $img->resize(122, 122, function ($constraint) {
                $constraint->aspectRatio();
            })->save($imagePath.$imageName);

            $category->icon = $imagePath.$imageName;
        }
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
