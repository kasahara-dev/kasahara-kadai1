@extends('app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="form__area">
        <p class="form__title">Contact</p>
        <form class="form" action="/confirm" method="post">
            @csrf
            <dl>
                <div class="item">
                    <dt>
                        <label for="kind">お名前</label>
                        <span class="require">※</span>
                    </dt>
                    <dd class="name__group">
                        <div class="name__item">
                            <input type="text" name="last_name" placeholder="例：山田"
                                value="{{ old('last_name', session('last_name')) }}" />
                            @error('last_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="name__item">
                            <input type="text" name="first_name" placeholder="例：太郎"
                                value="{{ old('first_name', session('first_name')) }}" />
                            @error('first_name')
                                <div class="error">{{ $message }}</div>
                            @enderror
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
                            @php
                                $gender_check = old('gender', session('gender'));
                                if(is_null($gender_check)){
                                    $gender_check = '1';
                                }
                            @endphp
                            <input type="radio" name="gender" id="gender-1" value="1" @if($gender_check == '1') checked
                            @endif />
                            <label for="gender-1">{{ config('gender.1') }}</label>
                            @error('gender')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="gender__item">
                            <input type="radio" name="gender" id="gender-2" value="2" @if($gender_check == '2') checked
                            @endif />
                            <label for="gender-2">{{ config('gender.2') }}</label>
                        </div>
                        <div class="gender__item">
                            <input type="radio" name="gender" id="gender-3" value="3" @if($gender_check == '3') checked
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
                            <input type="text" name="email" placeholder="例：test@example.com" value="{{ old('email',session('email')) }}" />
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
                            <input type="text" name="tel1" placeholder="080" value="{{ old('tel1',session('tel1')) }}" />
                            @error('tel1')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="tel__item">
                            <input type="text" name="tel2" placeholder="1234" value="{{ old('tel2', session('tel2')) }}" />
                            @error('tel2')
                                <div class="error">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="tel__item">
                            <input type="text" name="tel3" placeholder="5678" value="{{ old('tel3',session('tel3')) }}" />
                            @error('tel3')
                                <div class="error">{{ $message }}</div>
                            @enderror
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
                                value="{{ old('address',session('address')) }}" />
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
                            <input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building',session('building')) }}" />
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
                                    <option value="{{ $category->id }}"
                                    @if (old('category_id',session('category_id')) == $category->id)
                                        selected
                                    @endif
                                    >
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
                            <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail',session('detail')) }}</textarea>
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