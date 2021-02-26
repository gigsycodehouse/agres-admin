<?php

namespace App\Http\Controllers;

use App\Models\CmsHomepageBanner;
use Illuminate\Http\Request;

class HomeBannerController extends Controller
{
    public function index()
    {
        $d['banners'] = CmsHomepageBanner::all();
        return view('homepage_banner.index', $d);
    }

    public function create()
    {
        return view('homepage_banner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image_desktop' => 'required',
            'image_responsive' => 'required',
        ]);

        $store = new CmsHomepageBanner;
        $store->url = $request->url;
        foreach ($request->all() as $i => $v) {
            if ($i == 'image_desktop' || $i == 'image_responsive') {
                $imageName = $v->getClientOriginalName();
                $imageNewName =  uniqid() . '_' . $imageName;
                $destinationPath = 'assets/cms/home/';
                $v->move($destinationPath, $imageNewName);
                $path_file =  $destinationPath . $imageNewName;

                $store->$i = $path_file;
            }
        }
        $store->save();

        return redirect(route('homepage_banner.index'))->with(['success' => " add homepage banner success"]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $d['banner'] = CmsHomepageBanner::find($id);
        return view('homepage_banner.edit', $d);
    }

    public function update(Request $request, $id)
    {
        $store = CmsHomepageBanner::find($id);
        $store->url = $request->url;
        foreach ($request->all() as $i => $v) {
            if (($i == 'image_desktop' && $v != null) || ($i == 'image_responsive' && $v != null)) {
                $imageName = $v->getClientOriginalName();
                $imageNewName =  uniqid() . '_' . $imageName;
                $destinationPath = 'assets/cms/home/';
                $v->move($destinationPath, $imageNewName);
                $path_file =  $destinationPath . $imageNewName;

                $store->$i = $path_file;
            }
        }
        $store->save();

        return redirect(route('homepage_banner.index'))->with(['success' => " update homepage banner success"]);
    }

    public function destroy($id)
    {
        $member = CmsHomepageBanner::find($id);
        $name = $member->name;
        $member->delete();
        return redirect()->back()->with(['success' => " delete homepage banner success"]);
    }
}
