<?php

namespace App\Http\Controllers;

use DB;
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
        $productTotaalPriceArr = [];

        //Haal data op uit data base
        $productItemData = ProductItem::all('id', 'name', 'price', 'wattage');

        //Voor elke row in database check of cookie naam bestaat
        foreach ($productItemData as $data) {

            //Maak cookie naam aan
            $cookieNaam = 'product' . $data['id'];

            //Voor elke cookie die bestaat doe dit
            foreach ($_COOKIE as $Name => $Value) {
                //Als cookie naam bestaat doe dit
                if ($Name == $cookieNaam) {

                    //Hier halen we het woord product weg waardoor we alleen id overhouden
                    $productIdUitCookie = substr($Name, 7);

                    //Hier zoeken we naar id in DB
                    $productDataUitCookie = ProductItem::where('id', $productIdUitCookie)->first();
                    
                    //Pakken we de prijs veranderen we , naar . om het te kunnen gebruiken als een int
                    $productPriceMetPunt = str_replace(',', '.', $productDataUitCookie->price);
                    
                    //Prijs van product x aantal product geselecteerd
                    $productPriceTotaal = $productPriceMetPunt * $Value;

                    //Laten zien wat de rekensom is met uitkomst (tussen stap)
                    echo $productDataUitCookie->price . " X " . $Value . " = " . str_replace('.', ',', $productPriceTotaal) . "<br>";

                    //Voeg alle waardes in een array
                    array_push($productTotaalPriceArr, $productPriceTotaal);

                }
            }
            
        }

        //Laat de totaal prijs zien door alles in array aan elkaar op te tellen
        echo "Totaal Prijs = " . array_sum($productTotaalPriceArr);

        return view('submitData', [
        ]);
    }    

    //Functie voor het leeg maken van de winkel wagen wanneer klant heeft betaald
    function productItemLeegWinkelMandNaBetaling() {

        //Data op halen uit database
        $productItemData = ProductItem::all('id', 'name', 'price', 'wattage');

        //Voor elke row maak cookie naam aan en verwijder cookie 
        foreach ($productItemData as $data) {

            //Maak cookie naam aan
            $cookieNaam = 'product' . $data['id'];

            //Verwijder cookie naam
            setcookie($cookieNaam, "", time()-3600);
        }

        //Redirect naar start pagina met geen cookies meer
        return redirect(route('list'));
    }
}
