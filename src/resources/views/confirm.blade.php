@extends('app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
    <div class="confirm-area">
        <p class="form__title">Confirm</p>
        <dl>
            <div class="item">
                <dt>
                    <label for="kind">お名前</label>
                </dt>
                <dd class="name__group">
                    <div class="name__item">{{ $last_name . '　' . $first_name }}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">性別</label>
                </dt>
                <dd class="gender__group">
                    <div class="gender__item">
                        @if($gender == '1')
                            男性
                        @elseif($gender == '2')
                            女性
                        @else
                            その他
                        @endif
                    </div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">メールアドレス</label>
                </dt>
                <dd class="email__group">
                    <div class="email__item">{{ $email }}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">電話番号</label>
                </dt>
                <dd class="tel__group">
                    <div class="tel__item">{{ $tel }}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">住所</label>
                </dt>
                <dd class="address__group">
                    <div class="address__item">{{ $address }}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">建物名</label>
                </dt>
                <dd class="building__group">
                    <div class="building__item">{{ $building }}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">お問い合わせの種類</label>
                </dt>
                <dd class="category__group">
                    <div class="category__item">{{ $category_name }}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">お問い合わせ内容</label><span class="require">※</span>
                </dt>
                <dd class="detail__group">
                    <div class="detail__item">{{ $detail }}</div>
                </dd>
            </div>
        </dl>
        <div class="button-area">
            <button type="submit" class="btn__submit" name="send">修正</button>
            <a class="link__back" name="back" href="/">戻る</a>
        </div>
    </div>
@endsection