<?php
session_start();
var_dump($_FILES);
var_dump($_POST);
//debug_to_console($post_type,$_SESSION["ID"]);

//$userid=$_SESSION["ID"]
/*if (!isset($_SESSION["NAMEADMINS"])) {
    header("Location: adminlogin.php");
    exit;
}*/
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
        <!--<link rel="stylesheet" href="css/page_base.css" charset="UTF-8">-->
		<link rel="stylesheet" href="css/kanrip.css" charset="UTF-8">
        
        <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        
        <link rel="stylesheet" type="text/css" href="trix/trix.css">
        <script src="trix/trix-core.js"></script>
        
		
		<script src="js/imglist.js"></script>

    </head>
    <body>
            
    
            <div id="newwrapper">
				<main>
                    <label for=""><h4>画像追加</h4></label>
                    <form method="post" action="" enctype="multipart/form-data">
                        
                            <fieldset class="imgparts">
                                <input type="hidden"  name="imgid" value="<?php echo $imid ?>">
                                <input type="file" accept='image/*'　name="newimg" id="newimagesel">
                                <label for="" class="imgwrap">画像説明</label>
                                <input type="text" name="imgalt">
                            </fieldset>
                        <input type="submit" class="subbutton" name="submit"　value="保存">
                    </form>
				</main>
                
            </div>
    </body>
</html>