<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::insert([
            'name' => 'Max Vigueras Tovar',
            'email' => 'mvt.2000@hotmail.com',
            'password' => bcrypt('12345678')
        ]);

        //ADMIN USER
        $role = Role::create(['name' => 'administrador']);
        $permissions = Permission::pluck('id','id')->all();
        $role -> syncPermissions($permissions);
        $user -> assignRole('administrador');
    }
}
