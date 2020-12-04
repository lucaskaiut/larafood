<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Database\Seeder;

class TenantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();

        $plan->tenants()->create([
            'cnpj' => '23254406000104',
            'name' => 'OnWay Soluções em Tecnologia',
            'url' => 'onway-solucoes-em-tecnologia',
            'email' => 'lucas@onway.com.br'
        ]);
    }
}
