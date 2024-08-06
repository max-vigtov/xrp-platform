<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class clientController extends Controller
{

    public function index()
    {
        return view('client.index');
    }

    public function create()
    {
        return view('client.create');
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
