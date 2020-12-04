<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();

        $tenant->users()->create([
            'name' => 'Lucas Kaiut de Souza',
            'email' => 'kaiutdesouza042@gmail.com',
            'password' => bcrypt('@Swordart99')
        ]);
    }
}
