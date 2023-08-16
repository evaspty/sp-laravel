<?php

namespace App\Http\Controllers\API;

use App\Helpers\ApiFormatter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Mockery\Expectation as MockeryExpectation;

//use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->qll(), [
            'product_name' => 'required|max:50',
            'product_type' => 'required|in:snack,drink,fruit,drug,groceries,cigaratte,make-up,cigaratte',
            'product_price' => 'required|numoric',
            'expired_at' => 'required|date'

        ]);

        if($validator->fails()) 
        {
            return response()->json($validator->messages())->setStatusCode(422);
        }

        $payload = $validator->validated();
        Product::create([
            'Product_name' => $payload['product_name'],
            'Product_type' => $payload['product_type'],
            'Product_price' => $payload['product_price'],
            'expired_at' => $payload['expired_at']
        ]);

        return response()->json([
            'msg' => 'Data produk berhasil disimpan'
        ],201);
    }

    function showAll()
    {
        $products = Product::all();

        return response()->json([
            'msg' => 'Data produk keseluruhan',
            'data' => $products
        ]);
    }

    function showById($id)
    {
        $product = Product::where('id',$id)->first();

        if($product) {
            return response()->json([
                'msg' => 'Data produk dengan ID: ' .$id,
                'data' => $product
            ],200);
        }

        return response()->json([
            'msg' => 'Data produk dengan ID: '.$id.'tidak ditemukan'
        ],404);
        
    }
    
    function showByName($product_name)
    {
        $product = Product::where('product_name','LIKE','%'.$product_name.'%')->get();

        if($product->count() > 0) 
        {
            return response()->json([
                'msg' => 'Data produk dengan nama yang mirip: '.$product_name,
            ],200);
        }

        return response()->json([
            'msg' => 'Data produk dengan nama yang mirip: '.$product_name.' tidak ditemukan',
        ],404);
    }

    public function update(Request $request,$id)
    {
        $validator = Validator::make($request->qll(), [
            'product_name' => 'required|max:50',
            'product_type' => 'required|in:snack,drink,fruit,drug,groceries,cigaratte,make-up,cigaratte',
            'product_price' => 'required|numoric',
            'expired_at' => 'required|date'

        ]);

        if($validator->fails()) 
        {
            return response()->json($validator->messages())->setStatusCode(422);
        }

        $payload = $validator->validated();
        Product::create([
            'Product_name' => $payload['product_name'],
            'Product_type' => $payload['product_type'],
            'Product_price' => $payload['product_price'],
            'expired_at' => $payload['expired_at']
        ]);

        return response()->json([
            'msg' => 'Data produk berhasil diubah'
        ],201);
    }

    public function delete($id)
    {
        $product = Product::where('id', $id)->get();

        if($product){
            Product::where('id',$id)->delete();

            return response()->json([
                'msg' => 'Data produk dengan ID: '.$id. ' berhasil dihapus'
            ],200);
        }

        return response()->json([
            'msg' => 'Data produk dengan ID: '.$id. ' tidak ditemukan'
        ], 404);
    }
}
