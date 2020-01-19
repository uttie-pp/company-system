<?php
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
            $sql = "INSERT INTO login (login_id, password) VALUES (:login_id, :password)";
            $prepare = $dbh->prepare($sql);
//            $prepare->bindValue(':login_id', $_POST['login_id'], PDO::PARAM_STR);
//            $prepare->bindValue(':password', $_POST['pass'], PDO::PARAM_STR);
//            $result = $prepare->execute();
            $result = $prepare->execute(array(':login_id' => $_POST['login_id'],':password' => password_hash($_POST['pass'], PASSWORD_DEFAULT)));
            if($result){
                echo "追加に成功しました<br>";
                }else{
                echo "追加に失敗しました<br>";
                include('create_new_id.html');
                exit();
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
