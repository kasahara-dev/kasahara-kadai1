<script src="{{ asset(('js/show.js')) }}"></script>
<div class="modal_container">
    <div><button type="button" class="modal-close">×</button></div>
    <dl class="list__area">
        <div class="item">
            <dt>
                <label for="kind">お名前</label>
            </dt>
            <dd class="name__group">
                <div class="name__item">
                    {{ $contact->last_name . '　' . $contact->first_name }}
                </div>
            </dd>
        </div>
    </dl>
    <form class="form" action="/admin" method="post">
        @csrf
        <input type="hidden" value="{{ $contact->id }}">
        <button type="submit" class="btn__submit" name="delete">削除</button>
    </form>
</div>