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
$imid= uniqid(mt_rand());

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
        
		
		<script src="js/imglist.js"></script>

    </head>
    <body>
        <div id="page_wrapper">
            <div id="top_image"></div>
            <header>
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
            <div id="main_wrapper">
                <div id="modalwrap">
                    <div id="modal">
                        <label for=""><h4>画像追加</h4></label>
                        <form action="imglist.php" method="post" enctype="multipart/form-data">
                            <fieldset class="imgparts">
                                <input type="hidden"  name="imgid" value="<?php echo $imid ?>">
                                <input type="hidden"  name="Eimgid" id="Eimgid" value="">
                                <input type="file" id="iminput" accept="image/*" name="newimg">
                                <label for="" class="imgwrap">画像説明</label>
                                <input type="text" name="imgalt" id="Eimalt" value="">
                            </fieldset>
                            <input type="submit" name="submit4" id="upl" onclick="" value="アップロード">
                            <input type="submit" name="submit5" id="upd" onclick="" value="アップデート">
                            <input type="button" name="cancel" onclick="document.getElementById('modalwrap').style.display='none'" value="キャンセル">
                        </form>
                    </div>
                </div>  
            <div id="breadcrumbs">
                <ul>
                    <li>
                        <a href="">トップ</a>
                    </li>
                </ul>
            </div>
            
				<main>
                    <label for="">画像数(記事内除く)：<?php echo $imct ?></label>
                    <form method="POST" action="imglist.php" enctype="multipart/form-data">
                    <div id="buttons">
                        <input type="button" class="subbutton" name="submit" value="新画像追加" onclick="newimagepage()">
                        <input type="submit" class="subbutton" name="submit1" value="削除" > 
                        <input type="button" class="subbutton" name="submit2" value="説明編集" onclick="eimagepage()">
                        <input type="button" class="subbutton" name="submit3" value="使う" onclick="imgselected()">
                    </div>
					<div id ="imglist">
                        <?php foreach ($ists as $img) { ?>
                            <div class="imgwrap">
                            <input type="hidden"  name="pimid" value="<?php echo $img['imgid'] ?>">
                                <input type="radio" name="imgselect" id="<?php echo $img['imgid'] ?>" class="imselradio" value="<?php echo $img['imgid'] ?>">
                                <label for="<?php echo $img['imgid'] ?>" class="img">
                                    <img src="blogimgs/<?php echo $img['fname'] ?>" alt="">
                                </label>
                                <label for="" class="imgalt"><?php echo $img['fname'] ?></label>
                                <label for="" class="imgalt" id="ALT-<?php echo $img['imgid']?>"><?php echo $img['textalt'] ?></label>
                            </div>
                            
                        <?php  } ?>
                    </div>
                    
                    </form>
				</main>
                
            </div>
            <!--======================================-->
            <footer>
                <iframe src="footer.html" frameborder="0" scrolling="no"></iframe>

            </footer>
        </div>
    </body>
</html>