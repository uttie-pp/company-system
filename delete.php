<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>insert</title>
  <!--Bootsrap 4 CDN-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!--Fontawesome CDN-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <!--Custom styles-->
  <link rel="stylesheet" type="text/css" href="style_company.css"> 
</head>
<div class="cp_bgpattern06">
<body>
<div class="container">
    <div class="d-flex justify-content-center h-100">
    <div class="card">
      <div class="card-header">
        <h3 class="mt-4">Message</h3>
      </div>

      <div class="card-body text-white lead"style="">

<?php
//このファイルはdelete.phpです
$code = $_GET["code"];
//$code = NULL;
//$code = 1000;
include_once('database_config.php');
try{
    $dbh = new PDO($dsn, $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo "接続成功<br>";
    
    }catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage() . "\n";
    exit();
}
try{
    $sql = "DELETE FROM user WHERE code=:code";
    $prepare = $dbh->prepare($sql);
    $prepare->bindValue(':code', $code, PDO::PARAM_INT);
    $result = $prepare->execute();
//    echo "executeの戻り値".$result;
    echo "正常に削除されました<br>";
    }catch(PDOException $e){
    echo "正常に削除されませんでした<br>";
    echo $e->getMessage()." - ".$e->getLine().PHP_EOL;
}
?>
          
      </div>
      <div class="card-footer">
        <div class="d-flex justify-content-center links">
            <button type="button" class="btn btn-outline-warning new_reg_btn" onclick="location.href='./list.php'">一覧に戻る</button>
        </div>
     </div>
    </div>
</div>
</body>
</div>
</html>


