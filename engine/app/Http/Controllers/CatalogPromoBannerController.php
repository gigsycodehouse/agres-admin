<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CmsCatalogPromoBanner;
use Illuminate\Http\Request;

class CatalogPromoBannerController extends Controller
{
    public function index()
    {
        $d['banners'] = CmsCatalogPromoBanner::all();
        return view('catalog_promo_banner.index', $d);
    }

    public function create()
    {
        $d['categories'] = Category::all();
        return view('catalog_promo_banner.create', $d);
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_desktop' => 'required',
            'image_responsive' => 'required',
        ]);

        $store = new CmsCatalogPromoBanner;
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

        return redirect(route('catalog_promo_banner.index'))->with(['success' => "add banner success"]);
    }

    public function edit($id)
    {
        $d['banner'] = CmsCatalogPromoBanner::find($id);
        $d['categories'] = Category::all();
        return view('catalog_promo_banner.edit', $d);
    }

    public function update(Request $request, $id)
    {
        $update = CmsCatalogPromoBanner::find($id);
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

        return redirect(route('catalog_promo_banner.index'))->with(['success' => "update banner success"]);
    }

    public function destroy($id)
    {
        $member = CmsCatalogPromoBanner::find($id);
        $member->delete();
        return redirect()->back()->with(['success' => "delete banner success"]);
    }
}
