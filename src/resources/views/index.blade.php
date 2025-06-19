@extends('app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="form-area">
        <p class="form__title">Contact</p>
        <form class="form" action="/confirm" method="get">
            @csrf
            <dl>
                <div class="item">
                    <dt>
                        <label for="kind">お名前</label><span class="require">※</span>
                    </dt>
                    <dd class="name__group">
                        <div class="name__item"><input type="text" name="first_name"></div>
                        <div class="name__item"><input type="text" name="last_name"></div>
                    </dd>
                </div>
                <div class="item">
                    <dt>
                        <label for="kind">性別</label><span class="require">※</span>
                    </dt>
                    <dd class="gender__group">
                        <div class="name__item">
                            <input type="checkbox" name="gender[]" id="gender-1" value="男性"><label for="gender-1">男性</label>
                        </div>
                        <div class="name__item">
                            <input type="checkbox" name="gender[]" id="gender-2" value="女性"><label for="gender-2">女性</label>
                        </div>
                        <div class="name__item">
                            <input type="checkbox" name="gender[]" id="gender-3" value="その他"><label
                                for="gender-3">その他</label>
                        </div>
                    </dd>
                </div>
                <div class="item">
                    <dt>
                        <label for="kind">メールアドレス</label><span class="require">※</span>
                    </dt>
                    <dd class="email__group">
                        <div class="email__item"><input type="text" name="email"></div>
                    </dd>
                </div>
                <div class="item">
                    <dt>
                        <label for="kind">電話番号</label><span class="require">※</span>
                    </dt>
                    <dd class="tel__group">
                        <div class="tel__item"><input type="text" name="tel1"></div>
                        <div class="tel__item"><input type="text" name="tel2"></div>
                        <div class="tel__item"><input type="text" name="tel3"></div>
                    </dd>
                </div>
                <div class="item">
                    <dt>
                        <label for="kind">住所</label><span class="require">※</span>
                    </dt>
                    <dd class="address__group">
                        <div class="address__item"><input type="text" name="address"></div>
                    </dd>
                </div>
                <div class="item">
                    <dt>
                        <label for="kind">建物名</label>
                    </dt>
                    <dd class="building__group">
                        <div class="building__item"><input type="text" name="building"></div>
                    </dd>
                </div>
                <div class="item">
                    <dt>
                        <label for="kind">お問い合わせの種類</label><span class="require">※</span>
                    </dt>
                    <dd class="category__group">
                        <div class="category__item">
                            <!-- <select name="address" id="address-select"> -->
                        </div>
                    </dd>
                </div>
                <div class="item">
                    <dt>
                        <label for="kind">お問い合わせ内容</label><span class="require">※</span>
                    </dt>
                    <dd class="detail__group">
                        <div class="detail__item"><textarea name="detail"></textarea></div>
                    </dd>
                </div>
            </dl>
            <button type="submit" class="btn__submit" name="send">確認</button>
        </form>
    </div>
@endsection