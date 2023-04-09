<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\models\Category;

class Category extends Model
{
    protected  $fillable = ['category_name'];
    use HasFactory;
    use SoftDeletes;
   
}
