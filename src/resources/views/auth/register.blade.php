@extends('app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
@endsection

@section('header')
    @parent
    <a class="login__link" href="/login">
        login
    </a>
@endsection

@section('content')
    <div class="form__area">
        <h1 class="form__title">Register</h1>
        <div class="box__area">
            <form class="form" action="/register" method="post">
                @csrf
                <dl>
                    <div class="item">
                        <dt class="item__dt">お名前</dt>
                        <dd class="item__dd name__group">
                            <div class="name__item">
                                <input class="item__input" type="text" name="name" placeholder="例：山田　太郎" value="{{ old('name') }}" />
                                @error('name')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </dd>
                    </div>
                </dl>
                <dl>
                    <div class="item">
                        <dt class="item__dt">
                            メールアドレス
                        </dt>
                        <dd class="item__dd email__group">
                            <div class="email__item">
                                <input class="item__input" type="text" name="email" placeholder="例：test@example.com"
                                    value="{{ old('email') }}" />
                                <div class="error email__error">
                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </dd>
                    </div>
                </dl>
                <dl>
                    <div class="item">
                        <dt class="item__dt">
                            パスワード
                        </dt>
                        <dd class="item__dd password__group">
                            <div class="password__item">
                                <input class="item__input" type="text" name="password" placeholder="例：coachtech1106"
                                    value="{{ old('password') }}" />
                                @error('password')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </dd>
                    </div>
                </dl>
                <div class="button__area">
                    <button type="submit" class="submit__button" name="send">登録</button>
                </div>
            </form>
        </div>
    </div>
@endsection