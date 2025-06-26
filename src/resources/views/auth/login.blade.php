@extends('app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('header')
    @parent
    <a class="register__link" href="/register">
        register
    </a>
@endsection

@section('content')
    <div class="form__area">
        <h1 class="form__title">Login</h1>
        <form class="form" action="/login" method="post">
            @csrf
            <dl>
                <div class="item">
                    <dt>
                        <label for="kind">メールアドレス</label>
                    </dt>
                    <dd class="email__group">
                        <div class="email__item">
                            <input type="text" name="email" placeholder="例：test@example.com" value="{{ old('email') }}" />
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </dd>
                </div>
            </dl>
            <dl>
                <div class="item">
                    <dt>
                        <label for="kind">パスワード</label>
                    </dt>
                    <dd class="password__group">
                        <div class="password__item">
                            <input type="text" name="password" placeholder="例：coachtech1106"
                                value="{{ old('password') }}" />
                            @error('password')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </dd>
                </div>
            </dl>
            <button type="submit" class="btn__submit" name="send">ログイン</button>
        </form>
    </div>
@endsection