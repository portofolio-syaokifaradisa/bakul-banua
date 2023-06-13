<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name',
        'price',
        'description',
        'umkm_id'
    ];

    public function product_picture(){
        return $this->hasMany(ProductPicture::class);
    }

    public function umkm(){
        return $this->belongsTo(Umkm::class);
    }
}
