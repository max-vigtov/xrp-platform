<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Receipt;
use Illuminate\Http\Request;

class saleController extends Controller
{

    public function index()
    {

    }

    public function create()
    {
        $products = Product::where('status', 1)->get();
        $clients = Client::whereHas('person', function($query) {
            $query->where('status', 1);
        })->get();
        $receipts = Receipt::all();

        return view('sale.create', compact('products','clients','receipts'));
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
