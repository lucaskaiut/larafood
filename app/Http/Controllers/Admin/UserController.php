<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $repository;

    public function __construct(User $user){
        $this->repository = $user;
    }

    public function index(){
        $data = [
            'users' => $this->repository->tenantUser()->paginate()
        ];

        return view('admin.pages.users.index', $data);
    }

    public function create(){
        return view('admin.pages.users.create');
    }

    public function store(StoreUpdateUser $request){
        $data = $request->all();

        $data['tenant_id'] = auth()->user()->tenant_id;

        $data['password'] = bcrypt($request->password);

        $this->repository->create($data);

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário cadastrado com sucesso');
    }

    public function edit($user_id){
        if(!$user = $this->repository->tenantUser()->find($user_id))
            return redirect()
                ->back()
                ->with('warning', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'user' => $user,
        ];

        return view('admin.pages.users.edit', $data);
    }


    public function update(StoreUpdateUser $request, $user_id){
        if(!$user = $this->repository->tenantUser()->find($user_id))
            return redirect()
                ->back()
                ->with('warning', 'Algo deu errado. Tente novamente mais tarde');

        $data = $request->only(['name', 'email']);
        if($request->password)
            $data['password'] = bcrypt($request->password);

        $user->update($data);

        return redirect()
            ->route('users.index')
            ->with('success', "Usuário <b>{$user->name}</b> alterado com sucesso!");
    }

    public function show($user_id){
        if(!$user = $this->repository->tenantUser()->find($user_id))
            return redirect()
                ->back()
                ->with('warning', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'user' => $user,
        ];

        return view('admin.pages.users.show', $data);
    }

    public function destroy($user_id){
        if(!$user = $this->repository->tenantUser()->find($user_id))
            return redirect()
                ->back()
                ->with('warning', 'Algo deu errado. Tente novamente mais tarde');

        $users = $this->repository->where('tenant_id', auth()->user()->tenant_id)->get();

        if(count($users) <= 1){
            return redirect()
                ->back()
                ->with('error', 'Não foi possível apagar o usuário porque ele é o último usuário registrado no sistema');
        } elseif($user_id == auth()->user()->id){
            return redirect()
                ->back()
                ->with('error', 'Não é possível apagar o usuário logado');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'Usuário apagado com sucesso');
    }

}
