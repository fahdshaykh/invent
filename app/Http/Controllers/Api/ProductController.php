<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Image;
use DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('categories')->get();
        return response()->json($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'product_name' => 'required|unique:products|max:255',
            'product_code' => 'required',
            'selling_price' => 'required',
            'buying_price' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required'
        ]);

        if ($request->image) {
            $position = strpos($request->image, ';');
            $sub = substr($request->image, 0 , $position);
            $ext = explode('/', $sub)[1];

            $name = time(). '.'.$ext;
            $img = Image::make($request->image)->resize(240,200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $img->save($image_url);

            $product = new Product();
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;
            $product->image = $image_url;
            $product->save();
        } else {
            $product = new Product();
            $product->product_name = $request->product_name;
            $product->product_code = $request->product_code;
            $product->root = $request->root;
            $product->buying_price = $request->buying_price;
            $product->selling_price = $request->selling_price;
            $product->category_id = $request->category_id;
            $product->supplier_id = $request->supplier_id;
            $product->buying_date = $request->buying_date;
            $product->product_quantity = $request->product_quantity;
            $product->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        return response()->json($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required',
            'selling_price' => 'required',
            'buying_price' => 'required',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'buying_date' => 'required',
            'product_quantity' => 'required'
        ]);

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = $request->product_code;
        $data['selling_price'] = $request->selling_price;
        $data['buying_price'] = $request->buying_price;
        $data['category_id'] = $request->category_id;
        $data['supplier_id'] = $request->supplier_id;
        $data['buying_date'] = $request->buying_date;
        $data['supplier_id'] = $request->supplier_id;
        $data['root'] = $request->root;
        $image = $request->newimage;

        if ($image) {

            $position = strpos($image, ';');
            $sub = substr($image, 0 , $position);
            $ext = explode('/', $sub)['1'];

            $name = time(). '.'.$ext;
            $img = Image::make($image)->resize(240,200);
            $upload_path = 'backend/product/';
            $image_url = $upload_path.$name;
            $success = $img->save($image_url);

            if ($success) {

                $data['image'] = $image_url;
                $product = DB::table('products')->where('id', $id)->first();
                $image = $product->image;
                unlink($image);
                DB::table('products')->where('id', $id)->update($data);

            } else {
                $oldimage = $request->image;
                $data['image'] = $oldimage;
                DB::table('products')->where('id', $id)->update($data);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $image = $product->image;
        if ($image) {
            unlink($image);
            DB::table('products')->where('id', $id)->delete();
        } else {
            DB::table('products')->where('id', $id)->delete();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function stockUpdate(Request $request, $id)
    {
        $data = $request->validate([
            'product_quantity' => 'required',
        ]);

        $product = Product::where('id', $id)->update($data);
    }
}
