<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\Property;
use Exception;

class categoryController extends Controller
{

    public function index()
    {
        $categories = Category::with('property')->latest()->get();
        return view('category.index',['categories' => $categories]);
    }


    public function create()
    {
        return view('category.create');
    }

    public function store(StorePropertyRequest $request)
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
        return redirect()->route('category.index')->with('success', 'Categoría creada éxitosamente');
    }


    public function show(string $id)
    {
        //
    }

    public function edit(Category $category)
    {

        return view('category.edit',['category'=>$category]);
    }


    public function update(UpdateCategoryRequest $request, Category $category)
    {
        Property::where('id', $category->property->id)
            ->update($request->validated());

        return redirect()->route('category.index')->with('success', 'Categoría Editada éxitosamente');
    }


    public function destroy(string $id)
    {
        $message = '';
        $category = Category::find($id);

        if($category->property->status == 1){
            Property::where('id',$category->property->id)
                ->update([
                    'status' => 0,
                ]);
            $message = 'Categoría eliminada éxitosamente';
        }

        else{
            Property::where('id',$category->property->id)
            ->update([
                'status' => 1,
            ]);
            $message = 'Categoría restaurada éxitosamente';
        }
        return redirect()->route('category.index')->with('success', $message);

    }
}
