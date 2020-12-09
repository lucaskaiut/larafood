<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'url', 'image'];

    use TenantTrait;

    public function search($filter = null){
        $results = $this
            ->where('name', 'LIKE', "%{$filter}%")
            ->orWhere('description', 'LIKE', "%{$filter}%")
            ->paginate();

        return $results;
    }

    public function categories(){
        return $this->belongsToMany(Category::class);
    }

    public function tenant(){
        return $this->belongsTo(Tenant::class);
    }
}
