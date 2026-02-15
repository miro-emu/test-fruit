@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/index.css') }}"/>
@endsection

@section('content')


<div class="product-content">

    <div class="product-content__side">
        <h2 class="page-title">商品一覧</h2>
        <form class="serch-form" action="/products/search" method="get">
            @csrf
            <input class="serch-keyword" type="text" name="keyword" placeholder="商品名で検索" value="{{ old('keyword') }}">
            <button class="serch-button" type="submit">検索</button>
            <div class="sort-title">
                <p class="sort-title__price">価格順で表示</p>
            </div>
            <div class="select-icon">
                <select class="sort-item__select" name="sort">
                    <option value="">価格で並び替え</option>
                    <option value="highest" {{ request('sort') == "highest" ? 'selected' : '' }}>高い順に表示</option>
                    <option value="lowest" {{ request('sort') == "lowest" ? 'selected' : '' }}>低い順に表示</option>
                </select>
            </div>
        </form>
    </div>

    <div class="product-content__main">

        <div class="register-button__item">
            <a class="register-button" href="/products/register">＋商品を追加</a>
        </div>
        
        <div class="product-card__wrap">
            @foreach ($products as $product)
            <a class="product-card" href="{{ route('products.edit', $product->id) }}">
                <div class="card-img">
                    <img src="{{Storage::url($product->image)}}" alt="商品画像">
                </div>
                <div class="card-text">
                    <p class="fruit-name">{{$product->name}}</p>
                    <p class="fruit-price">￥{{$product->price}}</p>
                </div>
            </a>
            @endforeach
        </div>
        <div class="paginate">
            {{ $products->links() }}
        </div>
    </div>

</div>




@endsection


