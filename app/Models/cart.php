<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    use HasFactory;
    protected $guarded =[];
    function relationtoproducttable(){
        return $this->hasOne(product::class, 'id', 'product_id');
    }
}
