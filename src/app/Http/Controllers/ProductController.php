<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Season;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $products = Product::paginate(6);

        return view('index' , compact('products'));
    }

    // 検索
    public function search(Request $request)
    {
        $query = Product::query();
        $query = $this->getSearchQuery($request, $query);

    // ソート
        $sortType = $request->input('sort');
        switch ($sortType) {
            case 'highest':
                $query->orderBy('price','desc');
                break;
            case 'lowest':
                $query->orderBy('price','asc');
                break;
            default:
                $query->orderBy('id','asc');
                break;
        }

        $products = $query->paginate(6)
                          ->appends($request->query());

        $showModal = !empty($sortType);
        $sortLabel = [
            'highest' => '高い順に表示',
            'lowest' => '低い順に表示',
        ][$sortType] ?? null;

        return view('index' , compact('products','showModal','sortLabel'));
    }

    private function getSearchQuery($request, $query){
        if(!empty($request->keyword)) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->keyword . '%');
            });
        }

        return $query;
    }

    // 詳細表示
    public function edit(Product $product)
    {
        $product->load('seasons');
        $seasons = Season::all();

        return view('update', compact('product','seasons'));
    }

    // 追加
    public function register()
    {
        $seasons = Season::all();

        return view('register', compact('seasons'));
    }

    public function create(ProductRequest $request, Product $product){
        $form = $request->all();
        $image = $request->file('image');
        $path = isset($image) ? $image->store('img', 'public') : '';
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
        ]);
        $product->seasons()->sync($request->seasons ?? []);

        return redirect('/products');
    }

    // 更新
    public function update(ProductRequest $request, Product $product)
    {
        $image = $request->file('image');
        $path = $product->image;
        if ($image) {
            if ($path) {
                \Storage::disk('public')->delete($path);
            }
            $path = $image->store('img', 'public');
        }

        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $path,
        ]);
        $product->seasons()->sync($request->seasons ?? []);

        return redirect('/products');
    }

    // 削除
    public function destroy(Product $product)
    {
        $path = $product->image;
        if ($path) {
            \Storage::disk('public')->delete($path);
        }

        Product::find($product->id)->delete();

        return redirect('/products');
    }
}
