
@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/update.css') }}"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
@endsection

@section('content')
<div class="page-route">
    <a class="products-page__link" href="/products">商品一覧</a>
    <p class="detail-page">&gt;{{ $product->name }}</p>
</div>

<form class="update-form" action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
@csrf
    <div class="form-group__image">        
        <img class="image-item" src="{{Storage::url($product->image)}}" alt="商品画像">
        <input class="form-input__image" type="file" name="image">
        <p class="update__error-message">
            @error('image')
                {{ $message }}
            @enderror
        </p>
    </div>
    <div class="form-group__name">
        <label class="form-header" for="name">商品名</label>
        <input class="form-input__name" type="text" name="name" id="name" value="{{ $product->name }}">
        <p class="update__error-message">
            @error('name')
                {{ $message }}
            @enderror
        </p>
    </div>
    <div class="form-group__price">
        <label class="form-header" for="price">値段</label>
        <input class="form-input__price" type="text" name="price" id="price" value="{{ $product->price }}">
        <p class="update__error-message">
            @error('price')
                {{ $message }}
            @enderror
        </p>
    </div>
    <div class="form-group__season">        
        <span class="form-header">季節</span>

        <div class="form-input__checkbox">
            @foreach($seasons as $season)
                <label class="season-item" for="season-{{ $season->id }}">
                    <input
                        type="checkbox"
                        id="season-{{ $season->id }}"
                        name="seasons[]"
                        value="{{ $season->id }}"
                        {{ in_array($season->id, old('seasons', $product->seasons->pluck('id')->toArray())) ? 'checked' : '' }}
                    >
                    <span class="custom-box"></span>
                    <span class="season-text">{{ $season->name }}</span>
                </label>
            @endforeach
        </div>

        <p class="update__error-message">
            @error('seasons')
                {{ $message }}
            @enderror
        </p>
    </div>
    <div class="form-group__description">
        <label class="form-header" for="description">商品説明</label>
        <textarea class="form-textarea__description" name="description">{{ old('description', $product->description ?? '') }}</textarea>
        <p class="update__error-message">
            @error('description')
                {{ $message }}
            @enderror
        </p>
    </div>
    <div class="form-button">
        <a class="form-button__back" href="/products">戻る</a>
        <button class="form-button__update" type="submit">変更を保存</button>
    </div>
</form>
<form class="delete-form" method="post" action="{{ route('products.delete', $product->id) }}">
    @csrf
    <button class="delede-button" type="submit">
        <i class="fas fa-trash-alt" style="color:red;"></i>
    </button>
</form>
@endsection