<?php
  $nickname = htmlspecialchars($_POST['nickname']);
  $email = htmlspecialchars($_POST['email']);
  $content = htmlspecialchars($_POST['content']);

  $dsn = 'mysql:dbname=phpkiso;host=127.0.0.1';
  $user = 'root';
  $password='';
  // データベース接続
  $dbh = new PDO($dsn, $user, $password);
  // エラーを画面に出す設定
  $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // DBを操作するときの文字コードを設定
  $dbh->query('SET NAMES utf8');

  // SQL文を作成
  $sql = 'INSERT INTO survey(nickname, email, content) VALUES(:nickname, :email, :content)';
  // 作成したSQL文の実行準備
  $stmt = $dbh->prepare($sql);
  $stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
  $stmt->bindParam(':email', $email, PDO::PARAM_STR);
  $stmt->bindParam(':content', $content, PDO::PARAM_STR);
  // SQLの実行
  $stmt->execute();

  // データベース切断
  $dbh = null;

?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>送信完了</title>
  <meta charset="utf-8">
</head>
<body>
  <h1>お問い合わせありがとうございました！</h1>
  <div>
    <h3>お問い合わせ詳細内容</h3>
    <p>ニックネーム：<?php echo $nickname; ?></p>
    <p>メールアドレス：<?php echo $email; ?></p>
    <p>お問い合わせ内容：<?php echo $content; ?></p>
  </div>
</body>
</html>
