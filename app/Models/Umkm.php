<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Umkm extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $fillable = [
        'name',
        'since',
        'nib',
        'address',
        'has_bpom',
        'has_pirt',
        'has_halal',
        'owner',
        'phone',
        'email',
        'password'
    ];
}
