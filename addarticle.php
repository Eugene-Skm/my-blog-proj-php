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
  if (@$_POST['submit']) {
		$title = $_POST['title'];
		$describ = $_POST['description'];
		$cont = $_POST['content'];
		$pday = $_POST['postday'];
		$aid = $_POST['artid'];
		$iid = $_POST['imgid'];
		$cat1 = $_POST['cat1'];
		$cat2 = $_POST['cat2'];
		$cat3 = $_POST['cat3'];
		$cat4 = $_POST['cat4'];
		$cat5 = $_POST['cat5'];
		//$tname = $_POST['tbname'];
		/*if (!$id) $error .= 'ジャンルidがありません。<br>';
		if (!$name) $error .= 'ジャンル名がありません。<br>';
		if(mb_strlen($id)>20){
		$error .= 'idが20文字を超えています。<br>';
		}*/
		if (!$error) {
			$pdo = new PDO($dsn, $db['user'], 
			$db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
			
			//$pdo = new PDO("mysql:dbname=blog", "root");
			
			$image = uniqid(mt_rand(), true);//ファイル名をユニーク化
			$image .= '.' . substr(strrchr($_FILES['thumbimage']['name'], '.'), 1);//元ファイルの拡張子を取得誤接続
			$sql = "INSERT INTO imgs(imgid,fname) VALUES ('$iid','$image')";
			$stmt = $pdo->prepare($sql);
			if (!empty($_FILES['thumbimage']['name'])) {//ファイルが選択されていれば
				move_uploaded_file($_FILES['thumbimage']['tmp_name'], 'blogimgs/'.$image);//ディレクトリにファイル保存
				$stmt->execute();
			}

			$st = $pdo->query("INSERT INTO articles(article_id,postday,title,descript,content,thumb,category_id1,category_id2,category_id3,category_id4,category_id5) VALUES('$aid','$pday','$title','$describ','$cont','$iid','$cat1','$cat2','$cat3','$cat4','$cat5')");
			

			header('Location: addarticlepage.php');
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
