<?php
  // スーパーグローバル変数：PHPであらかじめ定義されている変数
  // $_POST, $_GET
  $nickname = htmlspecialchars($_POST['nickname']);
  $email = htmlspecialchars($_POST['email']);
  $content = htmlspecialchars($_POST['content']);

  // ニックネームの入力チェック
  if ($nickname == '') {
    $nickname_result = 'ニックネームが入力されていません。';
  } else {
    $nickname_result = 'ようこそ' . $nickname .'様';
  }

  // メールアドレス
  if ($email == '') {
    $email_result = 'メールアドレスが入力されていません。';
  } else {
    $email_result = 'メールアドレス：' . $email;
  }

  // お問い合わせ内容
  if ($content == '') {
    $content_result = 'お問い合わせ内容が入力されていません。';
  } else {
    $content_result = 'お問い合わせ内容：' . $content;
  }
  
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <title>入力内容確認</title>
  <meta charset="utf-8">
</head>
<body>
  <h1>入力内容確認</h1>
  <p> <?= $nickname_result ?> </p>
  <p> <?= $email_result ?> </p>
  <p> <?= $content_result ?> </p>

  <form method="POST" action="thanks.php">
    <input type="hidden" name="nickname" value="<?= $nickname ?>">
    <input type="hidden" name="email" value="<?= $email ?>">
    <input type="hidden" name="content" value="<?= $content ?>">

    <input type="button" value="戻る" onclick="history.back()">
    <?php if ($nickname != '' && $email != '' && $content != ''): ?>

      <input type="submit" value="OK">

    <?php endif; ?>

  </form>
</body>
</html>

