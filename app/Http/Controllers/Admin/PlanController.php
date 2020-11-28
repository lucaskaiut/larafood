<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    private $repository;

    public function __construct(Plan $plan){
        $this->repository = $plan;
    }

    public function index(){
        $data = [
            'plans' => $this->repository->latest()->paginate()
        ];

        return view('admin.pages.plans.index', $data);
    }

    public function create(){
        return view('admin.pages.plans.create');
    }

    public function store(StoreUpdatePlan $request){
        $this->repository->create($request->except('_token'));

        return redirect()
            ->route('plans.index')
            ->with('success', 'Plano cadastrado com sucesso');
    }

    public function show($url){
        if(!$plan = $this->repository->where('url', $url)->first())
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado, tente novamente mais tarde!');

        $data = [
            'plan' => $plan,
            'details' => $plan->details()->paginate()
        ];

        return view('admin.pages.plans.show', $data);
    }

    public function destroy($url){
        if(!$plan = $this->repository
                            ->with('details')
                            ->where('url', $url)->first())
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado, tente novamente mais tarde!');

        if($plan->details->count() > 0)
            return redirect()
                ->back()
                ->with('error', "Não é possível apagar esse plano pois existem {$plan->details->count()} detalhes vínculados");

        $plan->delete();

        return redirect()->route('plans.index')->with('success', "Plano {$plan->name} excluído com sucesso!");
    }

    public function search(Request $request){
        $data = [
            'plans' => $this->repository->search($request->filter),
            'filters' => $request->except('_token')
        ];

        return view('admin.pages.plans.index', $data);
    }

    public function edit($url){
        if(!$plan = $this->repository->where('url', $url)->first())
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado, tente novamente mais tarde!');

        $data = [
            'plan' => $plan
        ];

        return view('admin.pages.plans.edit', $data);
    }

    public function update(StoreUpdatePlan $request, $url){
        $plan = $this->repository->where('url', $request->url)->first();

        $plan->update($request->except('_token'));

        return redirect()
            ->route('plans.index')
            ->with('success', "Plano {$plan->name} editado com sucesso!");
    }

}
