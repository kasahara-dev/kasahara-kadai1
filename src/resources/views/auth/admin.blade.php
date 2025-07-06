@extends('app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">


@section('header')
    @parent
    <form class="form" action="/logout" method="post">
        @csrf
        <button type="submit" class="logout__button" name="send">Logout</button>
    </form>
@endsection

@section('content')
    <div class="contents__area">
        <div class="title__area">
            <h1 class="form__title">Admin</h1>
        </div>
        <div class="conditions__area">
            <search class="search__area">
                <form class="conditions__form" action="/admin" method="get">
                    @csrf
                    <input type="text" name="keyword" class="item__input keyword__input" placeholder="名前やメールアドレスを入力してください"
                        value="{{ $keyword }}" />
                    <div class="gender__select__area">
                        <select class="item__select gender__select" name="gender" id="select__gender">
                            <option value="0" @if($gender == '0') selected @endif>性別</option>
                            @foreach(config('gender') as $genderId => $genderName)
                                <option value="{{ $genderId }}" @if($gender == $genderId) selected @endif>
                                    {{ $genderName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="category__select__area">
                        <select class="item__select category__select" name="category_id" id="select__category-new">
                            <option value="0" @if ($category_id == '0' or is_null($category_id)) selected @endif>
                                お問い合わせの種類
                            </option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if ($category_id == $category->id) selected @endif>
                                    {{ $category->content }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <input type="date" class="date__input" name="date" value="{{ $date }}" />
                    <button type="submit" class="submit__button" name="search">検索</button>
                    <button type="submit" class="reset__button" name="reset">リセット</button>
            </search>
        </div>
        <div class="searched__area">
            <div class="searched__option">
                <button type="submit" name="export" class="export__button" id="export" data-contacts="">エクスポート</button>
                </form>
                <div class="pages">
                    {{ $contacts->appends(['keyword' => $keyword, 'gender' => $gender, 'date' => $date, 'category_id' => $category_id])->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
            <div class="table__area">
                <table class="searched__list">
                    <tr>
                        <th class="searched__list__th">お名前</th>
                        <th class="searched__list__th">性別</th>
                        <th class="searched__list__th">メールアドレス</th>
                        <th class="searched__list__th">お問い合わせの種類</th>
                        <th class="searched__list__th"></th>
                    </tr>
                    @foreach($contacts as $contact)
                        <tr>
                            <td class="searched__list__td">{{ $contact->last_name . '　' . $contact->first_name}}</td>
                            <td class="searched__list__td">{{ (config('gender')[$contact->gender]) }}</td>
                            <td class="searched__list__td">{{ $contact->email }}</td>
                            <td class="searched__list__td">{{ $contact->category->content }}</td>
                            <td class="searched__list__td"><button id="openDetail" class="button__detail"
                                    data-modal="{{ $contact->id }}">詳細</button></td>
                        </tr>
                        {{-- モーダルウィンドウここから --}}
                        <div id="{{$contact->id}}" class="modal__area" data-contactId="{{ $contact->id }}">
                            <div id="modalDisplay" class="modal__body">
                                <div class="modal__top">
                                    <span class="modal__close"></span>
                                </div>
                                <div class="modal__middle">
                                    <div class="modal__table">
                                        <dl class="modal__table__dl">
                                            <dt class="modal__table__dt"><label for="kind">お名前</label></dt>
                                            <dd class="modal__table__dd">{{ $contact->last_name . '　' . $contact->first_name}}
                                            </dd>
                                            <dt class="modal__table__dt"><label for="kind">性別</label></dt>
                                            <dd class="modal__table__dd">{{ (config('gender')[$contact->gender]) }}</dd>
                                            <dt class="modal__table__dt"><label for="kind">メールアドレス</label></dt>
                                            <dd class="modal__table__dd">{{ $contact->email }}</dd>
                                            <dt class="modal__table__dt"><label for="kind">電話番号</label></dt>
                                            <dd class="modal__table__dd">{{ $contact->tel }}</dd>
                                            <dt class="modal__table__dt"><label for="kind">住所</label></dt>
                                            <dd class="modal__table__dd">{{ $contact->address }}</dd>
                                            <dt class="modal__table__dt"><label for="kind">建物名</label></dt>
                                            <dd class="modal__table__dd">{{ $contact->building }}</dd>
                                            <dt class="modal__table__dt"><label for="kind">お問い合わせの種類</label></dt>
                                            <dd class="modal__table__dd">{{ $contact->category->content }}</dd>
                                            <dt class="modal__table__dt"><label for="kind">お問い合わせ内容</label></dt>
                                            <dd class="modal__table__dd">{{ $contact->detail }}</dd>
                                        </dl>
                                    </div>
                                    <div class="delete__button__area">
                                        <form class="form" action="/admin?id={{ $contact->id }}" method="post">
                                            @csrf
                                            <button type="submit" id="delete" class="button__delete">削除</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- モーダルウィンドウここまで --}}
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <script src="{{ asset('/js/show.js') }}"></script>
@endsection