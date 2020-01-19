<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html lang="ja">
<head>
  <!--Bootsrap 4 CDN-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!--Fontawesome CDN-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <!--Custom styles-->
  <link rel="stylesheet" type="text/css" href="style_company.css"> 

  <meta charset="UTF-8">
  <title>insert</title>
</head>

<div class="cp_bgpattern06">
<body>
<div class="container">
    <div class="d-flex justify-content-center h-100">
    <div class="card"style='width:30rem;height:40rem;'>
      <div class="card-header">
        <h3 class="mt-4">Message</h3>
      </div>

      <div class="card-body text-white lead"style="">

<?php
  if(isset($_POST["send"])) {
//  var_dump($_FILES["image"]);
//  echo $_FILES['image']['name'];
//  echo "<br>";
//  echo "<br>";
    $tempfile = $_FILES['image']['tmp_name'];
    //アップロード画像の移動先
    $filemove = 'C:\xampp\htdocs\php_test\task\task-7\img/' . $_FILES['image']['name'];
    //move_uploaded_file関数を使って、アップロードした画像を指定した場所に移動させる
    if(move_uploaded_file($tempfile , $filemove)){
        echo $_FILES['image']['name']."のアップロードに成功しました<br>";
        }else{
        echo "Warning : Input error<br>";
        echo '<div class="d-flex justify-content-end social_icon">';
        echo '<span><i class="fas fa-exclamation-triangle"></i></span>';
        echo '</div>';
        echo $_FILES['image']['name']."アップロードに失敗しました<br>";
    }
  }
?>
     </div>

        <img class='d-block mx-auto' style='width:18rem;height:auto;' src = "<?php echo "img/" . $_FILES['image']['name'] ?>" alt="アップロード画像" title="画像データ"> 
     
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
