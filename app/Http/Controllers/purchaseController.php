<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Models\Product;
use App\Models\Provider;
use App\Models\Purchase;
use App\Models\Receipt;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class purchaseController extends Controller
{

    public function index()
    {
        return view('purchase.index');
    }


    public function create()
    {
        $providers = Provider::whereHas('person', function($query){
            $query->where('status', 1);
        })->get();
        $receipts = Receipt::all();
        $products = Product::where('status',1)->get();

        return view('purchase.create',compact('providers','receipts','products'));
    }


    public function store(StorePurchaseRequest $request)
    {
        dd($request->all());

        try {
            DB::beginTransaction();
            $purchase = Purchase::create($request->validated());

            $arrayIdProduct = $request->get('arrayIdProduct');
            $arrayQuantity = $request->get('arrayQuantity');
            $arrayPurchasePrice = $request->get('arrayPurchasePrice');
            $arraySellingPrice = $request->get('arraySellingPrice');

            $sizeArray = count($arrayIdProduct);
            $cont = 0;
            while($cont < $sizeArray){
                $purchase->products()->syncWithoutDetaching([
                    $arrayIdProduct[$cont] => [
                        'quantity' => $arrayQuantity[$cont],
                        'purchase_price' => $arrayPurchasePrice[$cont],
                        'selling_price' => $arraySellingPrice[$cont],
                    ]
                ]);
                $product = Product::find($arrayIdProduct[$cont]);
                $currentStock = $product->stock;
                $newStock = intval($arrayQuantity[$cont]);

                DB::table('products')
                ->where('id', $product->id)
                ->update([
                    'stock' => $currentStock + $newStock,
                ]);
                $cont++;
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
        return redirect()->route('purchase.index')->with('success', 'Compra realizada con exito');
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
