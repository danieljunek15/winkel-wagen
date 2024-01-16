<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductItem;

class ProductListController extends Controller
{
    //
    function index() {
        $productItemData = ProductItem::all('id', 'name', 'price', 'wattage');
        
        return view('index', [
            'productItemData' => $productItemData,
        ]);
    }
}
