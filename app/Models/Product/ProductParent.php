<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductParent extends Model
{
    use HasFactory;
    protected $guarded = ['_token'];
}