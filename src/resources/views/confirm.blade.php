@extends('app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
    <div class="confirm__area">

        <p class="form__title">Confirm</p>

        <dl>
            <div class="item">
                <dt>
                    <label for="kind">お名前</label>
                </dt>
                <dd class="name__group">
                    <div class="name__item">{{ $form['last_name'] . '　' . $form['first_name']}}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">性別</label>
                </dt>
                <dd class="gender__group">
                    <div class="gender__item">
                        @if($form['gender'] == '1')
                            {{ config('gender.1') }}
                        @elseif($form['gender'] == '2')
                            {{ config('gender.2') }}
                        @else
                            {{ config('gender.3') }}
                        @endif
                    </div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">メールアドレス</label>
                </dt>
                <dd class="email__group">
                    <div class="email__item">{{ $form['email'] }}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">電話番号</label>
                </dt>
                <dd class="tel__group">
                    <div class="tel__item">{{ $form['tel'] }}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">住所</label>
                </dt>
                <dd class="address__group">
                    <div class="address__item">{{ $form['address'] }}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">建物名</label>
                </dt>
                <dd class="building__group">
                    <div class="building__item">{{ $form['building'] }}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">お問い合わせの種類</label>
                </dt>
                <dd class="category__group">
                    <div class="category__item">{{ $form['category_name'] }}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">お問い合わせ内容</label><span class="require">※</span>
                </dt>
                <dd class="detail__group">
                    <div class="detail__item">{{ $form['detail'] }}</div>
                </dd>
            </div>
        </dl>
        <form class="form" action="/thanks" method="post">
            @csrf
            <div class="button__area">
                <input type="hidden" name="first_name" value="{{ $form['first_name'] }}" />
                <input type="hidden" name="last_name" value="{{ $form['last_name'] }}" />
                <input type="hidden" name="gender" value="{{ $form['gender'] }}" />
                <input type="hidden" name="tel1" value="{{ $form['tel1'] }}" />
                <input type="hidden" name="tel2" value="{{ $form['tel2'] }}" />
                <input type="hidden" name="tel3" value="{{ $form['tel3'] }}" />

                <input type="hidden" name="tel" value="{{ $form['tel'] }}" />
                <input type="hidden" name="email" value="{{ $form['email'] }}" />
                <input type="hidden" name="address" value="{{ $form['address'] }}" />
                <input type="hidden" name="building" value="{{ $form['building'] }}" />
                <input type="hidden" name="category_id" value="{{ $form['category_id'] }}" />
                <input type="hidden" name="detail" value="{{ $form['detail'] }}" />
                <button type="submit" class="btn__submit" name="send">送信</button>
                <a class="link__back" name="revise" href="{{ route('.revise') }}">修正</a>
            </div>
        </form>
    </div>
@endsection