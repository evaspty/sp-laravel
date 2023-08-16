<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    //set kolom apa saja yang bisa dilakukan insert secara langsung
    protected $table = 'products';
    protected $fillable = [
        'product_name', 
        'product_type', 
        'product_price', 
        'expired_at'
    ];

    protected $hidden = [];
}
