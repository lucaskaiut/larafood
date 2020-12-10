<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTenant;
use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    private $repository;

    public function __construct(Tenant $tenant){
        $this->repository = $tenant;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view_tenants');

        $data = [
            'tenants' => $this->repository->paginate()
        ];

        return view('admin.pages.tenants.index', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view_tenants');

        if(!$tenant = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'tenant' => $tenant
        ];

        return view('admin.pages.tenants.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit_tenants');

        if(!$tenant = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'tenant' => $tenant,
            'plans' => Plan::all()
        ];

        return view('admin.pages.tenants.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTenant $request, $id)
    {
        $this->authorize('edit_tenants');

        if(!$tenant = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = $request->all();

        if($request->hasFile('logo') && $request->logo->isValid()){
            if(Storage::exists($tenant->logo))
                Storage::delete($tenant->logo);

            $extension = $request->logo->extension();
            $fileName = Str::kebab($request->name) . "." . $extension;
            $data['logo'] = $request->logo->storeAs("tenants/{$tenant->uuid}/logo", $fileName);
        }

        $tenant->update($data);

        return redirect()
            ->route('tenants.index')
            ->with('success', "Empresa {$tenant->name} alterada com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('edit_tenants');

        if(!$tenant = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $tenant->delete();

        return redirect()
            ->route('tenants.index')
            ->with('success', "Empresa {$tenant->name} apagada com sucesso");
    }
}
