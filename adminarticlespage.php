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
$error='';



$dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

// 3. エラー処理
        try {
            $pdo = new PDO($dsn, $db['user'], 
            $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
            
            if(isset($_GET['WorA'])){
                $WA=$_GET['WorA'];
                if($WA=='A'){
                    $st = $pdo->query("SELECT * FROM article_categories");
                    $cats = $st->fetchAll();
                   // $Ast = $pdo->query("SELECT article_id, postday,   FROM articles As A1, article_categories As A2 WHERE");
                   // $Asts = $Ast->fetchAll();
                    $Ast = $pdo->query("SELECT article_id, title,postday,visibility, b.named AS CN1, c.named AS CN2, d.named AS CN3, e.named AS CN4, f.named AS CN5 FROM articles AS a INNER JOIN article_categories AS b ON a.category_id1=b.id INNER JOIN article_categories AS c ON a.category_id2=c.id INNER JOIN article_categories AS d ON a.category_id3=d.id INNER JOIN article_categories AS e ON a.category_id4=e.id INNER JOIN article_categories AS f ON a.category_id5=f.id ORDER BY postday DESC" );
                    $Asts = $Ast->fetchAll();
                    //var_dump($Asts);
                }else if($WA=='W'){
                    
                }
            }
             
              
        }  catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
        //W $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            echo $e->getMessage();
        }

/*--------------------------------------------------------------------------------*/

