// サンプルデータ
const contactsList = [
    ["A001", "サメハック", 30],
    ["A002", "ねこハック", 22],
    ["A003", "いぬハック", 40],
];

var btn = document.getElementById("export");
btn.onclick = function () {
    ////////////////////出力するデータの作成////////////////////
    // CSV格納用 ※ヘッダーをあらかじめ設定しておく
    const header = "ID,ユーザ名,年齢\r\n";
    let data = header;

    // オブジェクトの中身を取り出してカンマ区切りにする
    for (let sample of contactsList) {
        // 配列の要素をカンマで区切ってテキスト化
        data += sample.join(",");

        // データ末尾に改行コードを追記
        data += "\r\n";
    }

    ////////////////////CSV形式へ変換////////////////////
    // BOMを付与（Excelで開いた際のの文字化け対策）
    const bom = new Uint8Array([0xef, 0xbb, 0xbf]);
    // CSVのバイナリデータを作成
    const blob = new Blob([bom, data], { type: "text/csv" });
    // blobからオブジェクトURLを作成
    const objectUrl = URL.createObjectURL(blob);

    ////////////////////ダウンロードリンクの作成とクリック////////////////////
    // ダウンロードリンクを作成 ※HTMLのaタグを作成
    const downloadLink = document.createElement("a");
    // ファイル名の設定
    const fileName = "sample.csv";
    downloadLink.download = fileName;
    // ダウンロードファイルを設定 ※aタグのhref属性
    downloadLink.href = objectUrl;

    // ダウンロードリンクを擬似的にクリック
    downloadLink.click();

    // ダウンロードリンクを削除
    downloadLink.remove();
};

// const csvDownload = () => {
//     ////////////////////出力するデータの作成////////////////////
//     // CSV格納用 ※ヘッダーをあらかじめ設定しておく
//     const header = "ID,ユーザ名,年齢\r\n";
//     let data = header;

//     // オブジェクトの中身を取り出してカンマ区切りにする
//     for (let sample of sampleList) {
//         // 配列の要素をカンマで区切ってテキスト化
//         data += sample.join(",");

//         // データ末尾に改行コードを追記
//         data += "\r\n";
//     }

//     ////////////////////CSV形式へ変換////////////////////
//     // BOMを付与（Excelで開いた際のの文字化け対策）
//     const bom = new Uint8Array([0xef, 0xbb, 0xbf]);
//     // CSVのバイナリデータを作成
//     const blob = new Blob([bom, data], { type: "text/csv" });
//     // blobからオブジェクトURLを作成
//     const objectUrl = URL.createObjectURL(blob);

//     ////////////////////ダウンロードリンクの作成とクリック////////////////////
//     // ダウンロードリンクを作成 ※HTMLのaタグを作成
//     const downloadLink = document.createElement("a");
//     // ファイル名の設定
//     const fileName = "sample.csv";
//     downloadLink.download = fileName;
//     // ダウンロードファイルを設定 ※aタグのhref属性
//     downloadLink.href = objectUrl;

//     // ダウンロードリンクを擬似的にクリック
//     downloadLink.click();

//     // ダウンロードリンクを削除
//     downloadLink.remove();
// };
