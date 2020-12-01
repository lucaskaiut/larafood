<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProfile;
use App\Models\Profile;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $repository;

    public function __construct(Profile $profile){
        $this->repository = $profile;
    }

    public function index(){
        $data =[
            'profiles' => $this->repository->paginate()
        ];

        return view('admin.pages.profiles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('admin.pages.profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProfile $request){
        $this->repository->create($request->except('_token'));

        return redirect()
            ->route('profiles.index')
            ->with('success', 'Perfil cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        if(!$profile = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'profile' => $profile,
            'permissions' => $profile->permissions()->paginate()
        ];

        return view('admin.pages.profiles.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        if(!$profile = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'profile' => $profile
        ];

        return view('admin.pages.profiles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProfile $request, $id){
        if(!$profile = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $profile->update($request->all());

        return redirect()
            ->route('profiles.index')
            ->with('success', "Perfil {$profile->name} alterado com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id){
        if(!$profile = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        if($profile->permissions()->count() > 0)
            return redirect()
                ->back()
                ->with('error', "Não é possível apagar esse perfil pois existe(m) {$profile->permissions()->count()} permissão(oes) vinculada(s)");

        $profile->delete();

        return redirect()
            ->route('profiles.index')
            ->with('success', 'Perfil apagado com sucesso');
    }

    public function search(StoreUpdateProfile $request){
        $data = [
            'profiles' => $this->repository->search($request->filter),
            'filters' => $request->except('_token')
        ];

        return view('admin.pages.profiles.index', $data);
    }
}
