<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\Property;
use Exception;

class brandController extends Controller
{

    public function index()
    {
        $brands = Brand::with('property')->latest()->get();
        return view('brand.index',compact('brands'));
    }


    public function create()
    {
        return view('brand.create');
    }

    public function store(StorePropertyRequest $request)
    {
        try {
            DB::beginTransaction();
            $property = Property::create($request->validated());
            $property->brand()->create([
                'property_id' => $property->id,
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('brand.index')->with('success', 'Marca creada éxitosamente');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Brand $brand)
    {

        return view('brand.edit',['brand'=>$brand]);
    }


    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        Property::where('id', $brand->property->id)
            ->update($request->validated());

        return redirect()->route('brand.index')->with('success', 'Marca Editada éxitosamente');
    }


    public function destroy(string $id)
    {
        $message = '';
        $brand = Brand::find($id);

        if($brand->property->status == 1){
            Property::where('id',$brand->property->id)
                ->update([
                    'status' => 0,
                ]);
            $message = 'Marca eliminada éxitosamente';
        }

        else{
            Property::where('id',$brand->property->id)
            ->update([
                'status' => 1,
            ]);
            $message = 'Marca restaurada éxitosamente';
        }
        return redirect()->route('brand.index')->with('success', $message);

    }
}
