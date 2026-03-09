<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aroma;
use App\Models\Kemasan;

class KatalogController extends Controller
{
    public function index()
    {
        $aromaCategories = Aroma::all();
        $packagingItems = Kemasan::all();

        return view('admin.katalog', compact(
            'aromaCategories',
            'packagingItems'
        ));
    }
}
