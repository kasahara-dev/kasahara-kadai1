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
                    <div class="name__item">{{ session('last_name') . '　' . session('first_name')}}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">性別</label>
                </dt>
                <dd class="gender__group">
                    <div class="gender__item">
                        @if(session('gender') == '1')
                            {{ config('gender.1') }}
                        @elseif(session('gender') == '2')
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
                    <div class="email__item">{{ session('email') }}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">電話番号</label>
                </dt>
                <dd class="tel__group">
                    <div class="tel__item">{{ session('tel') }}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">住所</label>
                </dt>
                <dd class="address__group">
                    <div class="address__item">{{ session('address') }}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">建物名</label>
                </dt>
                <dd class="building__group">
                    <div class="building__item">{{ session('building') }}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">お問い合わせの種類</label>
                </dt>
                <dd class="category__group">
                    <div class="category__item">{{ session('category_name') }}</div>
                </dd>
            </div>
            <div class="item">
                <dt>
                    <label for="kind">お問い合わせ内容</label><span class="require">※</span>
                </dt>
                <dd class="detail__group">
                    <div class="detail__item">{{ session('detail') }}</div>
                </dd>
            </div>
        </dl>
        <div class="button__area">
            <form class="form" action="/confirm" method="get">
                <input type="hidden" name="first_name" value="{{ session('first_name') }}">
                <input type="hidden" name="last_name" value="{{ session('last_name') }}">
                <input type="hidden" name="gender" value="{{ session('gender') }}">
                <input type="hidden" name="tel" value="{{ session('tel') }}">
                <input type="hidden" name="email" value="{{ session('email') }}">
                <input type="hidden" name="address" value="{{ session('address') }}">
                <input type="hidden" name="building" value="{{ session('building') }}">
                <input type="hidden" name="category_id" value="{{ session('category_id') }}">
                <input type="hidden" name="detail" value="{{ session('detail') }}">
                <button type="submit" class="btn__submit" name="send">送信</button>
                <a class="link__back" name="revise" href="{{ route('.revise', [
        'revise' => true,
        'first_name' => session('first_name'),
        'last_name' => session('last_name'),
        'gender' => session('gender'),
        'tel1' => session('tel1'),
        'tel2' => session('tel2'),
        'tel3' => session('tel3'),
        'email' => session('email'),
        'address' => session('address'),
        'building' => session('building'),
        'category_id' => session('category_id'),
        'detail' => session('detail')
    ]) }}">修正</a>
            </form>
        </div>
    </div>
@endsection