<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPicture extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'path',
        'product_id'
    ];
}
