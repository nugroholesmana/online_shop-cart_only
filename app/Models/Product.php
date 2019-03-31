<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';
    protected $primaryKey = 'id';

    protected $guarded = [];
    
    //relation one to one - Brand Model
    public function hasOneBrand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    //relation one to one - ProductImage Model
    public function hasOneProductImage()
    {
        return $this->hasOne(ProductImage::class, 'product_id');
    }
    //relation one to one Category Model
    public function hasOneCategory()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    //relation one to one Categorysub Model
    public function hasOneCategorysub()
    {
        return $this->hasOne(CategorySub::class, 'id', 'categorysub_id');
    }
}
