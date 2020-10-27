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


$A_id= uniqid(mt_rand());
$dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);



// 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], 
            $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            
            
              $st = $pdo->query("SELECT * FROM article_categories Where id != 'null'  ORDER BY category_count DESC");
              $cats = $st->fetchAll();
              $E_title="";$E_cont="";$E_desc="";$E_thumbid="";$E_thumbname="";$E_pday=date('Y-m-d');
              $E_catid1="";$E_catid2="";$E_catid3="";$E_catid4="";$E_catid5="";
              if(isset($_GET["eaid"])&&!empty($_GET["eaid"])){
                $A_id=$_GET["eaid"];
                    $est = $pdo->query("SELECT * FROM articles Where article_id = '$A_id'");
                    $ests = $est->fetchAll();
                    //var_dump($ests);
                    $A_id=$ests[0]['article_id'];
                    $E_title=$ests[0]['title'];
                    $E_cont=$ests[0]['content'];
                    $E_desc=$ests[0]['descript'];
                    $E_pday=$ests[0]['postday'];
                    $E_thumbid=$ests[0]['thumb'];
                    $E_catid1=$ests[0]['category_id1'];
                    $E_catid2=$ests[0]['category_id2'];
                    $E_catid3=$ests[0]['category_id3'];
                    $E_catid4=$ests[0]['category_id4'];
                    $E_catid5=$ests[0]['category_id5'];
                    //var_dump($E_thumbid);
                    if(isset($E_thumbid)&&!empty($E_thumbid)){
                        var_dump($E_thumbid);
                        $imst = $pdo->query("SELECT * FROM imgs Where imgid = '$E_thumbid'");
                        $imts = $imst->fetchAll();
                        $E_thumbname=$imts[0]['fname'];
                    }
                    
              }
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
                    <label for="">記事ID <?php echo $A_id ?> </label>
					<form method="post" action="addarticle.php" id="form" enctype="multipart/form-data">
                        <?php if (isset($_POST['submit'])): ?>
                            <p><?php echo $message; ?></p>
                        <?php else: ?>
                        <?php endif;?>
                        <input type="hidden" name="artid" value="<?php echo $A_id ?>">

                        <label for="title">タイトル</label>
                        <input type="text" name="title" id="atitle" value=<?php echo $E_title?>>

                        <label for="title">概要</label>
                        <input type="text" name="description"id="description" value=<?php echo $E_desc?>>

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
                        console.log('<?php echo $E_cont?>');
                        editor.querySelector('.ql-editor').innerHTML='<?php echo $E_cont?>';

                        </script>
                        
                        <p>サムネ画像</p>                        
                        <div id="imgselectpart">
                            <div id="thumsamplewrap"style="display:<?php if(!empty($E_thumbname)){ echo "inline-flex";} ?>;">
                                <img src="blogimgs/<?php echo $E_thumbname;?>" alt="サムネ画像" id="thumbsample">
                            </div>
                            <input type="hidden" name="imgid" id="imid" value="<?php echo $E_thumbid;?>">
                            <input type="button" id="imgbutton" onclick="openimgchoice()" value="サムネ選択" style="margin: 0px;">
                            <label for="" id="imgname"><?php echo $E_thumbname;?></label>
                        </div>
                        <?php if(!isset($_GET["eaid"])&&empty($_GET["eaid"])){
                            echo '<label for="postday">投稿日(解禁日)</label>';
                            echo '<input type="date" id="pday" name="postday" value="<?php echo $E_pday;?>">';
                        }
                        ?>
                        
                        
                        <br>
                        <label for="cat1">カテゴリー</label>
                        <select name="cat1" id="" value="<?php echo $E_catid1 ?>">
                            <option value="null">--</option>
                            <?php foreach ($cats as $cat) { ?>
								<option value="<?php echo $cat['id'] ?>" <?php if($cat['id']==$E_catid1){ echo 'selected';}; ?> ><?php echo $cat['named'] ?></option>
							<?php }?>
                        </select>
                        <select name="cat2" id="" value="<?php echo $E_catid2 ?>">
                            <option value="null">--</option>
                            <?php foreach ($cats as $cat) { ?>
								<option value="<?php echo $cat['id'] ?>" <?php if($cat['id']==$E_catid2){ echo 'selected';}; ?> ><?php echo $cat['named'] ?></option>
							<?php }?>
                        </select>
                        <select name="cat3" id="" value="<?php echo $E_catid3 ?>">
                            <option value="null">--</option>
                            <?php foreach ($cats as $cat) { ?>
								<option value="<?php echo $cat['id'] ?>" <?php if($cat['id']==$E_catid3){ echo 'selected';}; ?> ><?php echo $cat['named'] ?></option>
							<?php }?>
                        </select>
                        <select name="cat4" id="" value="<?php echo $E_catid4 ?>">
                            <option value="null">--</option>
                            <?php foreach ($cats as $cat) { ?>
								<option value="<?php echo $cat['id'] ?>" <?php if($cat['id']==$E_catid4){ echo 'selected';}; ?> ><?php echo $cat['named'] ?></option>
							<?php }?>
                        </select>
                        <select name="cat5" id="" value="<?php echo $E_catid5 ?>">
                            <option value="null">--</option>
                            <?php foreach ($cats as $cat) { ?>
								<option value="<?php echo $cat['id'] ?>" <?php if($cat['id']==$E_catid5){ echo 'selected';}; ?> ><?php echo $cat['named'] ?></option>
							<?php }?>
						</select>
                        
                        <br>
                        <?php
                        if(isset($_GET["eaid"])&&!empty($_GET["eaid"])){
                            echo '<input type="submit" class="subbutton" name="submit2" id="submit2" disabled value="アップデート保存">';
                        }else{
                            echo '<input type="submit" class="subbutton" name="submit" id="submit" disabled>';
                        }
                        ?>
                        
                        
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
