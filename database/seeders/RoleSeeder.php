<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles
        $roleAdmin = Role::create(['name' => 'administrador']);
        $roleRecepcion = Role::create(['name' => 'recepcionista']);
        $roleCliente = Role::create(['name' => 'cliente']);

        //  Permisos de Clientes
        Permission::create(['name' => 'cliente.index'])->syncRoles([$roleAdmin, $roleRecepcion]);
        Permission::create(['name' => 'cliente.store'])->syncRoles([$roleAdmin, $roleRecepcion]);
        Permission::create(['name' => 'cliente.update'])->syncRoles([$roleAdmin, $roleRecepcion]);

        // Permisos de Vehiculos
        Permission::create(['name' => 'vehiculo.index'])->syncRoles([$roleAdmin, $roleRecepcion]);
        Permission::create(['name' => 'vehiculo.store'])->syncRoles([$roleAdmin, $roleRecepcion]);
        Permission::create(['name' => 'vehiculo.update'])->syncRoles([$roleAdmin, $roleRecepcion]);

        // Permisos de Usuarios
        Permission::create(['name' => 'usuario.index'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'usuario.store'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'usuario.update'])->syncRoles([$roleAdmin]);

        // Permisos de Servicios
        Permission::create(['name' => 'servicio.index'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'servicio.store'])->syncRoles([$roleAdmin]);

        //  Permisos de Mecanicos
        Permission::create(['name' => 'mecanico.index'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'mecanico.store'])->syncRoles([$roleAdmin]);
        Permission::create(['name' => 'mecanico.update'])->syncRoles([$roleAdmin]);

    }
}
