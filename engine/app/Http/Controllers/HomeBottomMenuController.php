<?php

namespace App\Http\Controllers;

use App\Models\CmsMenuBottom;
use Illuminate\Http\Request;

class HomeBottomMenuController extends Controller
{
    public function index()
    {
        $d['menus'] = CmsMenuBottom::all();
        return view('homepage_bottom_menu.index', $d);
    }

    public function create()
    {
        return view('homepage_bottom_menu.create');
    }

    public function store(Request $request)
    {
        $store = new CmsMenuBottom;
        $store->name = $request->name;
        $store->description = $request->description;
        $store->link = $request->link;
        $store->order = $request->order;

        if ($request->has('icon')) {
            $icon = $request->file('icon');
            $imageName = $icon->getClientOriginalName();
            $imageNewName =  uniqid() . '_' . $imageName;
            $destinationPath = 'assets/images/cms/home/menu/';
            $icon->move($destinationPath, $imageNewName);
            $path_file =  $destinationPath . $imageNewName;

            $store->icon = $path_file;
        }
        $store->save();

        return redirect(route('homepage_bottom_menu.index'))->with(['success' => " add homepage banner success"]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $d['menu'] = CmsMenuBottom::find($id);
        return view('homepage_bottom_menu.edit', $d);
    }

    public function update(Request $request, $id)
    {
        $update = CmsMenuBottom::find($id);
        $update->name = $request->name;
        $update->description = $request->description;
        $update->link = $request->link;
        $update->order = $request->order;

        if ($request->has('icon')) {
            $icon = $request->file('icon');
            $imageName = $icon->getClientOriginalName();
            $imageNewName =  uniqid() . '_' . $imageName;
            $destinationPath = 'assets/images/cms/home/menu/';
            $icon->move($destinationPath, $imageNewName);
            $path_file =  $destinationPath . $imageNewName;

            $update->icon = $path_file;
        }
        $update->save();

        return redirect(route('homepage_bottom_menu.index'))->with(['success' => " update homepage banner success"]);
    }

    public function destroy($id)
    {
        $member = CmsMenuBottom::find($id);
        $member->delete();
        return redirect()->back()->with(['success' => " delete homepage banner success"]);
    }
}
