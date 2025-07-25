@extends('app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}">
@endsection

@section('content')
    <div class="confirm__area">

        <h1 class="form__title">Confirm</h1>

        <table class="table__area">
            <tr class="item">
                <th class="table__th">
                    お名前
                </th>
                <td class="table__td name__group">
                    <div class="name__item">{{ $form['last_name'] . '　' . $form['first_name']}}</div>
                </td>
            </tr>
            <tr class="item">
                <th class="table__th">
                    性別
                </th>
                <td class="table__td gender__group">
                    <div class="gender__item">
                        @if($form['gender'] == '1')
                            {{ config('gender.1') }}
                        @elseif($form['gender'] == '2')
                            {{ config('gender.2') }}
                        @else
                            {{ config('gender.3') }}
                        @endif
                    </div>
                </td>
            </tr>
            <tr class="item">
                <th class="table__th">
                    メールアドレス
                </th>
                <td class="table__td email__group">
                    <div class="email__item">{{ $form['email'] }}</div>
                </td>
            </tr>
            <tr class="item">
                <th class="table__th">
                    電話番号
                </th>
                <td class="table__td tel__group">
                    <div class="tel__item">{{ $form['tel'] }}</div>
                </td>
            </tr>
            <tr class="item">
                <th class="table__th">
                    住所
                </th>
                <td class="table__td address__group">
                    <div class="address__item">{{ $form['address'] }}</div>
                </td>
            </tr>
            <tr class="item">
                <th class="table__th">
                    建物名
                </th>
                <td class="table__td building__group">
                    <div class="building__item">{{ $form['building'] }}</div>
                </td>
            </tr>
            <tr class="item">
                <th class="table__th">
                    お問い合わせの種類
                </th>
                <td class="table__td category__group">
                    <div class="category__item">{{ $form['category_name'] }}</div>
                </td>
            </tr>
            <tr class="item">
                <th class="table__th">
                    お問い合わせの商品
                </th>
                <td class="table__td item__group">
                    <div class="item__item">{{ $form['item_name'] }}</div>
                </td>
            </tr>
            <tr class="item">
                <th class="table__th detail__th">
                    お問い合わせ内容
                </th>
                <td class="table__td detail__group">
                    <div class="detail__item">{{ $form['detail'] }}</div>
                </td>
            </tr>
            <tr class="item">
                <th class="table__th channel__th">
                    どこで知りましたか？
                </th>
                <td class="table__td channel__group">
                    @if (isset($form["channel_name"]) and $form["channel_name"] != null)
                        @foreach ($form["channel_name"] as $channel_name)
                            <div class="channel__item">{{ $channel_name }}</div>
                        @endforeach
                    @endif
                </td>
            </tr>
            <tr class="item">
                <th class="table__th picture__th">
                    画像ファイル
                </th>
                <td class="table__td picture__group">
                    @if (isset($url) and $url != null and $url != '')
                        <div class="picture__item"><img src="{{ $url }}" alt="選択した画像" class="picture__img"></div>
                    @endif
                </td>
            </tr>
        </table>
        <form class="form" action="/thanks" method="post">
            @csrf
            <div class="button__area">
                <input type="hidden" name="first_name" value="{{ $form['first_name'] }}" />
                <input type="hidden" name="last_name" value="{{ $form['last_name'] }}" />
                <input type="hidden" name="gender" value="{{ $form['gender'] }}" />
                <input type="hidden" name="tel" value="{{ $form['tel'] }}" />
                <input type="hidden" name="email" value="{{ $form['email'] }}" />
                <input type="hidden" name="address" value="{{ $form['address'] }}" />
                <input type="hidden" name="building" value="{{ $form['building'] }}" />
                <input type="hidden" name="category_id" value="{{ $form['category_id'] }}" />
                <input type="hidden" name="item_id" value="{{ $form['item_id'] }}" />
                <input type="hidden" name="detail" value="{{ $form['detail'] }}" />
                @if (isset($form["channel_id"]) and $form["channel_id"] != null)
                    @foreach ($form["channel_id"] as $channel_id)
                        <input type="hidden" name="channel_id[]" value="{{ $channel_id }}" />
                    @endforeach
                @endif
                @if(isset($fileName) and $fileName != null)
                    <input type="hidden" name="img_path" value="contact/{{ $fileName }}" />
                @endif
                <button type="submit" class="submit__button" name="send">送信</button>
                <a class="link__back" name="revise"
                    href="{{ route('.revise', ['revise' => true, 'first_name' => $form['first_name'], 'last_name' => $form['last_name'], 'gender' => $form['gender'], 'tel1' => $form['tel1'], 'tel2' => $form['tel2'], 'tel3' => $form['tel3'], 'email' => $form['email'], 'address' => $form['address'], 'building' => $form['building'], 'category_id' => $form['category_id'], 'item_id' => $form['item_id'], 'detail' => $form['detail'], "channel_id" => $form["channel_id"] ?? null, "fileName" => $fileName]) }}">修正</a>
            </div>
        </form>
    </div>
@endsection