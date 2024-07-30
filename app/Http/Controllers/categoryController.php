<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use  App\Http\Requests\StoreCategoryRequest;
use App\Models\Property;
use Exception;

class categoryController extends Controller
{

    public function index()
    {
        return view('category.index');
    }


    public function create()
    {
        return view('category.create');
    }


    public function store(StoreCategoryRequest $request)
    {
        try {
            DB::beginTransaction();
            $property = Property::create($request->validated());
            $property->category()->create([
                'property_id' => $property->id,
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('category.index')->with('success', 'Category created successfully');
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
