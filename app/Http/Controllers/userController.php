<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class userController extends Controller
{

    function __construct()
    {
        $this->middleware('permission:ver-user|crear-user|editar-user|eliminar-user',['only'=>['index']]);
        $this->middleware('permission:crear-user',['only'=>['create','store']]);
        $this->middleware('permission:editar-user',['only'=>['edit','update']]);
        $this->middleware('permission:eliminar-user',['only'=>['destroy']]);
    }

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


    public function edit(User $user)
    {
        $roles = Role::all();
        return view('user.edit', compact('user','roles'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            DB::beginTransaction();

            if (empty($request->password)) {
                $request = Arr::except($request,array('password'));
            } else {
                $fieldHash = Hash::make($request->password);
                $request->merge(['password' => $fieldHash]);
            }

            $user->update($request->all());

            $user->syncRoles([$request->role]);

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }
        return redirect()->route('user.index')->with('success','Usuario Editado correctamente');
    }


    public function destroy(string $id)
    {
        $user = User::find($id);
        $roleUser = $user->getRoleName()->first();
        $user->romeRole($roleUser);

        $user->delete();
        return redirect()->route('user.index')->with('success','Usuario Eliminado correctamente');

    }
}
