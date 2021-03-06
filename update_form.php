<?php
session_start();
header("Content-type: text/html; charset=utf-8");
if (!isset($_SESSION["account"])) {
    header("Location: login_form.php");
    exit();
}
$account = $_SESSION['account'];
//echo "<p>Login ID:".htmlspecialchars($account,ENT_QUOTES)."</p>";

$data = $_GET;
$checkbox = [NULL,NULL,NULL];
$checkbox[$data['gender']] = "checked";
//echo $data['gender'];
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>update</title>
  <meta charset="UTF-8">
  <title>list</title>
  <script src ="js/jquery-3.4.1.min.js"></script>
  
  <!--Bootsrap 4 CDN-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!--Fontawesome CDN-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <!--Custom styles-->
  <link rel="stylesheet" type="text/css" href="style_company.css"> 

</head>

<body  background="images/gears-3d-mobile.jpg">

<div class="container">
  <div class="d-flex justify-content-center h-100">
    <div class="card"  style="height:28rem">
      <div class="card-header">
      <h3 class="mt-4">Employee edit form</h3>
      <?php echo "<h5 class='mt-4'style='color: white;text-align: left'>Login ID:".htmlspecialchars($account,ENT_QUOTES)."</h4>";?>

      </div>

        <div class="card-body">
          <form action="update.php" method="post">
              <input type=hidden name="id" value="<?php echo current($data); ?>">
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-edit"></i></span>
            </div>
             <input class="form-control" type ="text" name="code" placeholder="社員番号" value="<?php echo next($data); ?>">
          </div>
          
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
             <input class="form-control" type="text" name="name" placeholder="社員名前" value="<?php echo next($data); ?>">
          </div>
          
          <div class="input-group form-group">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-language fa-lg"></i></span>
            </div>
             <input class="form-control" type ="text" name="name_kana" placeholder="社員名前(かな)" value="<?php echo next($data); ?>">
          </div>
          
          <div class="btn-toolbar" role="toolbar" aria-label="ボタングループのツールバー">
            <input type="hidden" name="gender" value="">
            <div class="input-group mb-3">
              <div class="input-group-prepend">
                <span class="input-group-text" id="text1a">男性</span>
              </div>
              <div class="input-group-text">
                <input type="radio" name="gender" value="1"<?php echo $checkbox[1]?>><br>
              </div>
            </div>

            <div class="input-group mb-3 ml-4">
              <div class="input-group-prepend">
                <span class="input-group-text" id="text1a">女性</span>
              </div>
              <div class="input-group-text">
                <input type="radio" name="gender" value="2"<?php echo $checkbox[2]?>><br>
              </div>
            </div>

            <div class="input-group mb-3 ml-4">
              <div class="input-group-prepend">
                <span class="input-group-text" id="text1a" style="width: 94px;">選択しない</span>
              </div>
              <div class="input-group-text">
                <input type="radio" name="gender" value="0" <?php echo $checkbox[0]?>>
              </div>
            </div>

            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <?php //echo $token; ?>
          </div>


      <div class="card-footer">
        <div class="d-flex justify-content-center links">
          <button type="button" class="btn btn-outline-warning new_reg_btn" onclick="location.href='list.php'">戻る</button>
          <button type="submit" class="btn float login_btn ml-4">編集</button>
        </div>
     </div>
     </form>
  </div>
</div>
</div>

<!--------------------------------------------------------------------------------------------->
<!--
  <div>編集</div>
  <form method="POST" action="update.php">
    <input type=hidden name="id" value="<?php echo current($data); ?>">
    <table border="1">

      <tr>
        <td>社員番号</td>
        <td><input type="text" name="code" value="<?php echo next($data); ?>" required></td>
      </tr>

      <tr>
        <td>社員名</td>
        <td><input type="text" name="name" value="<?php echo next($data); ?>" required></td>
      </tr>

      <tr>
       <td>社員名 かな</td>
       <td><input type="text" name="name_kana" value="<?php echo next($data); ?>" required></td>
      </tr>

      <tr>
        <td>性別</td>
        <td>
          <input type="radio" name="gender" value="1"<?php echo $checkbox[1]?>>男<br>
          <input type="radio" name="gender" value="2"<?php echo $checkbox[2]?>>女<br>
          <input type="radio" name="gender" value="0"<?php echo $checkbox[0]?>>選択しない
        </td>
      </tr>

    </table>

    <button type="button" onclick="location.href='./list.php'">戻る</button>
    <button type="submit">保存</button>
    
  </form>  -->
</body>
</html>
