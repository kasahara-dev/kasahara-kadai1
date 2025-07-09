@extends('app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="form__area">
        <h1 class="form__title">Contact</h1>
        <form class="form" action="/confirm" method="get">
            @csrf
            <table class="table">
                <tr>
                    <th class="table__item name__th">お名前<span class="require">※</span>
                    </th>
                    <td class="name__group">
                        <div class="name__item">
                            <input type="text" class="name__input" name="last_name" placeholder="例：山田"
                                value="{{ old('last_name') }}" />
                            <div class="error">
                                @error('last_name'){{ $message }}@enderror
                            </div>
                        </div>
                        <div class="name__item">
                            <input type="text" class="name__input" name="first_name" placeholder="例：太郎"
                                value="{{ old('first_name') }}" />
                            <div class="error">
                                @error('first_name'){{ $message }}@enderror
                            </div>
                        </div>
                    </td>
                </tr>
                <tr class="gender__tr">
                    <th class="table__item gender__th" rowspan="2">性別<span class="require">※</span>
                    </th>
                    <td class="gender__group">
                        <div class="gender__item">
                            <label class="gender__label">
                                <input type="radio" class="gender__radio" name="gender" id="gender-1" value="1"
                                    @if(old('gender', '1') != '2' and old('gender', '1') != '3') checked @endif />
                                {{ config('gender.1') }}
                            </label>
                        </div>
                        <div class="gender__item">
                            <label class="gender__label">
                                <input type="radio" class="gender__radio" name="gender" id="gender-2" value="2"
                                    @if(old('gender', '1') == '2') checked @endif />
                                {{ config('gender.2') }}
                            </label>
                        </div>
                        <div class="gender__item">
                            <label class="gender__label">
                                <input type="radio" class="gender__radio" name="gender" id="gender-3" value="3"
                                    @if(old('gender', '1') == '3') checked @endif />
                                {{ config('gender.3') }}
                            </label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="error gender__error">
                            @error('gender')
                                {{ $message }}
                            @enderror
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="table__item">メールアドレス<span class="require">※</span>
                    </th>
                    <td class="email__group">
                        <div class="email__item">
                            <input type="text" class="email__input" name="email" placeholder="例：test@example.com"
                                value="{{ old('email') }}" />
                            <div class="error">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="table__item">電話番号<span class="require">※</span>
                    </th>
                    <td class="tel__group">
                        <div class="tel__item">
                            <input type="text" name="tel1" class="tel__input" placeholder="080" value="{{ old('tel1') }}" />
                            <div class="error tel__error">
                                @error('tel1'){!! nl2br(e($message)) !!}@enderror
                            </div>
                        </div>
                        &emsp;-&emsp;
                        <div class="tel__item">
                            <input type="text" name="tel2" class="tel__input" placeholder="1234"
                                value="{{ old('tel2') }}" />
                            <div class="error tel__error">
                                @error('tel2'){!! nl2br(e($message)) !!}@enderror
                            </div>
                        </div>
                        &emsp;-&emsp;
                        <div class="tel__item">
                            <input type="text" name="tel3" class="tel__input" placeholder="5678"
                                value="{{ old('tel3') }}" />
                            <div class="error tel__error">
                                @error('tel3'){!! nl2br(e($message)) !!}@enderror
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="table__item">住所<span class="require">※</span>
                    </th>
                    <td class="address__group">
                        <div class="address__item">
                            <input type="text" name="address" class="address__input" placeholder="例：東京都千代田区千駄ヶ谷1-2-3"
                                value="{{ old('address') }}" />
                            <div class="error">
                                @error('address')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="table__item">建物名</th>
                    <td class="building__group">
                        <div class="building__item">
                            <input type="text" name="building" class="building__input" placeholder="例：千駄ヶ谷マンション101"
                                value="{{ old('building') }}" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="table__item">お問い合わせの種類<span class="require">※</span>
                    </th>
                    <td class="category__group">
                        <div class="category__item">
                            <div class="select__wrapper">
                                <select name="category_id" class="category__select" id="select__category-new">
                                    <option value="" selected hidden>選択してください</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if (old('category_id') == $category->id) selected
                                        @endif>
                                            {{ $category->content }}
                                        </option>
                                    @endforeach
                                    </option>
                                </select>
                            </div>
                            <div class="error">
                                @error('category_id')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="table__item">お問い合わせの商品</th>
                    <td class="item__group">
                        <div class="item__item">
                            <div class="select__wrapper">
                                <select name="item_id" class="item__select" id="select__item-new">
                                    <option value=null @if (old('item_id') == null) selected @endif>選択してください</option>
                                    @foreach ($items as $item)
                                        <option value="{{ $item->id }}" @if (old('item_id') == $item->id) selected @endif>
                                            {{ $item->content }}
                                        </option>
                                    @endforeach
                                    </option>
                                </select>
                            </div>
                            <div class="error">
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="table__item">お問い合わせ内容<span class="require">※</span></th>
                    <td class="detail__group">
                        <div class="detail__item">
                            <textarea name="detail" class="detail__textarea"
                                placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                            @error('detail')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </td>
                </tr>
                <tr>
                    <th class="table__item">どこで知りましたか？</th>
                    <td class="channel__group">
                        <div class="channel__item">
                            <!-- <input type="hidden" name="channel[]" value="0" /> -->
                            @foreach ($channels as $key => $channel)
                                <input type="checkbox" name="channel_id[{{ $key }}]" id="channel_id[{{ $key }}]"
                                    value="{{ $channel->id }}" @if (old("channel_id.$key") == $channel->id) checked @endif />
                                <label for="channel_id[{{ $key }}]">{{ $channel->content }}</label>
                            @endforeach
                        </div>
                    </td>
                </tr>
            </table>
            <div class="button__area">
                <button type="submit" class="submit__button" name="send">確認画面</button>
            </div>
        </form>
    </div>
@endsection