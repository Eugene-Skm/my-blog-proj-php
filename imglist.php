<?php
//session_start();
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
		$iid = $_POST['imgid'];
		//$tname = $_POST['tbname'];
		/*if (!$id) $error .= 'ジャンルidがありません。<br>';
		if (!$name) $error .= 'ジャンル名がありません。<br>';
		if(mb_strlen($id)>20){
		$error .= 'idが20文字を超えています。<br>';
		}*/
	if (!$error) {
			$pdo = new PDO($dsn, $db['user'], 
			$db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
			
			$image = uniqid(mt_rand(), true);//ファイル名をユニーク化
			$image .= '.' . substr(strrchr($_FILES['thumbimage']['name'], '.'), 1);//元ファイルの拡張子を取得誤接続
			$sql = "INSERT INTO imgs(imgid,fname) VALUES ('$iid','$image')";
			$stmt = $pdo->prepare($sql);
			if (!empty($_FILES['thumbimage']['name'])) {//ファイルが選択されていれば
				move_uploaded_file($_FILES['thumbimage']['tmp_name'], 'blogimgs/'.$image);//ディレクトリにファイル保存
				$stmt->execute();
			}

			header('Location: imglistpage.php');
			exit();
		}

  }


if (@$_POST['submit2']) {
    $imgid = $_POST['imid'];
    $imgnm = $_POST['imgselect'];
    if (!$error) {
		if(file_exists ("blogimgs/".$imgnm)){
			var_dump("blogimgs/". $imgnm);
			unlink("blogimgs/". $imgnm);
			$pdo = new PDO($dsn, $db['user'], 
			$db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
			$st = $pdo->query("DELETE FROM imgs WHERE imgid = '$imgid'");
			echo "削除完了しました";
		}
		
     header('Location: imglistpage.php');
      exit();
    }
  }


  if (@$_POST['submit4']) {
	var_dump($_FILES);
		$iid = $_POST['imgid'];
		$ialt = $_POST['imgalt'];
		//$tname = $_POST['tbname'];
		if (!$error) {
			$pdo = new PDO($dsn, $db['user'], 
			$db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
			$image = uniqid(mt_rand(), true);//ファイル名をユニーク化
			$image .= '.' . substr(strrchr($_FILES['newimg']['name'], '.'), 1);//元ファイルの拡張子を取得誤接続
			$sql = "INSERT INTO imgs(imgid,fname,textalt) VALUES ('$iid','$image','$ialt')";
			$stmt = $pdo->prepare($sql);
			if (!empty($_FILES['newimg']['name'])) {//ファイルが選択されていれば
				move_uploaded_file($_FILES['newimg']['tmp_name'], 'blogimgs/'.$image);//ディレクトリにファイル保存
				$stmt->execute();
			}


			header('Location: imglistpage.php');
			
			exit();
		}else{
			//require 'addtagpage.php';
		}


	}else{
	}
	require 'imglistpage.php';
?>
