$(function () {
    // 変数に要素を入れる
    var close = $(".modal-close"),
        container = $(".modal-container");
    //closeボタンをクリックしたらモーダルウィンドウを閉じる
    close.on("click", function () {
        container.removeClass("active");
    });

    //モーダルウィンドウの外側をクリックしたらモーダルウィンドウを閉じる
    $(document).on("click", function (e) {
        if (!$(e.target).closest(".modal-body").length) {
            container.removeClass("active");
        }
    });
});
