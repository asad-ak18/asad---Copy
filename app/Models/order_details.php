<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_details extends Model
{
    use HasFactory;
      function relationtoproducttable(){
      return $this->hasOne(product::class, 'id', 'product_id');
}
}
