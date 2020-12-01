<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Profile;
use Illuminate\Http\Request;

class PlanProfileController extends Controller
{
    private $plan, $profile;

    public function __construct(Plan $plan, Profile $profile){
        $this->plan = $plan;
        $this->profile = $profile;
    }

    public function profiles($url){
        if(!$plan = $this->plan->where('url', $url)->first())
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'plan' => $plan,
            'profiles' => $plan->profiles()->paginate()
        ];

        return view('admin.pages.plans.profiles.profiles', $data);
    }

    public function availableProfiles(Request $request, $url){
        if(!$plan = $this->plan->where('url', $url)->first())
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'plan' => $plan,
            'profiles' => $plan->profilesAvailable($request->filter)
        ];

        return view('admin.pages.plans.profiles.available', $data);
    }

    public function attachProfile(Request $request, $url){
        if(!$plan = $this->plan->where('url', $url)->first())
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        if(!isset($request->profiles) || count($request->profiles) == 0)
            return redirect()
                ->back()
                ->with('error', 'Selecione pelo menos um perfil para vincular');

        $plan->profiles()->attach($request->profiles);

        return redirect()
            ->route('plans.profiles', $plan->url)
            ->with('success', 'Permissões vinculadas com sucesso');
    }

    public function detachProfile(Request $request, $url){
        if(!$plan = $this->plan->where('url', $url)->first())
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        if(!isset($request->profiles) || count($request->profiles) == 0)
            return redirect()
                ->back()
                ->with('error', 'Selecione pelo menos um perfil para desvincular');

        $plan->profiles()->detach($request->profiles);

        return redirect()
            ->route('plans.profiles', $plan->url)
            ->with('success', 'Permissões desvinculadas com sucesso');
    }
}
