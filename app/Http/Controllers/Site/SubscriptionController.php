<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function plan($url){
        if(!$plan = Plan::where('url', $url)->first())
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        session()->put('plan', $plan);

        return redirect()
            ->route('register');
    }
}
