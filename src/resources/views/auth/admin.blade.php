@extends('app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('header')
    @parent
    <form class="form" action="/logout" method="post">
        @csrf
        <button type="submit" class="btn__submit" name="send">Logout</button>
    </form>
@endsection

@section('content')
    <div class="title__area">
        <p class="form__title">Admin</p>
    </div>
    <div class="conditions__area">
        <form class="form" action="/admin" method="get">
            <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ old('last_name') }}" />
            @php
                $gender_check = old('gender');
                if (is_null($gender_check)) {
                    $gender_check = '0';
                }
            @endphp
            <select class="select_gender" name="gender" id="select__gender">
                <option value="0" @if($gender_check == '0') selected @endif>性別</option>
                @foreach(config('gender') as $genderId => $genderName)
                    <option value="{{ $genderId }}" @if($gender_check == $genderId) selected @endif>
                        {{ $genderName }}
                    </option>
                @endforeach
            </select>
            <select class="select__category" name="category_id" id="select__category-new">
                <option value="0" @if (old('category_id') == '0' or is_null(old('category_id'))) selected @endif>選択してください
                </option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if (old('category_id') == $category->id) selected @endif>
                        {{ $category->content }}
                    </option>
                @endforeach
                </option>
            </select>
            @error('category_id')
                <div class="error">{{ $message }}</div>
            @enderror
        </form>
    </div>
    <div class="searched__area">
        <div class="searched__list">

        </div>
    </div>
@endsection