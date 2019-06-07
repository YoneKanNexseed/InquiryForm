<?php

// データベースに接続する
$dsn = 'mysql:dbname=phpkiso;host=127.0.0.1';
$user = 'root';
$password='';
// データベース接続
$dbh = new PDO($dsn, $user, $password);
// エラーを画面に出す設定
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// DBを操作するときの文字コードを設定
$dbh->query('SET NAMES utf8');

// 送信されてきたデータを取得する
$nickname = htmlspecialchars($_POST['nickname']);
$email = htmlspecialchars($_POST['email']);
$content = htmlspecialchars($_POST['content']);
$code = htmlspecialchars($_POST['code']);

// データを更新する
$sql = 'UPDATE survey SET nickname=:nickname, email=:email, content=:content WHERE code=:code';
// SQL準備
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':nickname', $nickname, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':content', $content, PDO::PARAM_STR);
$stmt->bindParam(':code', $code, PDO::PARAM_STR);
// 実行
$stmt->execute();

// view.phpに戻る
header("Location: view.php");