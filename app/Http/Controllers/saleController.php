<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSaleRequest;
use App\Models\Client;
use App\Models\Product;
use App\Models\Receipt;
use App\Models\Sale;
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

    public function store(StoreSaleRequest $request)
    {
        try {
            DB::beginTransaction();

            $sale = Sale::create($request->validated());

            $arrayIdProduct = $request->get('arrayIdProduct');
            $arrayQuantity = $request->get('arrayQuantity');
            $arraySellingPrice = $request->get('arraySellingPrice');
            $arrayDiscount = $request->get('arrayDiscount');

            $sizeArray = count($arrayIdProduct);
            $cont = 0;
            while($cont < $sizeArray){
                $sale->products()->syncWithoutDetaching([
                    $arrayIdProduct[$cont] => [
                        'quantity' => $arrayQuantity[$cont],
                        'selling_price' => $arraySellingPrice[$cont],
                        'discount' => $arrayDiscount[$cont]
                    ]
                ]);
                $product = Product::find($arrayIdProduct[$cont]);
                $currentStock = $product->stock;
                $quantity = intval($arrayQuantity[$cont]);

                DB::table('products')
                ->where('id', $product->id)
                ->update([
                    'stock' => $currentStock - $quantity,
                ]);
                $cont++;
            }
            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();
        }
        return redirect()->route('sale.index')->with('success', 'Venta realizada con exito');

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
