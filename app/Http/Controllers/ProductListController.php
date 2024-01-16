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

    function submitWinkelWagenData() {
        $productItemData = ProductItem::all('id', 'name', 'price', 'wattage');
        foreach ($productItemData as $data) {

            $cookieNaam = 'product' . $data['id'];

            foreach ($_COOKIE as $Name => $Value) {
                if ($Name == $cookieNaam) {
                    echo $Name . "\n";
                    echo $Value . "\n";
                }
            }
        }

        return view('submitData', [
        ]);
    }
}
