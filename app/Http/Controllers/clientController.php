<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\Document;
use App\Models\Person;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\Request;

class clientController extends Controller
{

    public function index()
    {
        $clients = Client::with('person.document')->get();
        return view('client.index', compact('clients'));
    }


    public function create()
    {
        $documents = Document::all();
        return view('client.create', compact('documents'));
    }


    public function store(StorePersonRequest $request)
    {
        try {
            DB::beginTransaction();
            $person = Person::create($request->validated());
            $person->client()->create([
                'person_id' => $person->id
            ]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect()->route('client.index')->with('success', 'Cliente registrado éxitosamente');

    }

    public function show(string $id)
    {
        //
    }


    public function edit(Client $client)
    {
        $client->load('person.document');
        $documents = Document::all();
        return view('client.edit',compact('client','documents'));
    }


    public function update(UpdateClientRequest $request, Client $client)
    {
        try {
            DB::beginTransaction();

            Person::where('id',$client->person->id)
            ->update($request->validated());
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return redirect()->route('client.index')->with('success', 'Cliente actualizado éxitosamente');

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
            $message = 'Cliente eliminado éxitosamente';
        }

        else{
            Person::where('id',$person->id)
            ->update([
                'status' => 1,
            ]);
            $message = 'Cliente restaurado éxitosamente';
        }
        return redirect()->route('client.index')->with('success', $message);
    }
}
