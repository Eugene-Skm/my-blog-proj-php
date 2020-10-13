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
    $id = $_POST['id'];
    $name = $_POST['name'];
    $tname = $_POST['tbname'];
    if (!$id) $error .= 'ジャンルidがありません。<br>';
    if (!$name) $error .= 'ジャンル名がありません。<br>';
    if(mb_strlen($id)>20){
       $error .= 'idが20文字を超えています。<br>';
    }
    if (!$error) {
            $pdo = new PDO($dsn, $db['user'], 
            $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        
      //$pdo = new PDO("mysql:dbname=blog", "root");
	  $st = $pdo->query("INSERT INTO $tname(id,named) VALUES('$id','$name')");
      header('Location: addtagpage.php');
      exit();
    }
  }


if (@$_POST['submit2']) {
    $id = $_POST['id'];
    $tname = $_POST['tbname'];
    if (!$error) {
		$pdo = new PDO($dsn, $db['user'], 
		$db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
		$st = $pdo->query("DELETE FROM $tname WHERE id = '$id'");
		echo "削除完了しました";
	
      header('Location: addtagpage.php');
      exit();
    }
  }
  require 'addtagpage.php';


?>
