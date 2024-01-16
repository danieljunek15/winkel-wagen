<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductItem extends Model
{
    use HasFactory;

    //guarded zorgt er voor dat de aangegeven column's niet ingevuld kunnen worden door een create command/door de user.
    protected $guarded = [];
}
