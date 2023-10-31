<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';
    protected $primaryKey = 'id';

    public function category()
    {
        return $this->belongsTo(Category::class, 'Category_ID', 'id');
    }
    
}