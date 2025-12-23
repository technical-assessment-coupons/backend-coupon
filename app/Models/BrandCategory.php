<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BrandCategory extends Model
{
    protected $table = 'brand_categories';
    protected $fillable = ['brand_id', 'category_id'];
}
