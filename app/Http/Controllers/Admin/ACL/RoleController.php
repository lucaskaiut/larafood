<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateRole;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $repository;

    public function __construct(Role $role){
        $this->repository = $role;
    }

    public function index(){
        $this->authorize('view_roles');

        $data =[
            'roles' => $this->repository->paginate()
        ];

        return view('admin.pages.roles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $this->authorize('add_roles');

        return view('admin.pages.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateRole $request){
        $this->authorize('add_roles');

        $this->repository->create($request->except('_token'));

        return redirect()
            ->route('roles.index')
            ->with('success', 'Cargo cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $this->authorize('view_roles');

        if(!$role = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'role' => $role,
            'permissions' => $role->permissions()->paginate()
        ];

        return view('admin.pages.roles.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $this->authorize('edit_roles');

        if(!$role = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'role' => $role
        ];

        return view('admin.pages.roles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateRole $request, $id){
        $this->authorize('edit_roles');

        if(!$role = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $role->update($request->all());

        return redirect()
            ->route('roles.index')
            ->with('success', "Cargo {$role->name} alterado com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $this->authorize('delete_roles');

        if(!$role = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        if($role->permissions()->count() > 0)
            return redirect()
                ->back()
                ->with('error', "Não é possível apagar esse cargo pois existe(m) {$role->permissions()->count()} permissão(oes) vinculada(s)");

        $role->delete();

        return redirect()
            ->route('roles.index')
            ->with('success', 'Cargo apagado com sucesso');
    }

    public function search(StoreUpdateRole $request){
        $this->authorize('view_roles');

        $data = [
            'roles' => $this->repository->search($request->filter),
            'filters' => $request->except('_token')
        ];

        return view('admin.pages.roles.index', $data);
    }
}
