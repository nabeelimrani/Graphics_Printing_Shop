<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $table = 'product';
    protected $primaryKey = 'id';

    public function category()
    {
        return $this->belongsTo(Category::class, 'Category_ID', 'id');
    }
     public function orders()
    {
        return $this->belongsToMany("App\Models\Order")->withPivot("name","quantity","total","purchase","sqrFt","discount");
    }

}
