
<?php
if(!isset($_POST["post_flg"])){
  //echo "パラメータが無いので登録処理は無し";
}else{
    
  //1. 接続します
  $pdo = new PDO('mysql:dbname=demo_cms;host=localhost', 'root', '');

  //2. DB文字コードを指定
  $stmt = $pdo->query('SET NAMES utf8');
    
  //$id = $_POST["id"];
  $news_title = $_POST["news_title"];
  $news_detail = $_POST["news_detail"];
  $view_flg = 1;
  $name = $_POST["name"];
  $mail = $_POST["mail"];
  $indate = date("Y-m-d H:i:s");
    
    
  //３．データ登録SQL作成
  $stmt = $pdo->prepare("INSERT INTO cms_table (id, news_title, news_detail, view_flg, indate, name, mail)VALUES(NULL, :news_title, :news_detail, :view_flg, :indate, :name, :mail)");
  $stmt->bindValue(':news_title', $news_title);
  $stmt->bindValue(':news_detail', $news_detail);
  $stmt->bindValue(':view_flg', $view_flg);
  $stmt->bindValue(':indate', $indate);
  $stmt->bindValue(':name', $name);
  $stmt->bindValue(':mail', $mail);
    
    
    
  $status = $stmt->execute();   //sql実行
  if($status==false){
    echo "SQLエラー";
    exit;
  }else{
      echo "登録完了";
  }
}

?>


<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>NEWS登録</title>
  <link href="css/reset.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div id="main">
 
 <h1>チーズアカデミー　NEWS登録</h1>
  <div class="container">
        <div class="row">
<!--     フォーム-->
                  <div class="container" style="padding:20px 0">
                     <!--                   アンケート-->
                      <form class="form-inline" method="post" action="insert.php" enctype="multipart/form-data" id="send_file">
                          <div class="form-group">
            <!--               名前-->
                            <label class="contorol-label" for="name">名前</label>
                            <br>
                              <textarea type="text" id="name"  name="name" class="form-control" placeholder="name"></textarea>
                            <br>
            <!--                  メール-->
                              <label class="contorol-label" for="mail">メール</label>
                              <br>
                              <textarea type="text" id="mail" name="mail" class="form-control" placeholder="mail"></textarea>
                                <br>
            <!--                  タイトル-->
                             <label class="contorol-label" for="news_title">タイトル</label>
                              <br>
                              <textarea type="text" id="news_title" name="news_title" class="form-control" placeholder="news_title"></textarea>
                                <br>
            <!--                  記事-->
                              <label class="contorol-label" for="news_detail">記事</label>
                              <br>
                              <textarea type="text" id="news_detail" name="news_detail" class="form-control" placeholder="news_detail"></textarea>
                                <br>
                                  <!--                 送信ボタン-->
                                  <input type="submit" value="送信" class="btn btn-primary btn-lg">
            <input type="hidden" name="post_flg" value="1">
                          </div>
                      </form>
                  </div>
            </div>
        </div>
</div>

</body>
</html>
