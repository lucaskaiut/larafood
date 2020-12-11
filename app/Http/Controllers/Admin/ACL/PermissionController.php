<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdatePermission;
use App\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $repository;

    public function __construct(Permission $permission){
        $this->repository = $permission;
    }

    public function index(){
        $this->authorize('view_permissions');

        $data =[
            'permissions' => $this->repository->paginate()
        ];

        return view('admin.pages.permissions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $this->authorize('add_permissions');

        return view('admin.pages.permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdatePermission $request){
        $this->authorize('add_permissions');

        $this->repository->create($request->except('_token'));

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permissão cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $this->authorize('view_permissions');

        if(!$permission = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'permission' => $permission
        ];

        return view('admin.pages.permissions.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $this->authorize('edit_permissions');

        if(!$permission = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'permission' => $permission
        ];

        return view('admin.pages.permissions.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdatePermission $request, $id){
        $this->authorize('edit_permissions');

        if(!$permission = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $permission->update($request->all());

        return redirect()
            ->route('permissions.index')
            ->with('success', "Permissão {$permission->name} alterado com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        $this->authorize('delete_permissions');

        if(!$permission = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $permission->delete();

        return redirect()
            ->route('permissions.index')
            ->with('success', 'Permissão apagado com sucesso');
    }

    public function search(StoreUpdatePermission $request){
        $this->authorize('view_permissions');

        $data = [
            'permissions' => $this->repository->search($request->filter),
            'filters' => $request->except('_token')
        ];

        return view('admin.pages.permissions.index', $data);
    }
}
