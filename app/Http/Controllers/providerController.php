<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdateProviderRequest;
use App\Models\Document;
use App\Models\Provider;
use App\Models\Person;
use Illuminate\Support\Facades\DB;
use Exception;


class providerController extends Controller
{

    public function index()
    {
        $providers = Provider::with('person.document')->get();
        return view('provider.index', compact('providers'));
    }


    public function create()
    {
        $documents = Document::all();
        return view('provider.create', compact('documents'));
    }


    public function store(StorePersonRequest $request)
    {
        try {
            DB::beginTransaction();
            $person = Person::create($request->validated());
            $person->provider()->create([
                'person_id' => $person->id
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect()->route('provider.index')->with('success', 'Proveedor registrado éxitosamente');
    }


    public function show(string $id)
    {
        //
    }


    public function edit(Provider $provider)
    {
        $provider->load('person.document');
        $documents = Document::all();
        return view('provider.edit',compact('provider','documents'));
    }


    public function update(UpdateProviderRequest $request, Provider $provider)
    {
        try {
            DB::beginTransaction();

            Person::where('id',$provider->person->id)
            ->update($request->validated());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect()->route('provider.index')->with('success', 'Proveedor actualizado éxitosamente');

    }


    public function destroy(string $id)
    {
        $message = '';
        $person = Person::find($id);

        if($person->status == 1){
            Person::where('id',$person->id)
                ->update([
                    'status' => 0,
                ]);
            $message = 'Proveedor eliminado éxitosamente';
        }

        else{
            Person::where('id',$person->id)
            ->update([
                'status' => 1,
            ]);
            $message = 'Proveedor restaurado éxitosamente';
        }
        return redirect()->route('provider.index')->with('success', $message);
    }
}
