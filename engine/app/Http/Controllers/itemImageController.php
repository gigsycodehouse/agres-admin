<?php

namespace App\Http\Controllers;

use App\Models\ItemImage;
use Illuminate\Http\Request;

class itemImageController extends Controller
{
    public function destroy($id)
    {
        $category = ItemImage::find($id);
        $category->delete();
        return back()->with(['success' => "success delete image "]);
    }
}
