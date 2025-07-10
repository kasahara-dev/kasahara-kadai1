@extends('app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
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
        <div class="box__area">
            <form class="form" action="/login" method="post">
                @csrf
                <dl>
                    <div class="item">
                        <dt class="item__dt">
                            <label for="kind">メールアドレス</label>
                        </dt>
                        <dd class="item__dd email__group">
                            <div class="email__item">
                                <input type="text" class="item__input" name="email" placeholder="例：test@example.com"
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
                            <label for="kind">パスワード</label>
                        </dt>
                        <dd class="item__dd password__group">
                            <div class="password__item">
                                <input type="text" name="password" class="item__input" placeholder="例：coachtech1106"
                                    value="{{ old('password') }}" />
                                @error('password')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                        </dd>
                    </div>
                </dl>
                <div class="button__area">
                    <button type="submit" class="submit__button" name="send">ログイン</button>
                </div>
            </form>
        </div>
    </div>
@endsection