<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductAttribute;
use App\Models\CategoryAttribute;


class ProductController extends Controller
{
    public function products(Product $product)
    {
        $data['products'] = $product::with(['hasOneProductImage', 'hasOneBrand'])->get();

        return view('products/products', $data);
    }

    public function detail (Product $product, CategoryAttribute $category_attribute, $id)
    {
        try{

        $data['product'] = $product::where('id', $id)
                            ->select('id', 'name', 'model', 'brand_id', 'category_id', 'categorysub_id', 'description', 'price_sell')
                            ->with(['hasOneBrand', 'hasOneCategory', 'hasOneCategorysub'])
                            ->first();
        if(!$data['product']){
            return abort(404);
        }

        $category_attributes = $category_attribute::with(['hasManyProductAttribute' => function($query){
                                            $query->with(['belongsToCategorySubattribute']);
                                        }])->get();
        foreach($category_attributes as $category_attribute){
            $product_attributes[] = $category_attribute->hasManyProductAttribute
                                    ->where('product_id', $id)
                                    ->where('category_attribute_id', $category_attribute->id);
            foreach ($product_attributes as $product_attribute) {
                $pa[] = $product_attribute;
            }
        }
        
        $data['category_attributes'] = [
            'category_attribute'=>$category_attributes,
            'product_attributes'=>$pa
        ];

        //dd($pa);

        }catch(Exception $e){
            return abort(400);
        }
        return view('products/detail', $data);
    }
}
