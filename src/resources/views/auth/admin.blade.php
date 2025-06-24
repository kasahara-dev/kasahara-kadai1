@extends('app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">


@section('header')
    @parent
    <form class="form" action="/logout" method="post">
        @csrf
        <button type="submit" class="btn__submit" name="send">Logout</button>
    </form>
@endsection

@section('content')
                                <div class="title__area">
                                    <p class="form__title">Admin</p>
                                </div>
                                <div class="conditions__area">
                                    <search>
                                        <form class="form" action="/admin" method="get">
                                            @csrf
                                            <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください" value="{{ old('keyword') }}" />
                                            @php
    $gender_check = old('gender');
    if (is_null($gender_check)) {
        $gender_check = '0';
    }
                                            @endphp
                                            <select class="select_gender" name="gender" id="select__gender">
                                                <option value="0" @if($gender_check == '0') selected @endif>性別</option>
                                                @foreach(config('gender') as $genderId => $genderName)
                                                    <option value="{{ $genderId }}" @if($gender_check == $genderId) selected @endif>
                                                        {{ $genderName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <select class="select__category" name="category_id" id="select__category-new">
                                                <option value="0" @if (old('category_id') == '0' or is_null(old('category_id'))) selected @endif>
                                                    選択してください
                                                </option>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->id }}" @if (old('category_id') == $category->id) selected @endif>
                                                        {{ $category->content }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('category_id')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                            <input type="date" name="date" />
                                            <button type="submit" class="btn__submit" name="search">検索</button>
                                            <input type="reset" value="リセット" />
                                        </form>
                                    </search>
                                </div>
                                <div class="searched__area">
                                    <div class="searched__option">
                                        <button type="button">エクスポート</button>
                                        <div class="pages">{{ $contacts->appends(['keyword'=>$keyword,'gender'=>$gender,'date'=>$date,'category_id'=>$category_id])->links('vendor.pagination.bootstrap-4') }}</div>
                                    </div>

                                    <table class="searched__list">
                                        <tr>
                                            <th>お名前</th>
                                            <th>性別</th>
                                            <th>メールアドレス</th>
                                            <th>お問い合わせの種類</th>
                                            <th>詳細</th>
                                        </tr>
                                        @foreach($contacts as $contact)
                                            <tr>
                                                <td>{{ $contact->last_name . '　' . $contact->first_name}}</td>
                                                <td>{{ (config('gender')[$contact->gender]) }}</td>
                                                <td>{{ $contact->email }}</td>
                                                <td>{{ $contact->category->content }}</td>
                                                <td><button id="openDetail" class="button__detail">詳細</button></td>
                                            </tr>
                                            <div id="modal" class="modal__area">
                                                <div id="modalDisplay" class="modal__body">
                                                    <div class="modal__table">
                                                        <dl>
                                                            <dt><label for="kind">お名前</label></dt>
                                                            <dd>{{ $contact->last_name . '　' . $contact->fist_name }}</dd>
                                                            <dt><label for="kind">性別</label></dt>
                                                            <dd>{{ (config('gender')[$contact->gender]) }}</dd>
                                                            <dt><label for="kind">メールアドレス</label></dt>
                                                            <dd>{{ $contact->email }}</dd>
                                                            <dt><label for="kind">電話番号</label></dt>
                                                            <dd>{{ $contact->tel }}</dd>
                                                            <dt><label for="kind">住所</label></dt>
                                                            <dd>{{ $contact->address }}</dd>
                                                            <dt><label for="kind">建物名</label></dt>
                                                            <dd>{{ $contact->building }}</dd>
                                                            <dt><label for="kind">お問い合わせの種類</label></dt>
                                                            <dd>{{ $contact->category->content }}</dd>
                                                            <dt><label for="kind">お問い合わせ内容</label></dt>
                                                            <dd>{{ $contact->detail }}</dd>
                                                        </dl>
                                                    </div>
                                                    <form class="form" action="/admin" method="post">
                                                        @csrf
                                                        <button type="submit" id="delete" class="button__delete">削除</button>
                                                    </form>
                                                </div>
                                        @endforeach
                                    </table>

                                    </div>
                                </div>
                                <script src="{{ asset('/js/show.js') }}"></script>
@endsection