<?php

// データベースに接続
$dsn = 'mysql:dbname=phpkiso;host=127.0.0.1';
$user = 'root';
$password='';
// データベース接続
$dbh = new PDO($dsn, $user, $password);
// エラーを画面に出す設定
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// DBを操作するときの文字コードを設定
$dbh->query('SET NAMES utf8');

// GETで送信されてきたCODEと一致するデータを取得

$code = htmlspecialchars($_GET['code']);

// SQLの準備＆実行
$sql = 'SELECT * FROM survey WHERE code = :code';
// 準備
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':code', $code, PDO::PARAM_INT);
// 実行
$stmt->execute();

// 取得したデータを表示
$record = $stmt->fetch(PDO::FETCH_ASSOC);

echo $record['nickname'];

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>お問い合わせ</title>
</head>
<body>
  <h1>お問い合わせ情報編集</h1>
  <!-- method: GET or POST -->
  <!-- action: 送信先のURL -->
  <form method="POST" action="./update.php">
    <div>
        ニックネーム<br>
        <input type="text" name="nickname" style="width:100px" value="<?= $record['nickname'] ?>">
    </div>
    <div>
        メールアドレス<br>
        <input type="text" name="email" style="width: 200px" value="<?= $record['email'] ?>">
    </div>
    <div>
        お問い合わせ内容<br>
        <textarea name="content" cols="40" rows="5"><?= $record['content'] ?></textarea>
    </div>
    <input type="hidden" name="code" value="<?= $record['code'] ?>">
    <input type="submit" value="送信">
  </form>
</body>
</html>