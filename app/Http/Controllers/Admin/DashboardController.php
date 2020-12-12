<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Table;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $tenant = Auth()->user()->tenant;

        $users = User::where('tenant_id', $tenant->id)->count();

        $tables = Table::count();

        $categories = Category::count();

        $products = Product::count();

        $tenants = Tenant::count();

        $data = [
            'users' => $users,
            'tables' => $tables,
            'categories' => $categories,
            'products' => $products,
            'tenants' => $tenants,
        ];

        return view('admin.pages.home.index', $data);
    }
}
