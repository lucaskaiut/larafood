<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class PermissionRoleController extends Controller
{
    private $role, $permission;

    public function __construct(Role $role, Permission $permission){
        $this->role = $role;
        $this->permission = $permission;
    }

    public function permissionsAvailableToRole(Request $request, $roleId){
        if(!$role = $this->role->find($roleId))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'role' => $role,
            'permissions' => $role->permissionsAvailable($request->filter)
        ];

        return view('admin.pages.roles.permissions.available', $data);
    }

    public function attachPermissionsToRole($roleId, Request $request){
        if(!isset($request->permissions) || count($request->permissions) < 1)
            return redirect()
                ->back()
                ->with('error', 'Selecione pelo menos uma permissão para vincular');

        if(!$role = $this->role->find($roleId))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $role->permissions()
            ->attach($request->permissions);

        return redirect()
            ->route('roles.show', $roleId)
            ->with('success', 'Permissões adicionadas com sucesso');
    }

    public function detachPermissionsToRole($roleId, Request $request){
        if(!isset($request->permissions) || count($request->permissions) < 1)
            return redirect()
                ->back()
                ->with('error', 'Selecione pelo menos uma permissão para remover');

        if(!$role = $this->role->find($roleId))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $role->permissions()
            ->detach($request->permissions);

        return redirect()
            ->route('roles.show', $roleId)
            ->with('success', 'Permissões removidas com sucesso');
    }
}
