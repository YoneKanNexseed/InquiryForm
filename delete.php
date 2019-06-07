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

// 送信されてきたCODEを取得
$code = htmlspecialchars($_GET['code']);

// DELETE文を実行
$sql = 'DELETE FROM survey WHERE code = :code';
$stmt = $dbh->prepare($sql);
$stmt->bindParam(':code', $code, PDO::PARAM_STR);
$stmt->execute($data);

// view.phpに戻る
header("Location: view.php");