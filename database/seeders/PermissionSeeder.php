<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [

            //  Category
            'ver-categoría',
            'crear-categoría',
            'editar-categoría',
            'eliminar-categoría',

            //  Client
            'ver-cliente',
            'crear-cliente',
            'editar-cliente',
            'eliminar-cliente',

            // Purchase
            'ver-compra',
            'crear-compra',
            'mostrar-compra',
            'eliminar-compra',

            //  Brand
            'ver-marca',
            'crear-marca',
            'editar-marca',
            'eliminar-marca',

            //  Product
            'ver-producto',
            'crear-producto',
            'editar-producto',
            'eliminar-producto',

            //  Provider
            'ver-proveedor',
            'crear-proveedor',
            'editar-proveedor',
            'eliminar-proveedor',

            // Sale
            'ver-venta',
            'crear-venta',
            'mostrar-venta',
            'eliminar-venta',

            // Roles
            'ver-rol',
            'crear-rol',
            'editar-rol',
            'eliminar-rol',

            // User
            'ver-user',
            'crear-user',
            'editar-user',
            'eliminar-user',

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
