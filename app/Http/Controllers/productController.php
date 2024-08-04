<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;

class productController extends Controller
{

    public function index()
    {
        $products = Product::with(['categories.property','brand.property'])->latest()->get();
        return view('product.index',compact('products'));
    }

    public function create()
    {
        $brands = Brand::join('properties as c', 'brands.property_id','=','c.id')
        ->select('brands.id as id','c.name as name')
        ->where('c.status',1)
        ->get();

        $categories =  Category::join('properties as c', 'categories.property_id','=','c.id')
        ->select('categories.id as id','c.name as name')
        ->where('c.status',1)
        ->get();
        return view('product.create', compact('brands','categories'));

    }

    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();
            //PRODUCT TABLE
            $product = new Product();
            if($request->hasFile('img_path')){
                $name = $product->handableUploadImage($request->file('img_path'));
            } else{
                $name = null;
            }
            $product->fill([
                'code' => $request->code,
                'name' => $request->name,
                'description' => $request->description,
                'expiration_date' => $request->expiration_date,
                'img_path' => $name,
                'brand_id' => $request->brand_id,
            ]);
            $product->save();

            //PRODUCT-CATEGORY TABLE
            $categories = $request->get('category');
            $product->categories()->attach($categories);
            DB::commit();
        } catch (Exception $e){
            DB::rollBack();
        }
        return redirect()->route('product.index')->with('success','Producto registrado');

    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
