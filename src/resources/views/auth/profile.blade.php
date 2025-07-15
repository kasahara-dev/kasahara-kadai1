@extends('app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@endsection

@section('header')
    @parent
    <form class="form" action="/logout" method="post">
        @csrf
        <button type="submit" class="logout__button" name="send">Logout</button>
    </form>
@endsection

@section('content')
    <div class="form__area">
        <h1 class="form__title">Profile</h1>
        <div class="box__area">
            <form class="contents__form" action="/profile" method="post">
                @csrf
                <dl>
                    <div class="item">
                        <dt class="item__dt">性別</dt>
                        <div class="gender__radios">
                            <dd class="item__dd">
                                <div class="gender__item">
                                    <label class="gender__label">
                                        <input type="radio" class="gender__radio" name="gender" id="gender-1" value="1"
                                            @if(old('gender', '1') != '2' and old('gender', '1') != '3') checked @endif />
                                        {{ config('gender.1') }}
                                    </label>
                                </div>
                            </dd>
                            <dd class="item__dd">
                                <div class="gender__item">
                                    <label class="gender__label">
                                        <input type="radio" class="gender__radio" name="gender" id="gender-2" value="2"
                                            @if(old('gender', '1') == '2') checked @endif />
                                        {{ config('gender.2') }}
                                    </label>
                                </div>
                            </dd>
                            <dd class="item__dd">
                                <div class="gender__item">
                                    <label class="gender__label">
                                        <input type="radio" class="gender__radio" name="gender" id="gender-3" value="3"
                                            @if(old('gender', '1') == '3') checked @endif />
                                        {{ config('gender.3') }}
                                    </label>
                                </div>
                        </div>
                        <div class="error gender__error">
                            @error('gender')
                                {{ $message }}
                            @enderror
                        </div>
                        </dd>
                    </div>
                    <div class="item">
                        <dt class="item__dt">誕生日</dt>
                        <dd class="item__dd">
                            <input type="date" class="date__input" name="birthday" value="{{ old('birthday') }}" />
                            <div class="error birthday__error">
                                @error('birthday')
                                    {{ $message }}
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
    {{-- -
    <table class="table">
        <tr class="table__tr gender__tr">
            <th class="table__item gender__th" colspan="2">性別</th>
            <td class="table__td gender__group">
                <div class="gender__item">
                    <label class="gender__label">
                        <input type="radio" class="gender__radio" name="gender" id="gender-1" value="1"
                            @if(old('gender', '1' ) !='2' and old('gender', '1' ) !='3' ) checked @endif />
                        {{ config('gender.1') }}
                    </label>
                </div>
                <div class="gender__item">
                    <label class="gender__label">
                        <input type="radio" class="gender__radio" name="gender" id="gender-2" value="2"
                            @if(old('gender', '1' )=='2' ) checked @endif />
                        {{ config('gender.2') }}
                    </label>
                </div>
                <div class="gender__item">
                    <label class="gender__label">
                        <input type="radio" class="gender__radio" name="gender" id="gender-3" value="3"
                            @if(old('gender', '1' )=='3' ) checked @endif />
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
        <tr class="table__tr">
            <th class="table__item">誕生日</th>
            <td class="table__td">
                <input type="date" class="date__input" name="birthday" value="{{ old('birthday') }}" />
            </td>
            <td>
                <div class="error birthday__error">
                    @error('birthday')
                    {{ $message }}
                    @enderror
                </div>
            </td>
        </tr>
        <tr>
            <th colspan="2">
                <div class="button__area">
                    <button type="submit" class="submit__button" name="send">登録</button>
                </div>
            </th>
        </tr>
    </table>
    </form>
    </div>
    </div>
    --}}
@endsection