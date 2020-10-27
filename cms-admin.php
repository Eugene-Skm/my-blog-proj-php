<?php
session_start();
//debug_to_console($post_type,$_SESSION["ID"]);

//$userid=$_SESSION["ID"]
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



// 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], 
            $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            
            
             //$pdo = new PDO("mysql:dbname=ysta", "ysta");
             
              //$st = $pdo->query("SELECT * FROM item WHERE sjanru = 'train' ORDER BY no ASC");
              $st = $pdo->query("SELECT * FROM article_categories");
              $cats = $st->fetchAll();
              $st1 = $pdo->query("SELECT * FROM languages");
              $langs = $st1->fetchAll();
              $st2 = $pdo->query("SELECT * FROM tools");
              $tools = $st2->fetchAll();
        }  catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
        //W $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            echo $e->getMessage();
        }

/*--------------------------------------------------------------------------------*/

?>

<!DOCTYPE html>
<html charset="UTF-8" ">
    <head>
        <title>サイト管理ページ</title>
        <!--===========================================================-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="">
        <link rel="canonical" href="https://????.com">
		<meta name="robots" content="noindex,nofollow">

        <!--サイト公開時 関係性-->
        <!--===========================================================-->
       
		
		<link rel="stylesheet" type="text/css" href="css/cmsp.css">
        <script src="js/load.js"></script>
        
    </head>
    <body>
		<main>
			<ul>
				<li><a href="index.php" target="_blank">実サイト確認</a></li>
			</ul>
			<ul>
				<li><a href="addarticlepage.php" target="pp">記事追加</a></li>
			</ul>
			<ul>
				<li><a href="adminarticlespage.php?WorA=A" target="pp">記事管理</a></li>
			</ul>
			<ul>
				<li><a href="imglistpage.php" target="pp">画像管理</a></li>
			</ul>
			<ul>
				<li><a href="infoeditpage.php" target="pp">トップその他管理</a></li>
			</ul>
			<ul>
				<li><a href="addtagpage.php" target="pp">カテゴリ等管理</a></li>
			</ul>
			<ul>
				<li><a href="adminarticlespage.php?WorA=W" target="pp" disabled>作品管理</a></li>
			</ul>
		</main>
		<aside>
			<iframe src="" name="pp" frameborder="0"></iframe>
		</aside>
        
    </body>
</html>