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

	try {
		$dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);
	} catch (PDOException $e) {

	}

  $error =  '';
  $title = htmlspecialchars($_POST['title'], ENT_QUOTES);
$describ = htmlspecialchars($_POST['description'], ENT_QUOTES); 
$cont =$_POST['content'];
$aid = $_POST['artid'];
$iid = $_POST['imgid'];
$cat1 = $_POST['cat1'];
$cat2 = $_POST['cat2'];
$cat3 = $_POST['cat3'];
$cat4 = $_POST['cat4'];
$cat5 = $_POST['cat5'];
  if (@$_POST['submit']) {
		//$tname = $_POST['tbname'];
		$pday = $_POST['postday'];
		if (!$title) $error .= 'ジャンルidがありません。<br>';
		if (!$aid) $error .= 'ジャンル名がありません。<br>';
		if (!$error) {
			$pdo = new PDO($dsn, $db['user'], 
			$db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
			if($iid==""){
				$iid='null';
			}
			$st = $pdo->query("INSERT INTO articles(article_id,postday,title,descript,content,thumb,category_id1,category_id2,category_id3,category_id4,category_id5) VALUES('$aid','$pday','$title','$describ','$cont','$iid','$cat1','$cat2','$cat3','$cat4','$cat5')");
			

			header('Location: adminarticlespage.php?WorA=A');
			exit();
		}

  }
 
if (@$_POST['submit2']) {
	//$tname = $_POST['tbname'];
	if (!$title) $error .= 'ジャンルidがありません。<br>';
	if (!$aid) $error .= 'ジャンル名がありません。<br>';
	if (!$error) {
		$pdo = new PDO($dsn, $db['user'], 
		$db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
		$Eday=date('Y-m-d');
		$st = $pdo->query("UPDATE articles SET editedday='$Eday', title='$title',descript='$describ',content='$cont',thumb='$iid',category_id1='$cat1',category_id2='$cat2',category_id3='$cat3',category_id4='$cat4',category_id5='$cat5' WHERE article_id='$aid'");

		header('Location: adminarticlespage.php?WorA=A');
		exit();
	}
}




?>