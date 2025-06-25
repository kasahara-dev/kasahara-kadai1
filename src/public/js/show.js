const modalBtns = document.querySelectorAll(".button__detail");
modalBtns.forEach(function (btn) {
    btn.onclick = function () {
        var modal = btn.getAttribute("data-modal");
        document.getElementById(modal).style.display = "block";
    };
});
const closeBtns = document.querySelectorAll(".modal__close");
closeBtns.forEach(function (btn) {
    btn.onclick = function () {
        var modal = btn.closest(".modal__area");
        modal.style.display = "none";
    };
});
// クリックされた箇所がモーダル自体（外側）であれば
window.onclick = function (event) {
    if (event.target.className === "modal__area") {
        event.target.style.display = "none";
    }
};
