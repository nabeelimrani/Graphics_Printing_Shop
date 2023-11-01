<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];
    use HasFactory;
    public function customer()
    {
       return $this->belongsTo("App\Models\Customer");
    }
    public function products()
    {
        return $this->belongsToMany("App\Models\Product")->withPivot("quantity","total","purchase","sqrFt","discount");
    }   
}