if (@$_POST['submit2']) {
    $aid = $_POST['A_id'];
    $vn = $_POST['visiblenum'];
    if (!$error) {
        $pdo = new PDO($dsn, $db['user'], 
        $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        
        $sql = "UPDATE articles SET visibility='$vn' WHERE article_id='$aid'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        header('Location: adminarticlespage.php?WorA=A');

    }else{
    }
}

if (@$_POST['submit1']) {
    echo '<script>alert("削除します");</script>';
    $aid = $_POST['A_id'];
    if (!$error) {
        $pdo = new PDO($dsn, $db['user'], 
        $db['pass'], array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        
        $sql = "DELETE FROM articles WHERE article_id='$aid'";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        header('Location: adminarticlespage.php?WorA=A');
    }else{
    }
}

?>

<!DOCTYPE html>
<html charset="UTF-8" ">
    <head>
        <title>Y's 雑記帳</title>
        <!--===========================================================-->
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="">
        <link rel="canonical" href="https://????.com">
		<meta name="robots" content="noindex,nofollow">

        <!--サイト公開時 関係性-->
        <!--===========================================================-->
        <link rel="stylesheet" href="css/page_base.css" charset="UTF-8">
        <link rel="stylesheet" href="css/kanrip.css" charset="UTF-8">
        <link rel="stylesheet" href="css/articlepage.css" charset="UTF-8">
        <script src="js/adminal.js" charset="utf-8"></script>
        <script src="js/load.js"></script>

    </head>
    <body onload="">
        <div id="page_wrapper">
            <div id="top_image">
            <div id="top_image"><label for="">Y's 雑記帳:管理ページ</label></div>

            </div>
            <header>

           <!-- <iframe width="100%" src="headermenu.html" id="hbar" frameborder="0" scrolling="no" onload="headjuster()"></iframe>
<!--
                <div id="main_menu">
                    <ul>
                        <li>
                            <a href="index.php"><img src="icon/home32.png">トップ</a>
                        </li>
                        <li>
                        <a href="articlelist.php"><img src="icon/book32.png">雑記帳</a>
                        </li>
                        <li>
                            <a href="practiceworks.php"><img src="icon/folder32.png">練習作</a>
                        </li>
                        <li>
                            <a href="links.php"><img src="icon/Link32.png">リンク</a>
                        </li>
                    </ul>
                </div>-->

            </header>
            <!--======================================-->
            <div id="modalwrap">
                <div id="modal">
                    <form action="adminarticlespage.php?WorA=A" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="A_id" id="A_id" value="">
                        <fieldset class="edimodalcont" id="AD" style="display:none;">
                            <h4 id="Dar">記事削除</h4>
                            <label for="" id="confirmtex"></label>
                            <input type="submit" name="submit1" id="" onclick="" value="削除">
                            <input type="button" name="cancel" onclick="document.getElementById('modalwrap').style.display='none'" value="キャンセル">

                        </fieldset>
                        <fieldset class="edimodalcont" id="VC" style="display:none;">
                            <h4 id="Dar">表示変更</h4>
                            サイト上での表示状態の変更
                            <select name="visiblenum" id="">
                                <option value="1" id='vs1'>表示</option>
                                <option value="0" id='vs0'>非表示</option>
                            </select>
                            <input type="submit" name="submit2" id="" onclick="" value="変更">
                            <input type="button" name="cancel" onclick="document.getElementById('modalwrap').style.display='none'" value="キャンセル">
                        </fieldset>
                        
                    </form>
                </div>
            </div>
            <div id="main_wrapper">
                <main>
                    <label>記事一覧
                    </label>
                    <?php echo $error?>
                    <div id="articles_list">
                        <div class="article" id="tag">
                            <label>タイトル</label>
                            <label>投稿日</label>
                            <label>カテゴリ</label>
                            <label>編集</label>
                            <label>削除</label>
                            <label>表示状態</label>
                        </div>
                        <?php
                            if(isset($_GET['pnum'])){
                                $np=$_GET['pnum'];
                            }else{
                                $np=1;
                            }
                            
                            $arnum=10;
                            $arcount= count($Asts);
                            $cpnum=floor($arcount/10);
                            $spare=$arcount%10;                            
                            if($np>$cpnum){
                                $arnum=$spare;
                            }
                            if($spare>=1){
                                $cpnum++;
                            }
                            $preP=$np-1; $nexP=$np+1;
                            
                            if((int)$np==(int)$cpnum){
                                $nexP=-99;
                            }
                            if($np==1){
                                $preP=-99;
                            }
                        ?>
                        <?php  for($i=0; $i<$arnum;$i++){ ?>
                        <?php  $place=(($np-1)*10)+$i?>
                        <div class="article">
                            <div class="article_title">
                                <h1><?php echo $Asts[$place]['title'] ?></h1>
                            </div>
                            <div class="article_posted_date"><?php echo $Asts[$place]['postday'] ?></div>
                            <div class="article_categories">
                                <?php for($t=1; $t<= 5; $t++){ 
                                            if($Asts[$place]['CN'.$t]!='null'){?>
                                <div class="article_category">
                                    <?php echo $Asts[$place]['CN'.$t] ?>
                                </div>
                                <?php }
                                        }?>

                                <div class="article_category">
                                    diary
                                </div>
                            </div>
                            <a href="addarticlepage.php?eaid=<?php echo $Asts[$place]['article_id']?>">編集</a>
                            <label class="clink" onclick="delconfirm('<?php echo $Asts[$place]['article_id']?>','<?php echo $Asts[$place]['title']?>')">削除</label>
                            <label class="clink" onclick="visibilCha('<?php echo $Asts[$place]['article_id']?>',<?php echo $Asts[$place]['visibility']?>)"><?php if($Asts[$place]['visibility'] =='1'){ echo '表示';}else{echo '非表示';}?></label>
                        </div>
                        <?php  } ?>

                    </div>
                    <div id="pagenation">
                        <form method="GET" action="adminarticlespage.php">
                            <div class="move" id="prev">
                                <input type="hidden" name="WorA" id="" value="A">
                                <input type="hidden" name="pnum" id="ppnum" value="<?php echo $preP?>">
                                <input type="submit" class="moves" value="" style="background:#00000000;"<?php if($preP==-99){echo 'disabled';}?>></input>
                            </div>
                        </form>
                        <div id="pgplace">
                            <div id="nowp"><?php echo $np ?></div>/<div id="allp"><?php echo $cpnum ?></div>
                        </div>
                        <form method="GET" action="adminarticlespage.php">
                            <div class="move" id="next">
                                <input type="hidden" name="WorA" id="" value="A">
                                <input type="hidden" name="pnum" id="npnum" value="<?php echo $nexP?>">
                                <input type="submit" class="moves" value="" style="background:#00000000;" <?php if($nexP==-99){echo 'disabled';}?>></input>
                            </div>
                        </form>

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