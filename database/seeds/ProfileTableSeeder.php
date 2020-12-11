<?php

use App\Models\Permission;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $profile = Profile::create([
            'name' => 'Administrador',
            'description' => 'Perfil padrão do sistema. Possui todas as permissões'
        ]);

        $permissions = Permission::all();

        $profile->permissions()->attach($permissions);

        $plan = Plan::first();

        $plan->profiles()->attach($profile);
    }
}
