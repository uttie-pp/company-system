<?php
session_start();
header("Content-type: text/html; charset=utf-8");

//クロスサイトリクエストフォージェリ（CSRF）対策
$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
$token = $_SESSION['token'];

//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');
//echo $token;

?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!DOCTYPE html>
<html>
<head>
  <title>ログイン</title>
  <script src ="js/jquery-3.4.1.min.js"></script>
  
  <!--Bootsrap 4 CDN-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <!--Fontawesome CDN-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <!--Custom styles-->
  <link rel="stylesheet" type="text/css" href="style_company.css"> 

  <style type="text/css">
  </style>
</head>
<body background="images/cupcake.jpg">
<div class="container">
  <div class="d-flex justify-content-center h-100">
    <div class="card">
      <div class="card-header">
        <h3 class="mt-4">Company login form</h3>
        <div class="d-flex justify-content-end social_icon">
        </div>
      </div>

        <div class="card-body">
        <form action="login.php" method="post">
          <div class="input-group form-group">
<!--            <label class="control-label">ログインID</label> -->
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-user"></i></span>
            </div>
<!--            <input type="text" class="form-control" placeholder="username">-->
             <input class="form-control" type ="text" name="login_id" placeholder="Login ID" value="">
          </div>

          <div class="input-group form-group">
<!--            <label class="control-label">パスワード</label> -->
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            <input class="form-control" type ="text" name="pass" placeholder="Password" value="">
          </div>
          <input type="hidden" name="token" value="<?php echo $token; ?>">
          <?php //echo $token; ?>
          <button type="submit" class="btn float-right login_btn">ログイン</button>
        </form>
      </div>

      <div class="card-footer">
        <div class="d-flex justify-content-center links">
          <button type="button" class="btn btn-outline-warning new_reg_btn" onclick="location.href='./register_form.php'">新規登録画面へ</button>
        </div>
     </div>

  </div>
</div>
</div>



<script>
  $(function(){
//    $("h1").css("color","red");
  })
</script>

</body>
</html>