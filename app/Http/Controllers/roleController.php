<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class roleController extends Controller
{

    public function index()
    {
        $roles = Role::all();
        return view('role.index', compact('roles'));
    }


    public function create()
    {
        $permissions = Permission::all();
        return view('role.create', compact('permissions'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permission' => 'required'
        ]);

        try {
            DB::beginTransaction();
            //Crear rol
            $role = Role::create(['name' => $request->name]);

            //Asignar permisos
            $role->syncPermissions(array_map(fn($val)=>(int)$val, $request->input('permission')));

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
        }


        return redirect()->route('role.index')->with('success', 'Rol registrado');
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
