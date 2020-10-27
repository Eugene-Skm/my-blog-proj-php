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
		
			$P_desc="";$P_profimgnm="";$P_profimgid="";
			$profest = $pdo->query("SELECT * FROM profiles As P inner join imgs As I ON P.prof_img = I.imgid WHERE P.id = 'profile'  ");
			$profsts = $profest->fetchAll();
			
			$P_desc=$profsts[0]['prof_description'];
			$P_profimgnm=$profsts[0]['fname'];
			$P_profimgid=$profsts[0]['imgid'];
			
			$T_cont="";;
			$topest = $pdo->query("SELECT * FROM tops");
			$topsts = $topest->fetchAll();
			$T_cont=$topsts[0]['description'];


              /*記事一覧ページ用
              $v = $pdo->query("SELECT no FROM articles Where (category_id1 = 'diary' OR  category_id2 = 'diary' OR category_id3 = 'diary' OR category_id4 = 'diary' OR category_id5 = 'diary') AND visibility!=0 ORDER BY postday DESC");
              $vs = $v->fetchAll();
             */
            
        }  catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
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
			<div id="top_image"><label for="">Y's 雑記帳:管理ページ</label></div>
            <header>
               

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
                    <label for="">自己紹介編集（サイドバー） </label>
					<form method="post" action="addarticle.php" id="form1" enctype="multipart/form-data">
						<p>サムネ画像</p>                        
                        <div id="imgselectpart">
                            <div id="thumsamplewrap"style="display:<?php if(!empty($P_profimgnm)){ echo "inline-flex";} ?>;">
                                <img src="blogimgs/<?php echo $P_profimgnm;?>" alt="サムネ画像" id="thumbsample">
                            </div>
                            <input type="hidden" name="imgid" id="imid" value="<?php echo $P_profimgid;?>">
                            <input type="button" id="imgbutton" onclick="openimgchoice()" value="サムネ選択" style="margin: 0px;">
                            <label for="" id="imgname"><?php echo $P_profimgnm;?></label>
                        </div>
                         <label for="title">自己紹介</label>
                        <input type="text" name="title" id="atitle" value='<?php echo $P_desc?>'>

						
						<br><input type="submit" class="subbutton" name="submit" id="submit"  value="保存">
                        
					</form>
                    <label for="">トップページ編集</label>

					<form method="post" action="addarticle.php" id="form2" enctype="multipart/form-data">
					<div id="editor"></div>
                        <input type="hidden" id="editor-input" name="content">
                        <script>
                        var editor = document.getElementById('editor');
                        var editorInput = document.getElementById('editor-input');

                        var quill = new Quill(editor, {
                        theme: 'snow',
                        modules: {
                            syntax : false,
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

                        quill.on('text-change', function(delta, oldDelta, source) {
                        var editorHtml = editor.querySelector('.ql-editor').innerHTML;
                        console.log(editorHtml);
                        editorInput.value = editorHtml;
                        });
                        console.log('<?php echo $T_cont?>');
                        editor.querySelector('.ql-editor').innerHTML='<?php echo $T_cont?>';

                        </script>
                                              
                        <br><input type="submit" class="subbutton" name="submit2" id="submit2" value="保存">
                        
                        
                    </form>
                      
                </main>
            </div>
            <!--======================================-->
            <footer>
                <!--<iframe src="footer.html" frameborder="0" scrolling="no"></iframe>-->

            </footer>
        </div>
            
    </body>
</html>
