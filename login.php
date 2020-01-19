<?php
session_start();
header("Content-type: text/html; charset=utf-8");

//クロスサイトリクエストフォージェリ（CSRF）対策のトークン判定
//if (empty($_POST['token'])){
//    echo "配列が空だよ<br>";
//}else{echo "配列が入ってるよ<br>";}

if($_POST['token'] != $_SESSION['token']){
    echo "不正アクセスの可能性あり";
    exit();
}
//クリックジャッキング対策
header('X-FRAME-OPTIONS: SAMEORIGIN');

//var_dump($_POST);
require "function.php";
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    include_once('database_config.php');
    
    $array_counter = 0;
    $array_check = variable_count($_POST);
    $array_counter = count($array_check);
    if($array_counter==0){
        $num = contents_check("login_id判定結果:",alpha($_POST['login_id']));
        $num += contents_check("pass判定結果:",alpha($_POST['pass']));

        if($num==0){
            try{
                $dbh = new PDO($dsn, $user, $password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                echo "DBに接続が成功しました<br>";
                }catch (PDOException $e) {
                echo "DBに接続が失敗しました: " . $e->getMessage() . "\n";
                include('create_new_id.html');
                exit();
            }
            $sql = 'SELECT * FROM login WHERE login_id = :login_id';
            $prepare = $dbh->prepare($sql);
//            $prepare->bindValue(':login_id', $_POST['login_id'], PDO::PARAM_STR);
//            $prepare->bindValue(':password', $_POST['pass'], PDO::PARAM_STR);
//            $result = $prepare->execute();
            $prepare -> execute(array(':login_id' => $_POST['login_id']));
            $result = $prepare->fetch(PDO::FETCH_ASSOC);
            if(password_verify($_POST['pass'], $result['password'])){
                echo "ログイン認証に成功しました";
                //セッションハイジャック対策
                session_regenerate_id(true);
                $_SESSION['account'] = $_POST['login_id'];
//                header( "Location: list.php". "?user=".$_POST['login_id']) ;
                header( "Location: list.php") ;
                exit();
            }else{
                echo "ログイン認証に失敗しました";
            } 
        
        }else{
            include('create_new_id.html');
            exit();
        }
    }else{
        echo count($array_check)."個の項目が空です<br>";
        array_htmlt($array_check);
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>insert</title>
</head>

<body>
  <div><?php /*echo($textarea)*/ ?></div> 
  <button type="button" onclick="location.href='./login_form.php'">ログインページへ</button>
</body>
</html>
