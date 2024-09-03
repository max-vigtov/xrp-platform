<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Receipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class saleController extends Controller
{

    public function index()
    {

    }

    public function create()
    {
        $subquery = DB::table('purchase_product')
            ->select('product_id', DB::raw('MAX(created_at) as max_created_at'))
            ->groupBy('product_id');

        $products = Product::join('purchase_product as ppr', function ($join) use ($subquery) {
            $join->on('ppr.product_id', '=', 'products.id')
                ->whereIn('ppr.created_at', function ($query) use ($subquery) {
                    $query->select('max_created_at')
                        ->fromSub($subquery, 'subquery')
                        ->whereRaw('subquery.product_id = ppr.product_id');
                });
        })
            ->select('products.name', 'products.id', 'products.stock', 'ppr.selling_price')
            ->where('products.status', 1)
            ->where('products.stock', '>', 0)
            ->get();

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
