<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;

class CartController extends Controller
{
    private $session_id;

    public function __construct() {
        $this->session_id = session()->getId();
    }

    public function carts(Product $product)
    {
        $data['carts'] = \Cart::getContent();
        //\Cart::clear();
        return view('cart/carts', $data);
    }

    public function add(Product $product, ProductImage $product_image, $product_id)
    {
        $d_product = $product::where('id', $product_id)
                        ->select('id', 'name', 'price_sell', 'model', 'brand_id')
                        ->with(['hasOneBrand'])
                        ->first();
        $d_product_image = $product_image::where('product_id', $product_id)->first();
        try{
            
            \Cart::add([
                'id'=>$product_id,
                'name'=>$d_product->name,
                'price'=>$d_product->price_sell,
                'quantity'=>1,
                'attributes'=>[
                    'image'=> $d_product_image->name ? $d_product_image->name : null,
                    'brand'=>$d_product->hasOneBrand->name,
                    'model'=>$d_product->model
                ]
            ]);

            return redirect('/cart')->with('success', 'You has adding product <strong>'.$d_product->name.'</strong> in cart');
            
        }catch(Exception $e){
            return abort(400);
        }
    }

    public function update(Request $r)
    {
        
        try{
            $product_id = $r->product_id;
            $qty        = $r->qty;
            for ($i=0; $i < count($product_id); $i++) { 
                \Cart::update($product_id[$i], [
                    'quantity'=> [
                        'relative'=>false,
                        'value'=>$qty[$i]
                    ]
                ]);
            }
            /*
            \Cart::update($product_id, [
                'quantity'=> [
                    'relative'=>false,
                    'value'=>$r->qty
                ]
            ]);

            */
        }catch(\Exception $e){
            return abort(400);
        }

        return redirect('/cart')->with('success', 'You has update product in cart');
    }
    public function clear()
    {
        \Cart::clear();
        return redirect()->back()->with('success', 'You has clear cart.');
    }

    public function remove($id)
    {
        $product = \Cart::get($id);
        \Cart::remove($id);
        return redirect()->back()->with('success', 'You has been remove product <strong>'.$product->name.'</strong> in cart.');
    }

    
    function checkout()
    {
        \Cart::clear();
        return view('cart/checkout');
    }
}
