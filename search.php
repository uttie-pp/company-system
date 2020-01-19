<?php
require "function.php";

session_start();
header("Content-type: text/html; charset=utf-8");
if (!isset($_SESSION["account"])) {
    header("Location: login_form.php");
    exit();
}
$account = $_SESSION['account'];
//echo "<p>Login ID:".htmlspecialchars($account,ENT_QUOTES)."</p>";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    include_once('database_config.php');
    try{
//        var_dump($_POST);
        $dbh = new PDO($dsn, $user, $password);
//        echo "DBに接続が成功しました<br>";
        }catch (PDOException $e) {
        echo "DBに接続が失敗しました: " . $e->getMessage() . "\n";
//        exit();
        }
        //IDおよびユーザー名の入力有無を確認
        if($_POST["code"] != "" OR $_POST["name"] != ""){
        //SQL文を実行して、結果を$stmtに代入する。
        $code = $_POST["code"];
        $name = $_POST["name"];
        $name_kana = $_POST["name_kana"];
        $gender = $_POST["gender"];
        $statement = $dbh->query("SELECT * FROM user WHERE code like '%$code%'
                                                       AND name like '%$name%'
                                                       AND name_kana like '%$name_kana%'
                                                       AND gender like '%$gender%'
                                                       ");
            if($statement){
                //プレースホルダへ実際の値を設定する
                $statement->bindValue(':code', "%".$_POST['code']."%", PDO::PARAM_STR);
                $statement->bindValue(':name', "%".$_POST['name']."%", PDO::PARAM_STR);
                $statement->bindValue(':name_kana', "%".$_POST['name_kana']."%", PDO::PARAM_STR);
                $statement->bindValue(':gender', "%".$_POST['gender']."%", PDO::PARAM_STR);
                if($statement->execute()){
                    //レコード件数取得
                    $row_count = $statement->rowCount();
                    while($row = $statement->fetch()){
                        $rows[] = $row;
                    }
                    foreach( $rows as $key => &$value){
                        $value['gender_j'] = gender_judge($value['gender']);
                    }
                
                }else{
                    echo "検索に失敗しました";
            }
//        echo "返り値の結果";
//        var_dump($rows);
        }
    }else{
        echo "ユーザの入力を確認できません";
        header('Location: search_form.php');
    exit();
    }
}
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html lang="ja">
<div class="cp_bgpattern06">
<head>
  <meta charset="UTF-8">
  <title>search.php</title>
  <!--Bootsrap 4 CDN-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!--Fontawesome CDN-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <!--Custom styles-->
  <link rel="stylesheet" type="text/css" href="style_company.css"> 
</head>
<body>
<div class="container">
    <h3 style="border-bottom: 1px solid #426579;border-left: 10px solid #426579;padding: 7px;">検索結果一覧</h3>
    <h4 style="border-bottom: 2px dotted #203744;"><?php echo "Login ID:".htmlspecialchars($account,ENT_QUOTES); ?></h4>

    <div class="d-flex justify-content-center h-30">
        <div class="card" style="width:70rem;height:33rem;background-color: rgba(0,0,0,0.0) !important;">
            <div class="table-responsive">
                <table border='1' class="table table-sm" style="table-layout:fixed;"><!--table table-sm-->
                    <thead class="thead-dark" align="center">
                    <tr><th scope="col" style="width:100px;">社員番号</th>
                    <th scope="col"style="width:150px;">社員名</th>
                    <th scope="col"style="width:200px;">社員名　かな</th>
                    <th scope="col" style="width:60px;">性別</th>
                    <th scope="col"style="width:180px;">登録日</th>
                    <th scope="col"style="width:180px;">更新日</th>
                    </thead>
                    <!-- ここでPHPのforeachを使って結果をループさせる -->
                    <?php foreach ($rows as $row): ?>
                        <tr><td align="center" class="text-light"><?php echo $row['code']; ?>
                        </td><td align="center" class="text-light"><?php echo htmlspecialchars($row['name'],ENT_QUOTES,'UTF-8'); ?>
                        </td><td align="center" class="text-light"><?php echo htmlspecialchars($row['name_kana'],ENT_QUOTES,'UTF-8');?>
                        </td><td align="center" class="text-light"><?php echo $value['gender_j'];?>
                        </td><td align="center" class="text-light"><?php echo $row['created_at'];?>
                        </td><td align="center" class="text-light"><?php echo $row['updated_at'];?></td></tr>
                    <?php endforeach; ?>
                </table>
                <button type="button" class="btn float edit_btn" onclick="history.back(); return false;">検索欄に戻る</button>
                <button type="button" class="btn float edit_btn" onclick="location.href='./list.php'">一覧に戻る</button>
            </div>
        </div>
    </div>
</div>
</body>
</div>
</html>

