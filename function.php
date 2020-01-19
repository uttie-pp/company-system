<?php
function gender_judge($num){
   switch ($num) {
      case $num == NULL:
         return '不明';
      case $num == 1:
         return '男性';
      case $num == 2:
         return '女性';
      default:
      return 'error';
    }
}
/*
function check_box($j,$num){
    var_dump($num);
    $num[$j] = "checked";
    return $num;
}*/

function array_flatten($array){
    $result = array();
        foreach($array as $val){
            if(is_array($val)){
                $result = array_merge($result, array_flatten($val));
            }else{
                $result[]=$val;
            }
        }
    return $result;
}

//自然数か判定
function empty_or_natural($N,$C){
    if(empty($N)){
        echo "新規登録に失敗しました<br>";
        echo $C.":未入力です<br>";
        include('button.html');
        exit();
    }
    $ans = preg_match('/\A[1-9][0-9]*\z/', $N);
    if($ans == 1){
    }else{
        echo "新規登録に失敗しました<br>";
        echo $C.":登録できる形式ではありません<br>";
        exit();
    }
}

function array_empty($array){
//    var_dump($array);
    $buf = array();
    foreach ($array as $key => $value) {
/*    echo $key; // $keyにインデックスの文字が入っている
    echo "'s sales is ";
    echo $value; // $valueにデータが入っている*/
    if(empty($value)){
    $hoge = "empty";
        }else{
    $hoge = "full";
    }
    $buf = array_merge($buf,array($key=>$hoge));
//    echo "<br>";
    }
//    var_dump($buf);
//    exit();
    return $buf;
}
function empty_count($array){
    $buf = 0;
    foreach ($array as $key => $value) {
    if($value=="empty"){
    $buf++;
        }
    }
    return $buf;
}
function variable_count($array){
    $buf = array();
    foreach ($array as $key => $value) {
    if($value===""){
    $hoge = "未入力です";
    $buf = array_merge($buf,array($key=>$hoge));
        }else{
//    $hoge = "full";
        }
    }
    return $buf;
}
function array_htmlt($array){
    foreach ($array as $key => $value) {
    echo $key. ":".  $value. "<br>";
    }
    include('button.html');
    exit();
}
function hiragana($word){
if(preg_match('/[^ぁ-んー]/u',$word)){
//   echo 'すべて ひらがな でない';
   return 1;
   }
   else{
//   echo 'すべて ひらがな';
   return 0;
   }
}
function katakana($word){
if(preg_match('/[^ァ-ヶー]/u',$word)){
//   echo 'すべて カタカナ でない';
   return 1;
   }
   else{
//   echo 'すべて カタカナ';
   return 0;
   }
}
function kanji($word){
if(preg_match('/[^一-龠]/u',$word)){
//   echo 'すべて 漢字 でない';
   return 1;
   }
   else{
//   echo 'すべて 漢字';
   return 0;
   }
}
function hiragana_kanji($word){
if(preg_match('/[^ぁ-んーァ-ヶー]/u',$word)){
//    echo 'すべて ひらがな と カタカナ でない';
    return 1;
    }
    else{
//    echo 'すべて ひらがな と カタカナ';
    }
}
function hiragana_katakana_kanji($word){
if(preg_match('/[^ぁ-んーァ-ヶー一-龠]/u',$word)){
//    echo 'すべて ひらがなとカタカナと漢字でない';
//    exit();
    return 1;
    }
    else{
//    echo 'すべて ひらがなとカタカナと漢字';
//    exit();
    return 0;
    }
}
function natural($word){
    if(preg_match('/\A[0-9][0-9]*\z/', $word)){
//    echo "自然数です<br>";
    return 0;
    }
    else{
//    echo "自然数ではない<br>";
    return 1;
    }
}
function contents_check($comment,$velue){
    if($velue){
    echo $comment."登録できる形式ではありません";
    return 1;
//    exit();
    }
    return 0;
}
function alpha($word){
    if(preg_match('/^[a-zA-Z]+$/', $word)){
//    echo "英字です<br>";
    return 0;
    }
    else{
//    echo "英字ではない<br>";
    return 1;
    }
}
function alpha_num($word){
    if(preg_match('/^[a-zA-Z0-9]+$/', $word)){
//    echo "英数字です<br>";
    return 0;
    }
    else{
//    echo "英数字ではない<br>";
    return 1;
    }
}


?>
