<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class productController extends Controller
{

    public function index()
    {
        return view('product.index');
    }

    public function create()
    {
        $brands = Brand::join('properties as c', 'brands.property_id','=','c.id')
        ->where('c.status',1)
        ->get();

        $categories =  Category::join('properties as c', 'categories.property_id','=','c.id')
        ->where('c.status',1)
        ->get();
        return view('product.create', compact('brands','categories'));

    }


    public function store(Request $request)
    {
        //
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
