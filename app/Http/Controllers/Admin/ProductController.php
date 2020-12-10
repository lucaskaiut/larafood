<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private $repository;

    public function __construct(Product $product){
        $this->repository = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('view_products');

        $data = [
            'products' => $this->repository->paginate()
        ];

        return view('admin.pages.products.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('add_products');

        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProduct $request)
    {
        $this->authorize('add_products');

        $data = $request->all();

        $tenant = auth()->user()->tenant;

        if($request->hasFile('image') && $request->image->isValid()){
            $extension = $request->image->extension();
            $fileName = Str::kebab($request->name) . "." . $extension;
            $data['image'] = $request->image->storeAs("tenants/{$tenant->uuid}/products", $fileName);
        }

        $this->repository->create($data);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produto cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->authorize('view_products');

        if(!$product = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'product' => $product,
            'categories' => $product->categories()->paginate()
        ];

        return view('admin.pages.products.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('edit_products');

        if(!$product = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'product' => $product
        ];

        return view('admin.pages.products.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProduct $request, $id)
    {
        $this->authorize('edit_products');

        if(!$product = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = $request->all();

        $tenant = auth()->user()->tenant;

        if($request->hasFile('image') && $request->image->isValid()){
            if(Storage::exists($product->image))
                Storage::delete($product->image);

            $extension = $request->image->extension();
            $fileName = Str::kebab($request->name) . "." . $extension;
            $data['image'] = $request->image->storeAs("tenants/{$tenant->uuid}/products", $fileName);
        }

        $product->update($data);

        return redirect()
            ->route('products.index')
            ->with('success', "Produto {$product->name} alterado com sucesso");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete_products');

        if(!$product = $this->repository->find($id))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        if(Storage::exists($product->image))
            Storage::delete($product->image);

        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', "Produto {$product->name} apagado com sucesso");
    }

    public function search(Request $request){
        $this->authorize('view_products');

        $data = [
            'products' => $this->repository->search($request->filter),
            'filters' => $request->except('_token')
        ];

        return view('admin.pages.products.index', $data);
    }
}
