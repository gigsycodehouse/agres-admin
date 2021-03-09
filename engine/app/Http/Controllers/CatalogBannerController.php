<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CmsCatalogBanner;
use Illuminate\Http\Request;

class CatalogBannerController extends Controller
{
    public function index()
    {
        $d['banners'] = CmsCatalogBanner::all();
        return view('catalog_banner.index', $d);
    }

    public function create()
    {
        $d['categories'] = Category::all();
        return view('catalog_banner.create', $d);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_desktop' => 'required',
            'image_responsive' => 'required',
        ]);

        $store = new CmsCatalogBanner;
        foreach ($request->except('_token','_method') as $i => $v) {
            if ($i == 'image_desktop' || $i == 'image_responsive') {
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

        return redirect(route('catalog_banner.index'))->with(['success' => "add banner success"]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $d['banner'] = CmsCatalogBanner::find($id);
        $d['categories'] = Category::all();
        return view('catalog_banner.edit', $d);
    }

    public function update(Request $request, $id)
    {
        $update = CmsCatalogBanner::find($id);
        foreach ($request->except('_token','_method') as $i => $v) {
            if ($i == 'image_desktop' || $i == 'image_responsive') {
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

        return redirect(route('catalog_banner.index'))->with(['success' => "update banner success"]);
    }

    public function destroy($id)
    {
        $member = CmsCatalogBanner::find($id);
        $member->delete();
        return redirect()->back()->with(['success' => "delete banner success"]);
    }
}
