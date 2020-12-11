<?php

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = Role::create([
            'name' => 'Administrador',
            'description' => 'Cargo padrão do sistema. Possui todas as permissões'
        ]);

        $permissions = Permission::all();

        $role->permissions()->attach($permissions);

        $user = User::first();

        $user->roles()->attach($role);
    }
}
