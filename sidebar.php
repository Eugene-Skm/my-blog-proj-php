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

			$st = $pdo->query("SELECT * FROM article_categories");
			$cats = $st->fetchAll();
			
            $P_desc="";$P_profimgnm="";$P_profimgid="";
			$profest = $pdo->query("SELECT * FROM profiles As P inner join imgs As I ON P.prof_img = I.imgid WHERE P.id = 'profile'  ");
			$profsts = $profest->fetchAll();
			$P_desc=$profsts[0]['prof_description'];
			$P_profimgnm=$profsts[0]['fname'];
			$P_profimgid=$profsts[0]['imgid'];
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
		<meta name="robots" content="noindex,nofollow">
        <meta name="description" content="">
        <link rel="canonical" href="https://????.com">
        <!--サイト公開時 関係性-->
        <!--===========================================================-->
        <link rel="stylesheet" href="css/sidebar.css" charset="UTF-8">
		
    </head>
    <body>
		<div id="profile_part" class="asidelabel_parts">
			<label for="profile_part" class="aside_label"><img src="icon/profile32.png">プロフィール</label>
			<div id="profile_img_p">
				<img src="blogimgs/<?php echo $P_profimgnm;?>" id="profile_img" alt="プロフィール画像">

			</div>
			<div id="profile_description" class="asidecontent_detail">
			<?php echo $P_desc?>
			</div>
		</div>
		<div id="past_part" class="asidelabel_parts">
			<label for="pat_part" class="aside_label"><img src="icon/calender32.png">過去</label>
			<div id="years">
				<ul>
					<li>
						<a href="">2020</a>
					</li>
				</ul>
			</div>
		</div>
		<div id="cat_part" class="asidelabel_parts">
			<label for="cat_part" class="aside_label"><img src="icon/tag32.png">カテゴリー</label>
			<div id="categories">
				<ul>
					<?php foreach ($cats as $cat) { ?>
							<li>
								<a href="articlelist.php?WorA=A&CaT=<?php echo $cat['id'] ?>" target="_parent">
								<?php echo $cat['named'] ?>
								(<?php echo $cat['category_count'] ?>)</a>
							</li>
						<?php }?>
					</ul>
			</div>
		</div>
	</body>
</html>