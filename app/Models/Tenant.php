<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = ['cnpj', 'name', 'url', 'email', 'logo', 'active', 'subscription', 'expires_at', 'subscription_id', 'subscription_ative', 'subscription_suspended'];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function plan(){
        return $this->belongsTo(Plan::class);
    }

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function tables(){
        return $this->hasMany(Table::class);
    }
}
