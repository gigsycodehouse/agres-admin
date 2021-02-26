<?php

namespace App\Http\Controllers;

use App\Models\CmsPromoBanner;
use Illuminate\Http\Request;

class HomePromoBannerController extends Controller
{
    public function index()
    {
        $d['banners'] = CmsPromoBanner::all();
        return view('homepage_promo_banner.index', $d);
    }

    public function create()
    {
        return view('homepage_promo_banner.create');
    }

    public function store(Request $request)
    {
        $store = new CmsPromoBanner;
        $store->url = $request->url;
        $store->order = $request->order;

        if ($request->has('file')) {
            $file = $request->file('file');
            $imageName = $file->getClientOriginalName();
            $imageNewName =  uniqid() . '_' . $imageName;
            $destinationPath = 'assets/cms/home/promo/';
            $file->move($destinationPath, $imageNewName);
            $path_file =  $destinationPath . $imageNewName;

            $store->file = $path_file;
        }
        $store->save();

        return redirect(route('homepage_promo_banner.index'))->with(['success' => " add homepage banner success"]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $d['banner'] = CmsPromoBanner::find($id);
        return view('homepage_promo_banner.edit', $d);
    }

    public function update(Request $request, $id)
    {
        $update = CmsPromoBanner::find($id);
        $update->name = $request->name;
        $update->description = $request->description;
        $update->link = $request->link;
        $update->order = $request->order;

        if ($request->has('file')) {
            $file = $request->file('file');
            $imageName = $file->getClientOriginalName();
            $imageNewName =  uniqid() . '_' . $imageName;
            $destinationPath = 'assets/cms/home/promo/';
            $file->move($destinationPath, $imageNewName);
            $path_file =  $destinationPath . $imageNewName;

            $update->icon = $path_file;
        }
        $update->save();

        return redirect(route('homepage_promo_banner.index'))->with(['success' => " update homepage banner success"]);
    }

    public function destroy($id)
    {
        $member = CmsPromoBanner::find($id);
        $member->delete();
        return redirect()->back()->with(['success' => " delete homepage banner success"]);
    }
}
