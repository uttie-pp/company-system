<?php
  if(isset($_POST["send"])) {
//  var_dump($_FILES["image"]);
//  echo "<br>";
//  echo "<br>";
    $tempfile = $_FILES['image']['tmp_name'];
    //アップロード画像の移動先
    $filemove = 'C:\xampp\htdocs\php_test\task\task-7\img/' . $_FILES['image']['name'];
    //move_uploaded_file関数を使って、アップロードした画像を指定した場所に移動させる
    move_uploaded_file($tempfile , $filemove );
  }
//  echo "アップロードが完了しました<br>"
?>
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

<body>
  <img src = "<?php echo "img/" . $_FILES['image']['name'] ?>" alt="写真" title="picture"> 
  <button type="button" class="btn float select_btn" onclick="location.href='./list.php'">一覧に戻る</button>
</body>
</html>
