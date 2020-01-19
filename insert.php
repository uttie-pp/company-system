<?php
require "function.php";
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>insert</title>

  <meta charset="utf-8">
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
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    include_once('database_config.php');
   
//    var_dump($_POST);
    $array_counter = 0;
    $array_check = variable_count($_POST);
    $array_counter = count($array_check);
    if($array_counter==0){
        $num = contents_check("number判定結果:",natural($_POST['number']));
        $num += contents_check("name判定結果:",hiragana_katakana_kanji($_POST['name']));
        $num += contents_check("name_kana判定結果:",hiragana($_POST['name_kana']));
        $num += contents_check("gender判定結果:",natural($_POST['radio_j']));
        if($num==0){
//        echo "配列に問題はありません";
        
    try{
        $dbh = new PDO($dsn, $user, $password);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        echo "DBに接続が成功しました<br>";
        
        }catch (PDOException $e) {
        echo "DBに接続が失敗しました: " . $e->getMessage() . "\n";
//        exit();
        }
        $sql = "INSERT INTO user (code, name, name_kana, gender) VALUES (:code, :name, :name_kana, :gender)";
        $prepare = $dbh->prepare($sql);
        $prepare->bindValue(':code', $_POST['number'], PDO::PARAM_STR);
        $prepare->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
        $prepare->bindValue(':name_kana', $_POST['name_kana'], PDO::PARAM_STR);
        $prepare->bindValue(':gender', $_POST['radio_j'], PDO::PARAM_STR);
        $result = $prepare->execute();
            if($result){
                echo "追加に成功しました<br>";
                }else{
                echo "追加に失敗しました<br>";
            }
            
            }else{
            echo '<div class="d-flex justify-content-center links">';
            echo '<button type="button" class="btn btn-outline-warning new_reg_btn" onclick="history.back(); return false;">社員追加欄に戻る</button>';
            echo '</div>';
            exit();
            }
        }else{
        echo "Warning : Input error<br>";
        echo '<div class="d-flex justify-content-end social_icon">';
        echo '<span><i class="fas fa-exclamation-triangle"></i></span>';
        echo '</div>';
        echo count($array_check)."個の項目が空です<br>";
        array_htmlt($array_check);
        exit();
        }
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