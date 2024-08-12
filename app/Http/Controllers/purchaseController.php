<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Provider;
use App\Models\Receipt;
use Illuminate\Http\Request;

class purchaseController extends Controller
{

    public function index()
    {
        return view('purchase.index');
    }


    public function create()
    {
        $providers = Provider::all();
        $receipts = Receipt::all();
        $products = Product::all();
        return view('purchase.create',compact('providers','receipts','products'));
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
