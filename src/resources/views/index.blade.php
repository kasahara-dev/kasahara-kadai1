@extends('app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="form__area">
        <p class="form__title">Contact</p>
        <form class="form" action="/confirm" method="get">
            @csrf
            <dl>
                <div class="item">
                    <dt>
                        <label>お名前</label>
                        <span class="require">※</span>
                    </dt>
                    <dd class="name__group">
                        <div class="name__item">
                            <input type="text" class="input__name" name="last_name" placeholder="例：山田"
                                value="{{ old('last_name') }}" />
                            <div class="error">
                                @error('last_name'){{ $message }}@enderror
                            </div>
                        </div>
                        <div class="name__item">
                            <input type="text" class="input__name" name="first_name" placeholder="例：太郎"
                                value="{{ old('first_name') }}" />
                            <div class="error">
                                @error('first_name'){{ $message }}@enderror
                            </div>
                        </div>
                    </dd>
                </div>
                <div class="item">
                    <dt>
                        <label for="kind">性別</label>
                        <span class="require">※</span>
                    </dt>
                    <dd class="gender__group">
                        <div class="gender__item">
                            <input type="radio" name="gender" id="gender-1" value="1" @if(old('gender', '1') != '2' and old('gender', '1') != '3') checked @endif />
                            <label>{{ config('gender.1') }}</label>
                            <div class="error">
                                @error('gender')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="gender__item">
                            <input type="radio" name="gender" id="gender-2" value="2" @if(old('gender', '1') == '2') checked
                            @endif />
                            <label for="gender-2">{{ config('gender.2') }}</label>
                        </div>
                        <div class="gender__item">
                            <input type="radio" name="gender" id="gender-3" value="3" @if(old('gender', '1') == '3') checked
                            @endif />
                            <label for="gender-3">{{ config('gender.3') }}</label>
                        </div>
                    </dd>
                </div>
                <div class="item">
                    <dt>
                        <label for="kind">メールアドレス</label>
                        <span class="require">※</span>
                    </dt>
                    <dd class="email__group">
                        <div class="email__item">
                            <input type="text" class="input__email" name="email" placeholder="例：test@example.com"
                                value="{{ old('email') }}" />
                            @error('email')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </dd>
                </div>
                <div class="item">
                    <dt>
                        <label for="kind">電話番号</label>
                        <span class="require">※</span>
                    </dt>
                    <dd class="tel__group">
                        <div class="tel__item">
                            <input type="text" name="tel1" placeholder="080" value="{{ old('tel1') }}" />
                            <div class="error">
                                @error('tel1'){{ $message }}@enderror
                            </div>
                        </div>
                        <div class="tel__item">
                            <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2') }}" />
                            <div class="error">
                                @error('tel2'){{ $message }}@enderror
                            </div>
                        </div>
                        <div class="tel__item">
                            <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3') }}" />
                            <div class="error">
                                @error('tel3'){{ $message }}@enderror
                            </div>
                        </div>
                    </dd>
                </div>
                <div class="item">
                    <dt>
                        <label for="kind">住所</label>
                        <span class="require">※</span>
                    </dt>
                    <dd class="address__group">
                        <div class="address__item">
                            <input type="text" name="address" placeholder="例：東京都千代田区千駄ヶ谷1-2-3"
                                value="{{ old('address') }}" />
                            @error('address')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </dd>
                </div>
                <div class="item">
                    <dt>
                        <label for="kind">建物名</label>
                    </dt>
                    <dd class="building__group">
                        <div class="building__item">
                            <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}" />
                        </div>
                    </dd>
                </div>
                <div class="item">
                    <dt>
                        <label for="kind">お問い合わせの種類</label>
                        <span class="require">※</span>
                    </dt>
                    <dd class="category__group">
                        <div class="category__item">
                            <select class="select__category" name="category_id" id="select__category-new">
                                <option value="" selected hidden>選択してください</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if (old('category_id') == $category->id) selected @endif>
                                        {{ $category->content }}
                                    </option>
                                @endforeach
                                </option>
                            </select>
                            @error('category_id')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </dd>
                </div>
                <div class="item">
                    <dt>
                        <label for="kind">お問い合わせ内容</label><span class="require">※</span>
                    </dt>
                    <dd class="detail__group">
                        <div class="detail__item">
                            <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                            @error('detail')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                    </dd>
                </div>
            </dl>
            <button type="submit" class="btn__submit" name="send">確認</button>
        </form>
    </div>
@endsection