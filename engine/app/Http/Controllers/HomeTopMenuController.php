<?php

namespace App\Http\Controllers;

use App\Models\CmsMenuTop;
use Illuminate\Http\Request;

class HomeTopMenuController extends Controller
{
    public function index()
    {
        $d['menus'] = CmsMenuTop::all();
        return view('homepage_top_menu.index', $d);
    }

    public function create()
    {
        return view('homepage_top_menu.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $store = new CmsMenuTop;
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

        return redirect(route('homepage_top_menu.index'))->with(['success' => " add homepage banner success"]);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        $d['banner'] = CmsMenuTop::find($id);
        return view('homepage_top_menu.edit', $d);
    }

    public function update(Request $request, $id)
    {
        $update = CmsMenuTop::find($id);
        $update->name = $request->name;
        $update->description = $request->description;
        $update->link = $request->link;
        $update->order = $request->order;

        if ($request->has('icon')) {
            $icon = $request->file('icon');
            $imageName = $icon->getClientOriginalName();
            $imageNewName =  uniqid() . '_' . $imageName;
            $destinationPath = 'assets/images/cms/home/menu';
            $icon->move($destinationPath, $imageNewName);
            $path_file =  $destinationPath . $imageNewName;

            $update->icon = $path_file;
        }
        $update->save();

        return redirect(route('homepage_top_menu.index'))->with(['success' => " update homepage banner success"]);
    }

    public function destroy($id)
    {
        $member = CmsMenuTop::find($id);
        $name = $member->name;
        $member->delete();
        return redirect()->back()->with(['success' => " delete homepage banner success"]);
    }
}
