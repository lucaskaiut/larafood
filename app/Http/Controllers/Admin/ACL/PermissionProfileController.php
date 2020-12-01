<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class PermissionProfileController extends Controller
{

    private $profile, $permission;

    public function __construct(Profile $profile, Permission $permission){
        $this->profile = $profile;
        $this->permission = $permission;
    }

    public function permissionsAvailableToProfile(Request $request, $profileId){
        if(!$profile = $this->profile->find($profileId))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'profile' => $profile,
            'permissions' => $profile->permissionsAvailable($request->filter)
        ];

        return view('admin.pages.profiles.permissions.available', $data);
    }

    public function attachPermissionsToProfile($profileId, Request $request){
        if(!isset($request->permissions) || count($request->permissions) < 1)
            return redirect()
                ->back()
                ->with('error', 'Selecione pelo menos uma permissão para vincular');

        if(!$profile = $this->profile->find($profileId))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $profile->permissions()
            ->attach($request->permissions);

        return redirect()
            ->route('profiles.show', $profileId)
            ->with('success', 'Permissões adicionadas com sucesso');
    }

    public function detachPermissionsToProfile($profileId, Request $request){
        if(!isset($request->permissions) || count($request->permissions) < 1)
            return redirect()
                ->back()
                ->with('error', 'Selecione pelo menos uma permissão para remover');

        if(!$profile = $this->profile->find($profileId))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $profile->permissions()
            ->detach($request->permissions);

        return redirect()
            ->route('profiles.show', $profileId)
            ->with('success', 'Permissões removidas com sucesso');
    }

}
