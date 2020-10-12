<?php
session_start();
//debug_to_console($post_type,$_SESSION["ID"]);

//$userid=$_SESSION["ID"]
// ログイン状態チェック
/*if (!isset($_SESSION["NAMEADMINS"])) {
    header("Location: adminlogin.php");
    exit;
}*/
//header("Location: ../home.html");  // メイン画面へ遷移
$db['host'] = "localhost";  // DBサーバのURL
$db['user'] = "root";  // ユーザー名
$db['pass'] = "";  // ユーザー名のパスワード
$db['dbname'] = "brog_db";  // データベース名



$dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);




  $error =  '';
  if (@$_POST['submit']) {
    $catid = $_POST['catid'];
    $catname = $_POST['catname'];
    if (!$catid) $error .= 'ジャンルidがありません。<br>';
    if (!$catname) $error .= 'ジャンル名がありません。<br>';
    if(mb_strlen($catid)>20){
       $error .= 'idが20文字を超えています。<br>';
    }
    if (!$error) {
            $pdo = new PDO($dsn, $db['user'], 
            $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        
      //$pdo = new PDO("mysql:dbname=blog", "root");
	  $st = $pdo->query("INSERT INTO article_categories(category_id,category_name) VALUES('$catid','$catname')");
      header('Location: addtagpage.php');
      exit();
    }
  }


if (@$_POST['submit4']) {
    $dcatid = $_POST['catdid'];
    
    if (!$error) {
		$pdo = new PDO($dsn, $db['user'], 
		$db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
		$st = $pdo->query("DELETE FROM article_categories WHERE category_id = '$dcatid'");
		echo "削除完了しました";
	
      header('Location: addtagpage.php');
      exit();
    }
  }
  require 'addtagpage.php';


?>
