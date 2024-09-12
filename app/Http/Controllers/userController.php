<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class userController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }


    public function create()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }


    public function store(StoreUserRequest $request)
    {
        try {
            DB::beginTransaction();
            $fieldHash = Hash::make($request->password);
            $request->merge(['password' => $fieldHash]);

            $user = User::create($request->all());

            $user->assignRole($request->role);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('user.index')->with('success','Usuario registrado correctamente');
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
