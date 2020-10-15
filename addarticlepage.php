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
              $st = $pdo->query("SELECT * FROM article_categories Where id != 'null'  ORDER BY category_count DESC");
              $cats = $st->fetchAll();


              $arid= uniqid(mt_rand());

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
                    <label for="">記事ID <?php echo $arid ?> </label>
					<form method="post" action="addarticle.php" enctype="multipart/form-data">
                        <?php if (isset($_POST['submit'])): ?>
                            <p><?php echo $message; ?></p>
                        <?php else: ?>
                        <?php endif;?>
                        <input type="hidden" name="artid" value="<?php echo $arid ?>">

                        <label for="title">タイトル</label>
                        <input type="text" name="title" id="atitle">

                        <label for="title">概要</label>
                        <input type="text" name="description"id="description">

                        <div id="editor">
                            
                        </div>
                        <input type="hidden" name="content" id="editorh">

                        <script>
                        var Delta = Quill.import('delta');
                        const quill = new Quill('#editor', {
                        theme: 'snow',
                        modules: {
                            syntax : true,              // Include syntax module
                            // https://quilljs.com/docs/modules/toolbar/
                            toolbar : [
                            
                            [{'header': [1, 2, 3, 4, 5, 6, false]}],
                            //フォント種類
                            [{'font': []}],
                            //文字寄せ
                            [{'align': []}],
                            //太字、斜め、アンダーバー
                            ['bold', 'italic', 'underline', 'strike'],
                            //文字色//文字背景色
                            [{'color': []},{'background': []}],
                            // リスト
                            [{'list': 'ordered'},{'list': 'bullet'}],
                            //インデント
                            [{'indent': '-1'}, {'indent': '+1'}],
                            [{ 'direction': 'rtl' }],                         // text direction
                            //画像挿入
                            ['link', 'image'] ,
                            //動画
                            ['video'],
                            ['code-block'],
                            [{ 'script': 'sub'}, { 'script': 'super' }],
                            //数式
                            ['formula'],
                            //URLリンク
                            ['link'],
                            ['clean']                                         // remove formatting button
                            ]
                        }
                        });
                        </script>
						<!--<input id="x" type="hidden" name="content">
                        <trix-editor input="x"></trix-editor>-->
                        
                        <p>サムネ画像</p>                        
                        <div id="imgselectpart">
                            <div id="thumsamplewrap">
                                <img src="" alt="サムネ画像" id="thumbsample">
                            </div>
                            <input type="button" id="imgbutton" onclick="openimgchoice()" value="サムネ選択" style="margin: 0px;">
                            <label for="" id="imgname"></label>
                        </div>
                        <label for="postday">投稿日(解禁日)</label>
                        <input type="date" id="pday" name="postday" value="<?php echo date('Y-m-d');?>">

                        <label for="cat1">カテゴリー</label>
                        <select name="cat1" id="">
                            <option value="null">--</option>
                            <?php foreach ($cats as $cat) { ?>
								<option value="<?php echo $cat['id'] ?>"><?php echo $cat['named'] ?></option>
							<?php }?>
						</select>
                        <select name="cat2" id="">
                            <option value="null">--</option>
                            <?php foreach ($cats as $cat) { ?>
								<option value="<?php echo $cat['id'] ?>"><?php echo $cat['named'] ?></option>
							<?php }?>
						</select> 
                        <select name="cat3" id="">
                            <option value="null">--</option>
                            <?php foreach ($cats as $cat) { ?>
								<option value="<?php echo $cat['id'] ?>"><?php echo $cat['named'] ?></option>
							<?php }?>
						</select> 
                        <select name="cat4" id="">
                            <option value="null">--</option>
                            <?php foreach ($cats as $cat) { ?>
								<option value="<?php echo $cat['id'] ?>"><?php echo $cat['named'] ?></option>
							<?php }?>
						</select> 
                        <select name="cat5" id="">
                            <option value="null">--</option>
                            <?php foreach ($cats as $cat) { ?>
								<option value="<?php echo $cat['id'] ?>"><?php echo $cat['named'] ?></option>
							<?php }?>
						</select> 
                        <br>
                        <input type="submit" class="subbutton" name="submit" id="submit" disabled>
                        
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