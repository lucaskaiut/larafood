<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    private $user, $permission;

    public function __construct(User $user, Permission $permission){
        $this->user = $user;
        $this->permission = $permission;
    }

    public function rolesAvailableToUser(Request $request, $userId){
        if(!$user = $this->user->find($userId))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'user' => $user,
            'roles' => $user->rolesAvailable($request->filter)
        ];

        return view('admin.pages.users.roles.available', $data);
    }

    public function attachRolesToUser($userId, Request $request){
        if(!isset($request->roles) || count($request->roles) < 1)
            return redirect()
                ->back()
                ->with('error', 'Selecione pelo menos uma permissão para vincular');

        if(!$user = $this->user->find($userId))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $user->roles()
            ->attach($request->roles);

        return redirect()
            ->route('users.show', $userId)
            ->with('success', 'Cargos adicionadas com sucesso');
    }

    public function detachRolesToUser($userId, Request $request){
        if(!isset($request->roles) || count($request->roles) < 1)
            return redirect()
                ->back()
                ->with('error', 'Selecione pelo menos uma permissão para remover');

        if(!$user = $this->user->find($userId))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $user->roles()
            ->detach($request->roles);

        return redirect()
            ->route('users.show', $userId)
            ->with('success', 'Cargos removidas com sucesso');
    }
}
