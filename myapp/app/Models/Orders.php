<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    // add relationship to customers
    public function customers()
    {
        return $this->hasOne(Customers::class,'customerNumber','customerNumber');
    }
}
