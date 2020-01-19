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
    <div class="card"style='height:15rem;'>
      <div class="card-header">
        <h3 class="mt-4">Message</h3>
      </div>

      <div class="card-body text-white lead"style="">
<?php
echo "update.php";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    include_once('database_config.php');
    try{
        $dbh = new PDO($dsn, $user, $password);
        echo "接続成功<br>";
        
        }catch (PDOException $e) {
        echo "接続失敗: " . $e->getMessage() . "<br>";
        exit();
    }
        $sql = "UPDATE user SET code = :code,
                                name = :name,
                                name_kana = :name_kana,
                                gender = :gender
                                WHERE id = :id";
        
        $prepare = $dbh->prepare($sql);
        $prepare->bindValue(':code', $_POST['code'], PDO::PARAM_STR);
        $prepare->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
        $prepare->bindValue(':name_kana', $_POST['name_kana'], PDO::PARAM_STR);
        $prepare->bindValue(':gender', $_POST['gender'], PDO::PARAM_STR);
        $prepare->bindValue(':id', $_POST['id'], PDO::PARAM_INT);
        $result = $prepare->execute();
            if($result){
                echo "編集に成功しました<br>";
                }else{
                echo "Warning : Input error<br>";
                echo '<div class="d-flex justify-content-end social_icon">';
                echo '<span><i class="fas fa-exclamation-triangle"></i></span>';
                echo '</div>';
                echo "編集に失敗しました<br>";
            }
    }
?>

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