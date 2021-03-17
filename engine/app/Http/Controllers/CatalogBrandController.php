<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CmsCatalogBrand;
use Illuminate\Http\Request;

class CatalogBrandController extends Controller
{
    public function index()
    {
        $d['brands'] = CmsCatalogBrand::all();
        return view('catalog_brand.index', $d);
    }

    public function create()
    {
        $d['categories'] = Category::all();
        return view('catalog_brand.create', $d);
    }

    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required',
        ]);

        $store = new CmsCatalogBrand;
        foreach ($request->except('_token', '_method') as $i => $v) {
            if ($i == 'icon') {
                $imageName = $v->getClientOriginalName();
                $imageNewName =  uniqid() . '_' . $imageName;
                $destinationPath = 'assets/images/cms/catalog/';
                $v->move($destinationPath, $imageNewName);
                $path_file =  $destinationPath . $imageNewName;

                $store->$i = $path_file;
            } else {
                $store->$i = $v;
            }
        }
        $store->save();

        return redirect(route('catalog_brand.index'))->with(['success' => "add brand icon success"]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $d['brand'] = CmsCatalogBrand::find($id);
        $d['categories'] = Category::all();
        return view('catalog_brand.edit', $d);
    }

    public function update(Request $request, $id)
    {
        $update = CmsCatalogBrand::find($id);
        foreach ($request->except('_token', '_method') as $i => $v) {
            if ($i == 'icon') {
                $imageName = $v->getClientOriginalName();
                $imageNewName =  uniqid() . '_' . $imageName;
                $destinationPath = 'assets/images/cms/catalog/';
                $v->move($destinationPath, $imageNewName);
                $path_file =  $destinationPath . $imageNewName;

                $update->$i = $path_file;
            } else {
                $update->$i = $v;
            }
        }
        $update->save();

        return redirect(route('catalog_brand.index'))->with(['success' => "update brand icon success"]);
    }

    public function destroy($id)
    {
        $member = CmsCatalogBrand::find($id);
        $member->delete();
        return redirect()->back()->with(['success' => "delete brand icon success"]);
    }
}
