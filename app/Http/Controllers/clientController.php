<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
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
