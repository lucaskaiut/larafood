<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateDetailPlan;
use App\Models\DetailPlan;
use App\Models\Plan;

class DetailPlanController extends Controller
{
    protected $repository;
    protected $plan;

    public function __construct(DetailPlan $detailPlan, Plan $plan){
        $this->repository = $detailPlan;
        $this->plan = $plan;
    }

    public function index($planUrl){
        if(!$plan = $this->plan->where('url', $planUrl)->first())
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado, tente novamente mais tarde!');

        $data = [
            'plan' => $plan,
            'details' => $plan->details()->paginate()
        ];

        return view('admin.pages.plans.details.index', $data);

    }

    public function create($planUrl){
        if(!$plan = $this->plan->where('url', $planUrl)->first())
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'plan' => $plan
        ];

        return view('admin.pages.plans.details.create', $data);
    }

    public function store($planUrl, StoreUpdateDetailPlan $request){
        if(!$plan = $this->plan->where('url', $planUrl)->first())
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $plan->details()->create($request->except('_token'));

        return redirect()
            ->route('plans.show', $plan->url)
            ->with('success', 'Detalhe cadastrado com sucesso!');
    }

    public function edit($planUrl, $detailId){
        if(!$plan = $this->plan->where('url', $planUrl)->first())
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
          'plan' => $plan,
          'detail' => $this->repository->find($detailId)
        ];

        return view('admin.pages.plans.details.edit', $data);
    }

    public function update(StoreUpdateDetailPlan $request, $planUrl, $detailId){
        $plan = $this->plan->where('url', $planUrl)->first();
        $detail = $this->repository->find($detailId);

        if(!$plan || !$detail)
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $detail->update($request->all());

        return redirect()
            ->route('plans.show', $plan->url)
            ->with('success', 'Detalhe editado com sucesso!');
    }

    public function destroy($planUrl, $detailId){
        if(!$detail = $this->repository->find($detailId))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $detail->delete();

        return redirect()
            ->route('plans.show', $planUrl)
            ->with('success', 'Detalhe apagado com sucesso');
    }

}
