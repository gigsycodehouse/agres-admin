<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\ItemImage;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Image;

class ItemController extends Controller
{
    public function index()
    {
        $d['items'] = Item::with('category', 'sub_category', 'image', 'long_desc')->withCount('review')->get();
        return view('item.index', $d);
    }

    public function create()
    {
        $d['categories'] = Item::all();
        return view('item.create', $d);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $store = new Item;
        $store->name = $request->name;
        $store->price = $request->price;
        $store->stock = $request->stock;
        $store->description = $request->description;
        $store->category_id = $request->category_id;
        $store->sub_category_id = $request->sub_category_id;
        $store->spesification = json_encode($request->spesification);
        $store->save();

        if ($request->has('image')) {
            foreach ($request->file('image') as $k => $v) {
                // $imageName = $v->getClientOriginalName();
                // $imageNewName =  uniqid() . '_' . $imageName;
                // $destinationPath = 'assets/image/product/';
                // $v->move($destinationPath, $imageNewName);
                // $path_file =  $destinationPath . $imageNewName;

                $imagePath = 'assets/image/product/';
                $imageName =  uniqid() . '_' . $v->getClientOriginalName();
                $thumbnailName =  'thumbnail-'.$imageName;
                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0777, true);
                }
                $img = Image::make($v->path());
                $img->resize(674, 674, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagePath.$imageName);

                $img->resize(122, 122, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagePath.$thumbnailName);

                $image = new ItemImage;
                $image->item_id = $store->id;
                $image->img_path = $imagePath;
                $image->img_name = $imageName;
                $image->save();
            }
        }
        return redirect(route('item.index'))->with(['success' => " add new product success"]);
    }

    public function show($id)
    {
        $d['item'] = Item::with('category', 'sub_category', 'image', 'long_desc')->withCount('review')->where('id', $id)->first();
        return view('item.show', $d);
    }

    public function edit($id)
    {
        $d['item'] = Item::with('image')->where('id',$id)->first();
        $d['categories'] = Category::all();
        $d['sub_categories'] = SubCategory::where('category_id', $d['item']->category_id)->get();
        return view('item.edit', $d);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $update = Item::find($id);
        $update->name = $request->name;
        $update->price = $request->price;
        $update->stock = $request->stock;
        $update->description = $request->description;
        $update->category_id = $request->category_id;
        $update->sub_category_id = $request->sub_category_id;
        $update->spesification = json_encode($request->spesification);
        $update->save();

        if ($request->has('image')) {
            foreach ($request->image as $k => $v) {
                $imagePath = 'assets/image/product/';
                $imageName =  uniqid() . '_' . $v->getClientOriginalName();
                $thumbnailName =  'thumbnail-'.$imageName;
                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0777, true);
                }
                $img = Image::make($v->path());
                $img->resize(674, 674, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagePath.$imageName);

                $img->resize(122, 122, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($imagePath.$thumbnailName);

                $image = new ItemImage;
                $image->item_id = $update->id;
                $image->img_path = $imagePath;
                $image->img_name = $imageName;
                $image->save();
            }
        }
        return redirect(route('item.index'))->with(['success' => " update product $update->name success"]);
    }

    public function destroy($id)
    {
        $category = Item::find($id);
        $category->delete();
        return back()->with(['success' => " delete category success"]);
    }

    public function updateStock(Request $request, $item_id)
    {
        $item = Item::find($item_id);
        $item->stock = $request->stock;
        $item->save();
        return back()->with(['success' => "update stock success"]);
    }

    public function review($item_id)
    {
        $d['item'] = Item::with('review')->where('id', $item_id)->first();
        return view('item.review', $d);
    }
    public function getImage($item_id)
    {
        $image = ItemImage::where('item_id', $item_id)->get();
        return $image;
    }
}
