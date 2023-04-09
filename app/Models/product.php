<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\models\product;

class product extends Model
{
    protected $fillable =
    ['product_name','product_price','product_quantity','product_short_description','product_long_discription','product_photo'];
    use HasFactory;
    use SoftDeletes;
}
