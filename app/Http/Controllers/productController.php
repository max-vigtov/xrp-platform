<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Product;
use App\Models\Brand;
use Exception;

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
            if ($request->hasFile('img_path')) {
                $name = $product->handleUploadImage($request->file('img_path'));
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
        return redirect()->route('product.index')->with('success','Producto registrado exitosamente');

    }

    public function show(string $id)
    {
        //
    }

    public function edit(Product $product)
    {
        $brands = Brand::join('properties as c', 'brands.property_id','=','c.id')
        ->select('brands.id as id','c.name as name')
        ->where('c.status',1)
        ->get();

        $categories =  Category::join('properties as c', 'categories.property_id','=','c.id')
        ->select('categories.id as id','c.name as name')
        ->where('c.status',1)
        ->get();

        return view('product.edit',compact('product','brands','categories'));
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            DB::beginTransaction();
            //PRODUCT TABLE
            if ($request->hasFile('img_path')) {
                $name = $product->handleUploadImage($request->file('img_path'));

                //Eliminar si existiese una imagen
                if (Storage::disk('public')->exists('products/'.$product->img_path)){
                    Storage::disk('public')->delete('products/'.$product->img_path);
                }

            } else {
                $name = $product->img_path;
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
            $product->categories()->sync($categories);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('product.index')->with('success','Producto editado exitosamente');

    }

    public function destroy(string $id)
    {
        //
    }
}
