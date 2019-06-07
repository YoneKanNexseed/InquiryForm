<?php

// empty()：空の時正解、空じゃない時不正解
// ! は trueをfalseに、falseをtrueに変換する

// 配列を作成
$records = array();

if (!empty($_POST)) {
  // $_POSTが空でなかったら正解

  //送信されたCODEを取得
  $code = htmlspecialchars($_POST['code']);

  $dsn = 'mysql:dbname=phpkiso;host=127.0.0.1';
  $user = 'root';
  $password='';
  // データベース接続
  $dbh = new PDO($dsn, $user, $password);
  // エラーを画面に出す設定
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // DBを操作するときの文字コードを設定
  $dbh->query('SET NAMES utf8');

  // SQLの準備＆実行
  $sql = 'SELECT * FROM survey WHERE code = :code';
  // 準備
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':code', $code, PDO::PARAM_INT);
  // 実行
  $stmt->execute();

  // データベース切断
  $dbh = null;

  while (true) {
    // 1レコード取得
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($record == false) {
      // レコードが存在しない時、ループを終了
      break;
    }
  
    // 配列にレコードを追加
    $records[] = $record;
  
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <form action="" method="POST">
    <p>検索したいcodeを入力してください。</p>
    <input type="text" name="code">
    <input type="submit" value="検索">
  </form>

  <?php foreach($records as $record): ?>
    <p><?= $record['code']; ?></p>
    <p><?= $record['nickname']; ?></p>
    <p><?= $record['email']; ?></p>
    <p><?= $record['content']; ?></p>
    <a href="edit.php?code=<?= $record['code']; ?>">編集</a>
    <a href="delete.php?code=<?= $record['code']; ?>">削除</a>
  <?php endforeach; ?>

</body>
</html>