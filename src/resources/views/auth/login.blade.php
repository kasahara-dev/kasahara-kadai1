@extends('app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('header')
    @parent
    <a class="login__link" href="/login">
        ログイン
    </a>
@endsection

@section('content')
    <div class="form__area">
        <p class="form__title">Register</p>
        <form class="form" action="/register" method="post">
            @csrf
            <dl>
                <div class="item">
                    <dt>
                        <label for="kind">お名前</label>
                    </dt>
                    <dd class="name__group">
                        <div class="name__item">
                            <input type="text" name="name" placeholder="例：山田　太郎" value="{{ old('name') }}" />
                            @error('name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </dd>
                </div>
            </dl>
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
            <button type="submit" class="btn__submit" name="send">登録</button>
        </form>
    </div>
@endsection