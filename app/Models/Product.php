<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{

    use SoftDeletes;
     // added fillable
    protected $fillable = [
        'user_id',
        'item_name',
        'item_description',
        'item_quantity',
        'unit_price',
        'client_name',
        'client_email',
        'phone_number',
    ];
}
