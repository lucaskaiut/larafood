<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            /*
             * Plans
             */
            [
                'name' => 'view_plans',
                'description' => 'Permissão para visualizar os planos',
            ],
            [
                'name' => 'edit_plans',
                'description' => 'Permissão para editar os planos',
            ],
            [
                'name' => 'add_plans',
                'description' => 'Permissão para adicionar planos',
            ],
            [
                'name' => 'delete_plans',
                'description' => 'Permissão para apagar planos',
            ],

            /*
             * Profiles
             */
            [
                'name' => 'view_profiles',
                'description' => 'Permissão para visualizar perfis',
            ],
            [
                'name' => 'edit_profiles',
                'description' => 'Permissão para editar perfis',
            ],
            [
                'name' => 'add_profiles',
                'description' => 'Permissão para adicionar perfis',
            ],
            [
                'name' => 'delete_profiles',
                'description' => 'Permissão para apagar perfis',
            ],

            /*
             * Permissions
             */
            [
                'name' => 'view_permissions',
                'description' => 'Permissão para visualizar permissões',
            ],
            [
                'name' => 'edit_permissions',
                'description' => 'Permissão para editar permissões',
            ],
            [
                'name' => 'add_permissions',
                'description' => 'Permissão para adicionar permissões',
            ],
            [
                'name' => 'delete_permissions',
                'description' => 'Permissão para apagar permissões',
            ],

            /*
             * Users
             */
            [
                'name' => 'view_users',
                'description' => 'Permissão para visualizar usuários',
            ],
            [
                'name' => 'edit_users',
                'description' => 'Permissão para editar usuários',
            ],
            [
                'name' => 'add_users',
                'description' => 'Permissão para adicionar usuários',
            ],
            [
                'name' => 'delete_users',
                'description' => 'Permissão para apagar usuários',
            ],

            /*
             * Categories
             */
            [
                'name' => 'view_categories',
                'description' => 'Permissão para visualizar categorias',
            ],
            [
                'name' => 'edit_categories',
                'description' => 'Permissão para editar categorias',
            ],
            [
                'name' => 'add_categories',
                'description' => 'Permissão para adicionar categorias',
            ],
            [
                'name' => 'delete_categories',
                'description' => 'Permissão para apagar categorias',
            ],

            /*
             * Products
             */
            [
                'name' => 'view_products',
                'description' => 'Permissão para visualizar produtos',
            ],
            [
                'name' => 'edit_products',
                'description' => 'Permissão para editar produtos',
            ],
            [
                'name' => 'add_products',
                'description' => 'Permissão para adicionar produtos',
            ],
            [
                'name' => 'delete_products',
                'description' => 'Permissão para apagar produtos',
            ],

            /*
             * Tables
             */
            [
                'name' => 'view_tables',
                'description' => 'Permissão para visualizar mesas',
            ],
            [
                'name' => 'edit_tables',
                'description' => 'Permissão para editar mesas',
            ],
            [
                'name' => 'add_tables',
                'description' => 'Permissão para adicionar mesas',
            ],
            [
                'name' => 'delete_tables',
                'description' => 'Permissão para apagar mesas',
            ],

            /*
             * Tenants
             */
            [
                'name' => 'view_tenants',
                'description' => 'Permissão para visualizar empresas',
            ],
            [
                'name' => 'edit_tenants',
                'description' => 'Permissão para editar empresas',
            ],
            [
                'name' => 'add_tenants',
                'description' => 'Permissão para adicionar empresas',
            ],
            [
                'name' => 'delete_tenants',
                'description' => 'Permissão para apagar empresas',
            ],
        ];

        foreach($permissions as $permission){
            Permission::create([
                'name' => $permission['name'],
                'description' => $permission['description'],
            ]);
        }

    }
}
