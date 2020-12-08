<?php
session_start();
date_default_timezone_set('Asia/Tokyo');
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
            $tday=date('Y-m-d');
            if(isset($_GET['WorA'])){
                $WA=$_GET['WorA'];
                if($WA=='A'){
                    $st = $pdo->query("SELECT * FROM article_categories");
                    $cats = $st->fetchAll();
                   // $Ast = $pdo->query("SELECT article_id, postday,   FROM articles As A1, article_categories As A2 WHERE");
                   // $Asts = $Ast->fetchAll();
                    $Ast = $pdo->query("SELECT article_id, descript, title,postday,visibility,a.category_id1 AS CID1,a.category_id2 AS CID2,a.category_id3 AS CID3,a.category_id4 AS CID4,a.category_id5 AS CID5, b.named AS CN1, c.named AS CN2, d.named AS CN3, e.named AS CN4, f.named AS CN5, i.fname AS INAME FROM articles AS a INNER JOIN article_categories AS b ON a.category_id1=b.id INNER JOIN article_categories AS c ON a.category_id2=c.id INNER JOIN article_categories AS d ON a.category_id3=d.id INNER JOIN article_categories AS e ON a.category_id4=e.id INNER JOIN article_categories AS f ON a.category_id5=f.id INNER JOIN imgs AS i ON a.thumb=i.imgid WHERE postday <= '$tday' AND visibility !=0 ORDER BY postday DESC" );
                    $Asts = $Ast->fetchAll();
                    if(isset($_GET['CaT'])){
                        $Cat=$_GET['CaT'];
                        $Ast = $pdo->query("SELECT article_id,descript, title,postday,visibility,a.category_id1 AS CID1,a.category_id2 AS CID2,a.category_id3 AS CID3,a.category_id4 AS CID4,a.category_id5 AS CID5, b.named AS CN1, c.named AS CN2, d.named AS CN3, e.named AS CN4, f.named AS CN5, i.fname AS INAME FROM articles AS a INNER JOIN article_categories AS b ON a.category_id1=b.id INNER JOIN article_categories AS c ON a.category_id2=c.id INNER JOIN article_categories AS d ON a.category_id3=d.id INNER JOIN article_categories AS e ON a.category_id4=e.id INNER JOIN article_categories AS f ON a.category_id5=f.id INNER JOIN imgs AS i ON a.thumb=i.imgid WHERE a.category_id1='$Cat' OR a.category_id2='$Cat' OR a.category_id3='$Cat' OR a.category_id4='$Cat' OR a.category_id5='$Cat' AND postday <= '$tday' AND visibility !=0 ORDER BY postday DESC" );
                        $Asts = $Ast->fetchAll();
                    }
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
        <link rel="stylesheet" href="css/lister_style1.css" charset="UTF-8" >
        <link rel="stylesheet" href="css/articlepage.css" charset="UTF-8" >
        <script src="js/list_type.js" charset="utf-8"></script>
        <script src="js/page_transition.js" charset="utf-8"></script>
        <script src="js/load.js" charset="utf-8"></script>

    </head>
    <body onload="bol(1)">
        <div id="page_wrapper">
            <div id="top_image"><label for="">Y's 雑記帳</label></div>

            <header>
            <iframe width="100%" src="headermenu.html" id="hbar" frameborder="0" scrolling="no" onload="headjuster()"></iframe>
           
            </header>
            <!--======================================-->
            <!--<input onclick=''>-->
            
            <div id="main_wrapper">
                <main>
                    <label>記事一覧 </label>
                    <div id="list_type">
                        <input type="radio" name="list_type_radio" id="column_list" value="COLUMN" onchange="change_check()" checked>
                        <label for="column_list" class="list_type_button" id="label_column_list"><img src="svg/list.svg" alt="一覧リスト"></label>
                        <input type="radio" name="list_type_radio" id="bg_column_list" value="BGCOLUMN" onchange="change_check()" >
                        <label for="bg_column_list" class="list_type_button" id="label_bg_column_list"><img src="svg/bg_list_ic.svg" alt="一覧リスト"></label>
                        <input type="radio" name="list_type_radio" id="grid_list"value="GRID" onchange="change_check()">
                        <label for="grid_list" class="list_type_button" id="label_grid_list"><img src="svg/grid.svg" alt="一覧リスト"></label>
                    </div>
                    <?php echo $error?>
                    <div id="articles_list">
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


                        <div class="article" onclick="pgt('article.html?At=<?php echo $Asts[$place]['article_id']?>')">

                                <div class="article_thumb_p">
                                    <img src="blogimgs/<?php echo $Asts[$place]['INAME']?>" class="article_thumb_img">
                                </div>
                                <div class="article_detail">
                                    <div class="article_info list_detail_item">
                                        <div class="article_posted_date"><?php echo $Asts[$place]['postday'] ?></div>
                                        <div class="article_categories">
                                        <?php for($t=1; $t<= 5; $t++){ 
                                            if($Asts[$place]['CN'.$t]!='null'){?>
                                                <div class="article_category">
                                                    <a href="articlelist.php?WorA=A&CaT=<?php echo $Asts[$place]['CID'.$t]?>">
                                                        <?php echo $Asts[$place]['CN'.$t] ?>
                                                    </a>
                                                </div>
                                            <?php }
                                        }?>
                                        </div>
                                    </div>
                                    <div class="article_title list_detail_item"><h1><?php echo $Asts[$place]['title'] ?></h1></div>
                                    <div class="article_description list_detail_item">
                                        <p><?php echo $Asts[$place]['descript'] ?></p>
                                    </div>

                                </div>
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