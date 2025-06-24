// モーダル要素を取得
var modal = document.getElementById("modal");
// モーダルを開くボタンを取得
var btn = document.getElementById("openDetail");
// モーダルを閉じるアイコン（×）を取得
var span = document.getElementById("closeModal");
const value = element.contactID.value;

// ボタンがクリックされた時にモーダルを表示
btn.onclick = function () {
    modal.style.display = "block"; // モーダルのdisplayスタイルを"block"にして表示
};

// ×（クローズアイコン）がクリックされた時にモーダルを非表示
// span.onclick = function () {
//     modal.style.display = "none"; // モーダルのdisplayスタイルを"none"にして非表示
// };

// モーダルの外側がクリックされた時にモーダルを非表示
window.onclick = function (event) {
    // クリックされた箇所がモーダル自体（外側）であれば
    if (event.target == modal) {
        modal.style.display = "none"; // モーダルのdisplayスタイルを"none"にして非表示
    }
};
