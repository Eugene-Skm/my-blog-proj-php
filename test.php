<?php
session_start();
//$i=$_SESSION["ID"]


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
              $st = $pdo->query("SELECT * FROM article_categories");
              //$st = $pdo->query("SELECT * FROM item WHERE sjanru = 'train' ORDER BY no ASC");
              $cats = $st->fetchAll();
        }  catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            echo $e->getMessage();
        }
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
                <main>
					<form>
                        <label for="title">タイトル</label>
                        <input type="text" name="title">

                        <label for="title">概要</label>
                        <input type="text" name="description"">

						<input id="x" type="hidden" name="content">
                        <trix-editor input="x"></trix-editor>
                        
                        <label for="postday">投稿日</label>
                        <input type="date">

                        <label for="cat1">カテゴリー</label>
                        <select name="cat1" id="">
							<option value="null">--</option>
							<?php foreach ($cats as $cat) { ?>
								<option value="<?php echo $cat['category_id'] ?>"><?php echo $cat['category_name'] ?></option>
							<?php }?>
                        </select>
                        <select name="cat1" id="">
                            <option value="null">--</option>
                        </select> 
                        <select name="cat1" id="">
                            <option value="null">--</option>
                        </select> 
                        <select name="cat1" id="">
                            <option value="null">--</option>
                        </select> 
                        <select name="cat1" id="">
                            <option value="null">--</option>
                        </select> 

                        <input type="submit">
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