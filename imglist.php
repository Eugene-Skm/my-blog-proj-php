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
            
            
              $st2 = $pdo->query("SELECT * FROM imgs");
              $ists = $st2->fetchAll();
              $imct= count($ists);

            /*  $st1 = $pdo->query("SELECT * FROM languages");
              $langs = $st1->fetchAll();
              $st2 = $pdo->query("SELECT * FROM tools");
              $tools = $st2->fetchAll();*/
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
        
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        
        <link rel="stylesheet" type="text/css" href="trix/trix.css">
        <script src="trix/trix-core.js"></script>
        
		<script src="js/editor.js"></script>

    </head>
    <body>
        <div id="page_wrapper">
            <div id="top_image"></div>
            <header>
            <?php
                function console_log( $data ){
                echo '<script>';
                echo 'console.log('. json_encode( $data ) .')';
                echo '</script>';
                }

                $myvar = array(1,2,3);
                console_log( $myvar ); // [1,2,3]
            ?>
                <div id="main_menu">
                    <ul>
                        <li>
                            <a href="index.php"><img src="svg/home_ic.svg">トップ</a>
                        </li>
                        <li>
                            <a href="articlelist.php"><img src="svg/book_ic.svg">雑記帳</a>
                        </li>
                        <li>
                            <a href="practiceworks.php"><img src="svg/file_ic.svg">練習作</a>
                        </li>
                        <li>
                            <a href="links.php"><img src="svg/link_ic.svg">リンク</a>
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
                    <label for="">画像数(記事内除く)：<?php echo $imct ?></label>
					<div id ="imglist">
                        <?php foreach ($ists as $img) { ?>
                            <div class="imgwrap">
                                <input type="radio" name="imgselect" id="<?php echo $img['imgid'] ?>" class="imselradio" value="<?php echo $img['imgid'] ?>">
                                <label for="<?php echo $img['imgid'] ?>" class="img">
                                    <img src="blogimgs/<?php echo $img['fname'] ?>" alt="">
                                </label>
                                <label for="" class="imgname"><?php echo $img['fname'] ?></label>
                            </div>
                        <?php  } ?>
					</div>

				</main>
                
            </div>
            <!--======================================-->
            <footer>
                <iframe src="footer.html" frameborder="0" scrolling="no"></iframe>

            </footer>
        </div>
    </body>
</html>