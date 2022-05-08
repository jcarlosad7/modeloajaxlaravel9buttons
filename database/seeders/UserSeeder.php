<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permisos
        Permission::create(['name' => 'escritorio']);
        Permission::create(['name' => 'rol-listar']);
        Permission::create(['name' => 'rol-crear']);
        Permission::create(['name' => 'rol-editar']);
        Permission::create(['name' => 'rol-eliminar']);
        Permission::create(['name' => 'usuario-listar']);
        Permission::create(['name' => 'usuario-crear']);
        Permission::create(['name' => 'usuario-editar']);
        Permission::create(['name' => 'usuario-activar']);
        Permission::create(['name' => 'usuario-eliminar']);
        Permission::create(['name' => 'unidadMedida-listar']);
        Permission::create(['name' => 'unidadMedida-crear']);
        Permission::create(['name' => 'unidadMedida-editar']);
        Permission::create(['name' => 'unidadMedida-eliminar']);

        //Roles
        $adminRole = Role::create(['name'  =>  'Cotizador - Admin']);
        $adminRole->givePermissionTo(Permission::all());

        $asistenteRole = Role::create(['name'  =>  'Cotizador - Asistente']);
        $asistenteRole->givePermissionTo(['escritorio']);

        $user = new User;
        $user->name = 'Admin';
        $user->email = 'admin@prueba.com';
        $user->password = bcrypt('admin');
        $user->save();
        $user->assignRole($adminRole);

        $user = new User;
        $user->name = 'Asistente';
        $user->email = 'asistente@prueba.com';
        $user->password = bcrypt('asistente');
        $user->save();
        $user->assignRole($asistenteRole);
    }
}
