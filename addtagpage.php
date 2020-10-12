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
        <title></title>
        <!--===========================================================-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="">
        <link rel="canonical" href="https://????.com">
        <!--サイト公開時 関係性-->
        <!--===========================================================-->
        <link rel="stylesheet" href="css/page_base.css" charset="UTF-8">
		<link rel="stylesheet" href="css/kanrip.css" charset="UTF-8">
		
		<link rel="stylesheet" type="text/css" href="trix/trix.css">
		<script src="trix/trix-core.js"></script>
    </head>
    <body>
        <div id="page_wrapper">
            <div id="top_image"></div>
            <header>

                <div id="main_menu">
                    <ul>
                        <li>
                            <a href="index.html"><img src="svg/home_ic.svg">トップ</a>
                        </li>
                        <li>
                            <a href="articlelist.html"><img src="svg/book_ic.svg">雑記帳</a>
                        </li>
                        <li>
                            <a href="practiceworks.html"><img src="svg/file_ic.svg">練習作</a>
                        </li>
                        <li>
                            <a href="links.html"><img src="svg/link_ic.svg">リンク</a>
                        </li>
                    </ul>
                </div>

            </header>
            <!--======================================-->
            <div id="breadcrumbs">
                <ul>
                    <li>
                        <a href="">トップ</a>
                    </li>
                </ul>
            </div>
            <div id="main_wrapper">
                <main id="adtag">
					<label for="">いろいろ追加ページ</label>
					<form method="post" action="addtag.php">
						<label for="">記事ジャンル追加</label><br>
						<label for="catid">ジャンルid</label>
						<input type="text" name="catid">
						<label for="catname">ジャンル名</label>
                        <input type="text" name="catname">
                        <input type="submit" class="subbutton"name="submit">
					</form>
					<form method="post" action="addtag.php">
						<label for="">ツール追加</label><br>
						<label for="toolid">ツールid</label>
						<input type="text" name="toolid">
						<label for="toolname">ツール名</label>
                        <input type="text" name="toolname">
                        <input type="submit" class="subbutton" name="submit2">
					</form>
					<form method="post" action="addtag.php">
						<label for="">言語追加</label><br>
						<label for="langid">言語id</label>
						<input type="text" name="langid">
						<label for="langname">言語名</label>
                        <input type="text" name="langname">
                        <input type="submit" class="subbutton" name="submit3">
					</form>
					
					<label for="">いろいろ削除</label>
					<form method="post" action="addtag.php">
						<label for="catdid">カテゴリー</label>
                        <select name="catdid" id="">
                            <option value="null">--</option>
                            <?php foreach ($cats as $cat) { ?>
								<option value="<?php echo $cat['category_id'] ?>"><?php echo $cat['category_name'] ?></option>
							<?php }?>
						</select>
						<input type="submit" class="subbutton" name="submit4" value="削除">
					</form>
					<form method="post" action="addtag.php">
						<label for="tooldid">ツール</label>
                        <select name="tooldid" id="">
                            <option value="null">--</option>
                            <?php foreach ($tools as $tool) { ?>
								<option value="<?php echo $tool['tool_id'] ?>"><?php echo $tool['tool_name'] ?></option>
							<?php }?>
						</select>
						<input type="submit" class="subbutton" name="submit5" value="削除">
					</form>
					<form method="post" action="addtag.php">
						<label for="langdid">言語</label>
                        <select name="langdid" id="">
                            <option value="null">--</option>
                            <?php foreach ($langs as $lang) { ?>
								<option value="<?php echo $lang['language_id'] ?>"><?php echo $lang['language_name'] ?></option>
							<?php }?>
						</select>
						<input type="submit" class="subbutton" name="submit6" value="削除">
					</form>
					  aa
                </main>
                
            </div>
            <!--======================================-->
            <footer>
                <iframe src="footer.html" frameborder="0" scrolling="no"></iframe>

            </footer>
        </div>
    </body>
</html>