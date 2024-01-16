<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductItem;

class ProductItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Hier roepen we aan om 10 productitems aan te maken voor in de DB
        ProductItem::factory()->count(10)->create();
    }
}
