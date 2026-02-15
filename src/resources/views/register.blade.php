@extends('layouts/app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/register.css') }}"/>
@endsection

@section('content')
<div class="register-content">
    <h2 class="register-title">商品登録</h2>

    <form class="register-form" action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label class="form-header" for="name">商品名<span class="register-form__required">必須</span></label>
        <input class="form-input__name" type="text" name="name" placeholder="商品名を入力" id="name" value="{{ old('name') }}">
        <p class="register__error-message">
            @error('name')
                {{ $message }}
            @enderror
        </p>

        <label class="form-header" for="price">値段<span class="register-form__required">必須</span></label>
        <input class="form-input__price" type="text" name="price" placeholder="値段を入力" id="price" value="{{ old('price') }}">
        <p class="register__error-message">
            @error('price')
                {{ $message }}
            @enderror
        </p>

        <label class="form-header" for="image">商品画像<span class="register-form__required">必須</span></label>
        <input class="form-input__image"type="file" name="image" id="image" value="{{ 'image' }}">
        <p class="register__error-message">
            @error('image')
                {{ $message }}
            @enderror
        </p>

        <p class="form-header" for="season">
            季節
            <span class="register-form__required">必須</span>
            <span class="register-form__multiple">複数選択可</span>
        </p>
        <div class="form-input__checkbox">
            @foreach($seasons as $season)
                <label class="season-item" for="season-{{ $season->id }}">
                    <input type="checkbox" id="season-{{ $season->id }}" name="seasons[]" value="{{ $season->id }}"{{ in_array($season->id, old('seasons', [])) ? 'checked' : '' }}>
                    <span class="custom-box"></span>
                    <span class="season-text">{{ $season->name }}</span>
                </label>
            @endforeach
        </div>        
        <p class="register__error-message">
            @error('seasons')
                {{ $message }}
            @enderror
        </p>

        <label class="form-header" for="description">商品説明<span class="register-form__required">必須</span></label>
        <textarea class="form-textarea__description" name="description">{{ old('description') }}</textarea>
        <p class="register__error-message">
            @error('description')
                {{ $message }}
            @enderror
        </p>

        <div class="form-button">
            <a class="form-button__back" href="/products">戻る</a>
            <button class="form-button__add" type="submit">登録</button>
            {{ csrf_field() }}
        </div>
    </form>
</div> 

@endsection