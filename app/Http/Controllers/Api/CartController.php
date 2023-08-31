<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Extra;
use App\Models\Pos;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request, $id)
    {
        $product = Product::find($id);

    	$check = Pos::where('product_id',$id)->first();

    	if ($check) {
            Pos::where('product_id',$id)->increment('product_quantity');

            $product = Pos::where('product_id',$id)->first();
            $subtotal = $product->product_quantity * $product->product_price;
            Pos::where('product_id',$id)->update(['sub_total'=> $subtotal]);

    	} else {
            $data = array();
            $data['product_id'] = $id;
            $data['product_name'] = $product->product_name;
            $data['product_quantity'] = 1;
            $data['product_price'] = $product->selling_price;
            $data['sub_total'] = $product->selling_price;

            Pos::create($data);
    	}
 
    }

    public function cartProduct() 
    {
        $cart = Pos::get();

        return response()->json($cart);
    }

    public function removeToCart($id)
    {
        Pos::where('id',$id)->delete();
        return response('Done');

    }

    public function incrementItem($id)
    {
        $quantity = Pos::where('id',$id)->increment('product_quantity');

        $product = Pos::where('id',$id)->first();
        $subtotal = $product->product_quantity * $product->product_price;
        Pos::where('id',$id)->update(['sub_total'=> $subtotal]);

        return response('Done');
    }

    public function decrementItem($id)
    {
        $quantity = Pos::where('id',$id)->decrement('product_quantity');

        $product = Pos::where('id',$id)->first();
        $subtotal = $product->product_quantity * $product->product_price;
        Pos::where('id', $id)->update(['sub_total'=> $subtotal]);

        return response('Done');
    }

    public function vat()
    {
        $vats = Extra::first();

        return response()->json($vats);
    }

}
