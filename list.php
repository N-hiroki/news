<!--
・一件毎にリンク機能
・ページ遷移機能（次へ、前へ）
-->
<?php
//1. 接続します
$pdo = new PDO('mysql:dbname=demo_cms;host=localhost', 'root', '');

//2. DB文字コードを指定
$stmt = $pdo->query('SET NAMES utf8');

//３．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM cms_table ORDER BY id DESC LIMIT 5");


//４．SQL実行
$flag = $stmt->execute();

//データ表示
$view="";
if($flag==false){
  $view = "SQLエラー";
}else{
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
      $id = $result['id'];
      $view .= '<a href="update.php/?id='.$result['id']. '"method="get" action="update.php">'.$result['indate']. $result['name'] . $result['mail'] . '</a><br>';
      
    }
    
  }
if (isset($_POST["sub1"])) {
    $kbn = htmlspecialchars($_POST["sub1"], ENT_QUOTES, "UTF-8");
    switch ($kbn) {
        case "前へ":
        $id += 5;
        echo $id;
        
        $stmt = $pdo->prepare("SELECT * FROM cms_table ORDER BY id DESC LIMIT 5 OFFSET :id");
        

            //データ表示
        $view="";
        if($flag==false){
    
        $view = "SQLエラー1";
        }else{
            while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
                
      $view .= '<a href="update.php/?id=id" method="get" action="update.php">'.$result['indate']. $result['name'] . $result['mail'] . '</a><br>';
            }
        }
        break;
        
        case "次へ":
        $id -= 5;
        if($id < 5){
            $id = 5;
        }
        echo $id;
            $stmt = $pdo->prepare("SELECT * FROM cms_table ORDER BY id DESC LIMIT 5 OFFSET :id");
            
            
            //データ表示
            $view="";
            if($flag==false){
    
            $view = "SQLエラー1-1";
            }else{
                while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
      $view .= '<a href="update.php/?id=id" method="get" action="update.php">'.$result['indate']. $result['name'] . $result['mail'] . '</a><br>';
                }
            }
        
        break;
        
        default:  echo "エラー"; exit;
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>NEWSリスト</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body id="main">
    <div class="container jumbotron">
    <?=$view?>
    <form method="POST" action="">
    <input type="submit" value="前へ" name="sub1">
    <input type="submit" value="次へ" name="sub1">
    </form>
   </div>
    
<script src="js/jquery-2.1.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
