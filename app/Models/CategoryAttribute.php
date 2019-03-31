<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryAttribute extends Model
{
    protected $table = 'category_attribute';
    protected $primaryKey = 'id';

    protected $guarded = []; 

    //relation one to many ProductAttribute Model
    public function hasManyProductAttribute()
    {
        return $this->hasMany(ProductAttribute::class, 'category_attribute_id');
    }
}
