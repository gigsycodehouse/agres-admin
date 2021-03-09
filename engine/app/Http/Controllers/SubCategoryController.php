<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Image;

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

        $sub_category = new SubCategory;
        foreach ($request->except('_token','_method') as $i => $v) {
            if ($i == 'icon') {
                $imageName =  uniqid() . '_' . $v->getClientOriginalName();
                $imagePath = 'assets/images/sub_category/';

                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0777, true);
                }
                $img = Image::make($v->path());

                $img->resize(122, 122, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagePath . $imageName);

                $sub_category->$i = $imagePath . $imageName;
            } else if ($i == 'banner') {
                $imageName =  uniqid() . '_' . $v->getClientOriginalName();
                $imagePath = 'assets/images/sub_category/';

                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0777, true);
                }
                $img = Image::make($v->path());

                $img->resize(674, 674, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagePath . $imageName);

                $sub_category->$i = $imagePath . $imageName;
            } else {
                $sub_category->$i = $v;
            }
        }
        $sub_category->save();
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

        $sub_category = SubCategory::find($id);
        foreach ($request->except('_token','_method') as $i => $v) {
            if ($i == 'icon') {
                $imageName =  uniqid() . '_' . $v->getClientOriginalName();
                $imagePath = 'assets/images/sub_category/';

                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0777, true);
                }
                $img = Image::make($v->path());

                $img->resize(122, 122, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagePath . $imageName);

                $sub_category->$i = $imagePath . $imageName;
            } else if ($i == 'banner') {
                $imageName =  uniqid() . '_' . $v->getClientOriginalName();
                $imagePath = 'assets/images/sub_category/';

                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0777, true);
                }
                $img = Image::make($v->path());

                $img->resize(674, 674, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagePath . $imageName);

                $sub_category->$i = $imagePath . $imageName;
            } else {
                $sub_category->$i = $v;
            }
        }
        $sub_category->save();

        return redirect(route('sub_category.index'))->with(['success' => " update category $sub_category->name success"]);
    }

    public function destroy($id)
    {
        $category = SubCategory::find($id);
        $category->delete();
        return redirect()->back()->with(['success' => " delete category success"]);
    }
}
