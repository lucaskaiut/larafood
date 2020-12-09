<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryProductController extends Controller
{
    private $product, $category;

    public function __construct(Product $product, Category $category){
        $this->product = $product;
        $this->category = $category;
    }

    public function categoriesAvailableToProduct(Request $request, $productId){
        if(!$product = $this->product->find($productId))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $data = [
            'product' => $product,
            'categories' => $product->categoriesAvailable($request->filter)
        ];

        return view('admin.pages.products.categories.available', $data);
    }

    public function attachCategoriesToProduct($productId, Request $request){
        if(!isset($request->categories) || count($request->categories) < 1)
            return redirect()
                ->back()
                ->with('error', 'Selecione pelo menos uma categoria para vincular');

        if(!$product = $this->product->find($productId))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $product->categories()
            ->attach($request->categories);

        return redirect()
            ->route('products.show', $productId)
            ->with('success', 'Categorias adicionadas com sucesso');
    }

    public function detachCategoriesToProduct($productId, Request $request){
        if(!isset($request->categories) || count($request->categories) < 1)
            return redirect()
                ->back()
                ->with('error', 'Selecione pelo menos uma categoria para remover');

        if(!$product = $this->product->find($productId))
            return redirect()
                ->back()
                ->with('error', 'Algo deu errado. Tente novamente mais tarde');

        $product->categories()
            ->detach($request->categories);

        return redirect()
            ->route('products.show', $productId)
            ->with('success', 'Categorias removidas com sucesso');
    }
}
