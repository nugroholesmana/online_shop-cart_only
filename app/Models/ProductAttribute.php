<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    protected $table = 'product_attribute';
    protected $primaryKey = 'id';

    protected $guarded = [];

    //relation many to one CategorySubattribute
    
    function belongsToCategorySubattribute()
    {
        return $this->belongsTo(CategorySubattribute::class, 'category_subattribute_id');
    }
}
