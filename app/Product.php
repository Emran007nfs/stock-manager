<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'slug', 'name', 'description', 'sku', 'quantity', 'is_published'
    ];

    public function brand() 
    {
        return $this->belongsto(Brand::class);
    }
}
