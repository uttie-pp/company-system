<?php
session_start();
header("Content-type: text/html; charset=utf-8");
if (!isset($_SESSION["account"])) {
    header("Location: login_form.php");
    exit();
}
$account = $_SESSION['account'];
//echo "<p>Login ID:".htmlspecialchars($account,ENT_QUOTES)."</p>";


?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<div class="cp_bgpattern06">
<html>
<head>
  <meta charset="UTF-8">
  <title>社内アルバム</title>
  <script src ="js/jquery-3.4.1.min.js"></script>
  
  <!--Bootsrap 4 CDN-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!--Fontawesome CDN-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <!--Custom styles-->
  <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
<div class="container">
<h3 style="border-bottom: 1px solid #426579;border-left: 10px solid #426579;padding: 7px;">社内アルバム</h3>
<h4 style="border-bottom: 2px dotted #203744;"><?php echo "Login ID:".htmlspecialchars($account,ENT_QUOTES); ?></h4>
    <div class="d-flex justify-content-center">
<!--  <div class="row">-->
<!--    <div class="col-sm-6 col-md-3"-->
  <div class="card-columns"><!-- width: 20rem; -->

<?php
//ディレクトリ名
$dir_path = "img/";
if (is_dir($dir_path)){
    if(is_readable($dir_path)){ // ? ファイルが読み込み可能かどうか
      $ch_dir = dir($dir_path); //ディレクトリクラス
//ディレクトリ内の画像を一覧表示
      while (false !== ($file_name = $ch_dir -> read())){
        $ln_path = $ch_dir -> path . "/" .$file_name;
        if (@getimagesize($ln_path)){ //画像かどうか？

//          echo "<div class='row'>";
//          echo "<div class='col-sm-6 col-md-3'>";
//          echo "<div class='card-deck' style='width: 20rem;'>";
          echo '<div class="col-sm-4">';
          echo "<div class='card'style='width: 20rem;>";
          echo "<a href='#' class='card'>";
          echo "<img class='card-img'src='".$ln_path."'>";
//          echo "<a href = \"imgview.php?d=" .urlencode(mb_convert_encoding($ln_path, "UTF-8")). "\" target = \"_blank\" >";
//          echo "<img src = \"" .$ln_path. "\" width=\"100\"></a>";
          echo "</a>";
          echo '<div class="btn-group">';
          echo '<div class="d-flex justify-content-center links">';
          echo '<button type="button" class="btn btn-outline-secondary select_btn">見る</button>';
          echo '<button type="button" class="btn btn-outline-secondary select_btn">削除</button>';
          echo '</div></div></div></div>';//
        }
      }
      $ch_dir -> close();
      }else{
        echo "<p>" .htmlspecialchars($dir_path)."　は読み込みが許可されていません。";
      }
    }else{
      echo 'DIR 画像がないよ';
}
?>
    </div>
  </div>
</div>
    <div class="card-footer">
      <div class="d-flex justify-content-center links">
      <button type="button" class="btn btn-outline-warning btn-lg select_btn" onclick="location.href='list.php'">一覧に戻る</button>
      </div>
    </div>
</body>
</div>
</html>

