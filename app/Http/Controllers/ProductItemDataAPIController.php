<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductItem;

class ProductItemDataAPIController extends Controller
{
    //Dit is de functie die alle benodigde product data weergeven in JSON data op een van de routs
    function index() {
        $productItemData = ProductItem::all('id', 'name', 'price', 'wattage');
        return ([
            $productItemData,
        ]);
    }
}
