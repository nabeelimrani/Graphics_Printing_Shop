<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';
    protected $primaryKey = 'id';

    public function area()
    {
        return $this->belongsTo(Area::class, 'Area_ID', 'id');
    }
         public function orders()
    {
       return $this->HasMany("App\Models\Order");
    }
}
