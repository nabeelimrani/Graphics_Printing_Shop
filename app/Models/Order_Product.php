<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_Product extends Model
{
    use HasFactory;
    protected $table = 'order_product';
    protected $primaryKey = 'id';

    public function customer()
    {
       return $this->belongsTo("App\Models\Customer");
    }
    public function products()
    {
        return $this->belongsToMany("App\Models\Product")->withPivot("name","quantity","total","purchase","sqrFt","discount");
    }   
}
