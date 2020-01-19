<?php
session_start();
header("Content-type: text/html; charset=utf-8");
if (!isset($_SESSION["account"])) {
    header("Location: login_form.php");
    exit();
}
$account = $_SESSION['account'];
//echo "<p>Login ID:".htmlspecialchars($account,ENT_QUOTES)."</p>";
define('MAX','10'); // 1ページの記事の表示数
require "function.php";
include_once('database_config.php');
//echo "pageID=".$_GET['page_id']."<br>";
try{
    $dbh = new PDO($dsn, $user, $password);
//    echo "接続成功<br>";
        $sql = 'SELECT * FROM user';
    $statement = $dbh -> query($sql);
    
    //レコード件数取得
    $row_count = $statement->rowCount();
    
    while($row = $statement->fetch()){
        $rows[] = $row;
    }
    //データベース接続切断
    $dbh = null;
    
}catch (PDOException $e){
    echo "接続失敗<br>";
    print('Error:'.$e->getMessage());
    die();
}
    
foreach( $rows as $key => &$value){
    $value['gender_j'] = gender_judge($value['gender']);
}
unset($value);

$max_page = ceil($row_count / MAX); // トータルページ数※ceilは小数点を切り捨てる関数
if(!isset($_GET['page_id'])){ // $_GET['page_id'] はURLに渡された現在のページ数
    $now = 1; // 設定されてない場合は1ページ目にする
}else{
    $now = $_GET['page_id'];
}
$start_no = ($now - 1) * MAX; // 配列の何番目から取得すればよいか
// array_sliceは、配列の何番目($start_no)から何番目(MAX)まで切り取る関数
$rows_data = array_slice($rows, $start_no, MAX, true);
/*
foreach($rows_data as $row){ // データ表示
    echo $row['code']. '　'.$row['name']. '　'.$row['name_kana']. '　'.$row['gender']. '<br />';
}*/
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<div class="cp_bgpattern06">
<html>
<head>
<title>companyの社員名簿</title>
<meta charset="utf-8">
  <!--Bootsrap 4 CDN-->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

  <!--Fontawesome CDN-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <!--Custom styles-->
  <link rel="stylesheet" type="text/css" href="style_company.css">
</head>
<body><!-- background="images/desk.jpg" -->
<div class="container" style="height:14rem;">
<h3 style="border-bottom: 1px solid #426579;border-left: 10px solid #426579;padding: 7px;">社内システム</h3>
<h4 style="border-bottom: 2px dotted #203744;"><?php echo "Login ID:".htmlspecialchars($account,ENT_QUOTES); ?></h4>

    <div class="d-flex justify-content-center h-30">
        <div class="card-deck">
            <div class="btn-group d-flex" role="group" aria-label="...">
                <div class="btn-group btn-group-lg" >
                    <button type="button" class="btn float select_btn" onclick="location.href='insert_form.php'">追加</button>
                    <button type="button" class="btn float select_btn" onclick="location.href='search_form.php'">検索</button>
                    <button type="button" class="btn float select_btn" onclick="location.href='upload_list.php'">社内アルバム</button>
                    <button type="button" class="btn float select_btn" onclick="location.href='login_form.php'">ログアウト</button>
                </div>

                <div class="card" style="width:22rem;height:5rem;">
                  <!--  <p>社内アルバムへ写真の追加</p> -->
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <input type="file" class="btn ml-2" name="image" style="color:#FFFFFF:style="width:10rem;">
                        <input type="submit" class="btn float select_btn ml-4" value="画像アップロード" name="send">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
<h3 style="border-bottom: 1px solid #426579;border-left: 10px solid #426579;padding: 7px;">社員名簿一覧</h3>
<h4 style="border-bottom: 2px dotted #203744;">社員人数：<?php echo $row_count;?>人</h4>
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
        <th scope="col" style="width:80px;">編集</th>
        <th scope="col" style="width:80px;">削除</th></tr>
    </thead>
    <!--tbody-->
        <?php
        foreach($rows_data as $row){
        ?>
        <tr>
            <td align="center" class="text-light"><?php echo $row['code']; ?></td>
            <td align="center" class="name"><span class="text-light">
            <?php echo htmlspecialchars($row['name'],ENT_QUOTES,'UTF-8'); ?></td>
            </span>
            <td align="center" class="text-light"><?php echo htmlspecialchars($row['name_kana'],ENT_QUOTES,'UTF-8'); ?></td>
            <td align="center" class="text-light"><?php echo $row['gender_j']; ?></td>
            <td align="center" class="text-light"><?php echo $row['created_at']; ?></td>
            <td align="center" class="text-light"><?php echo $row['updated_at']; ?></td>
            <?php $send_edit = "update_form.php"."?id=".$row['id'].
                                                "&code=".$row['code'].
                                                "&name=".$row['name'].
                                                "&name_kana=".$row['name_kana'].
                                                "&gender=".$row['gender'];?>
            <td align="center"><button class="btn float edit_btn" onclick="location.href='<?php echo $send_edit; ?>'">編集</button></td>
            <?php $send_delete = "delete.php"."?code=".$row['code'];?>
            <td align="center">
            <button class="btn float edit_btn" onclick="location.href='<?php echo $send_delete; ?>'">削除</button>
            </td>
        </tr>
        <?php
        }
        ?>
    <!--/tbody-->
    </table>
</div>
</div>
</div>


<nav aria-label="Page navigation">
  <ul class="pagination pagination-lg">
<?php
for($i = 1; $i <= $max_page; $i++){ // 最大ページ数分リンクを作成
    if ($i == $now) { // 現在表示中のページ数の場合はリンクを貼らない
//        echo ' '. $now. ' '; 
          echo '<li class="page-item active"><a class="page-link" href=\'./list.php?page_id='. $now. '\'>'. $i.'</a>'.'</li>';
    } else {
//        echo '<a href=\'./list.php?page_id='. $i. '\')>'. $i. '</a>'. '　';
//          echo '<button type="button" onclick="location.href=\'./list.php?page_id='. $i.'&user='.$id. '\'">'. $i. '</a>'.'</button>';
          echo '<li class="page-item"><a class="page-link" href=\'./list.php?page_id='. $i. '\'>'. $i.'</a>'.'</li>';
//          <button type="button" onclick="location.href=\'./list.php?page_id='. $i.'&user='.$id. '\'">'. $i. '</a>'.'</button>';
    }
}
?>
  </ul>
</nav>
</div></div>
</body>
</div>
</html>


