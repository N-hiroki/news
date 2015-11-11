<!--
・変更機能
・ページ遷移機能（前へ、次へ）
・list.phpに戻れるようにする機能
-->
<?php
//1. 接続します
$pdo = new PDO('mysql:dbname=demo_cms;host=localhost', 'root', '');

//2. DB文字コードを指定
$stmt = $pdo->query('SET NAMES utf8');
    
//    ３．データ登録SQL作成
//    id基準で降順　１件毎の表示
$id = htmlspecialchars($_GET["id"]);
$stmt = $pdo->prepare("SELECT * FROM cms_table WHERE id = $id");
$flag = $stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if($flag==false){
    //エラーチェク
    $view = "SQLエラー1";
    echo "<br>".$view;
    exit;
}

    //データ表示
    $view="";
    $id = $result['id'];
    $view_name = $result['name'];
    $view_mail = $result['mail'];
    $view_title = $result['news_title'];
    $view_detail = $result['news_detail'];
    $indate = $result['indate'];
          
    $view .= '<p>ID：'.$result['id'] .'<br>作成日時：'.$result['indate'].'<br>名前：' .
             $result['name'] .'<br>メール:'. $result['mail'] . '<br>タイトル:'. $result['news_title'] . '<br>記事:'. $result['news_detail'] . '</p>';



if (isset($_POST["sub1"])) {
    $kbn = htmlspecialchars($_POST["sub1"], ENT_QUOTES, "UTF-8");
    //$kbnの値により分岐
    switch ($kbn) {
        case '前へ':
            //降順なのでインクリメント
            ++$id;
            echo $id;
        
            //データ登録SQL作成
            
            $stmt = $pdo->prepare("SELECT * FROM cms_table ORDER BY id DESC LIMIT 1 OFFSET :id");

            //データ表示
            $view="";
            if($flag==false){
                //エラーチェク
                $view = "SQLエラー1";
            }else{
                 $result = $stmt->fetch(PDO::FETCH_ASSOC);
                       $view .= '<p>ID：'.$result['id'] .'<br>作成日時：'.$result['indate'].'<br>名前：' .
             $result['name'] .'<br>メール:'. $result['mail'] . '<br>タイトル:'. $result['news_title'] . '<br>記事:'. $result['news_detail'] . '</p>';
                    }
        
            //case 前へ終了
            break;
        
        case '次へ':
            //降順なのでデクリメント
            --$id;
            echo $id;
            //表示許容範囲を超えないための処理
            if($id < 1){
                $id = 1;
            }
            //チェック用echo
            echo $id;
            
            $stmt = $pdo->prepare("SELECT * FROM cms_table ORDER BY id DESC LIMIT 1 OFFSET :id");
            //SQL実行
            $flag = $stmt->execute();

            //データ表示
            $view="";
            if($flag==false){
//            エラーチェック
                $view = "SQLエラー1-1";
            }else{
                //SQL実行OK!!
                      $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    //データベース上のデータをHTML上に出力
                    //whileで回して設定件分出力
                        $view .= '<p>ID：'.$result['id'] .'<br>作成日時：'.$result['indate'].'<br>名前：' .
             $result['name'] .'<br>メール:'. $result['mail'] . '<br>タイトル:'. $result['news_title'] . '<br>記事:'. $result['news_detail'] . '</p>';
                    }
                //case 次へ終了
                break;
         
        //全件削除
        case '全削除':
            //caseに入っているかチェック用echo
            echo "全削除";
            $stmt = $pdo->query("DELETE FROM `cms_table`");
            //case 全件削除 終了
        break;
        
        //今閲覧しているデータ1件削除
        case '1件削除':
            //caseに入っているかチェック用echo
            echo "1件削除";
            //閲覧している１件削除
            
            $stmt =$pdo->prepare("DELETE FROM cms_table WHERE id = :id");
            $result = $stmt->bindParam(':id',$id, PDO::PARAM_INT);
            $flag = $stmt->execute();
        
            break;
            
        //エラーチェック
        default:  echo "エラー"; exit;
        }
    }


if(!isset($_POST["post_flg"])){
  //echo "パラメータが無いので登録処理は無し";
}else{

  $news_title = $_POST["news_title"];
  $news_detail = $_POST["news_detail"];
  $view_flg = $_POST["view_flg"];
  $name = $_POST["name"];
  $mail = $_POST["mail"];


    
  $stmt = $pdo->prepare("UPDATE cms_table SET news_title=':news_title' WHERE id=:id");
  $stmt = $pdo->prepare("UPDATE cms_table SET news_detail=':news_detail' WHERE id=:id");
  $stmt = $pdo->prepare("UPDATE cms_table SET view_flg=':view_flg' WHERE id=:id");
  $stmt = $pdo->prepare("UPDATE cms_table SET name=':name' WHERE id=:id");
  $stmt = $pdo->prepare("UPDATE cms_table SET mail=':mail' WHERE id=:id");

    
  $status = $stmt->execute();   //sql実行
  if($status==false){
    echo "SQLエラー2-1";
    exit;
  }else{
      echo "変更完了";
  }
}

?>




<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>アップデート</title>
  <link href="css/reset.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div id="main">

 <h1 id="title">NEWS　変更</h1>
  <div class="container">
       <div class="container jumbotron">
       <?=$view?>
            <form method="POST" action="">
                <input type="submit" value="前へ" name="sub1">
                <input type="submit" value="次へ" name="sub1">
                <input type="submit" value="全削除" name="sub1">
                <input type="submit" value="1件削除" name="sub1">
            </form>

        </div>
        <div class="row">
<!--     フォーム-->
                  <div class="container" style="padding:20px 0">
                     <!--                   アンケート-->
                      <form class="form-inline" method="post" action="update.php" enctype="multipart/form-data" id="send_file">
                          <div class="form-group">
            <!--               名前-->
                            <label class="contorol-label" for="name">名前</label>
                            <br>
                              <textarea type="text" id="name"  name="name" class="form-control" placeholder="name"><?=$view_name?></textarea>
                            <br>
            <!--                  メール-->
                              <label class="contorol-label" for="mail">メール</label>
                              <br>
                              <textarea type="text" id="mail" name="mail" class="form-control" placeholder="mail"><?=$view_mail?></textarea>
                                <br>
            <!--                  タイトル-->
                             <label class="contorol-label" for="news_title">タイトル</label>
                              <br>
                              <textarea type="text" id="news_title" name="news_title" class="form-control" placeholder="news_title"><?=$view_title?></textarea>
                                <br>
            <!--                  記事-->
                              <label class="contorol-label" for="news_detail">記事</label>
                              <br>
                              <textarea type="text" id="news_detail" name="news_detail" class="form-control" placeholder="news_detail"><?=$view_detail?></textarea>
                                 <br>
                                 <label class="contorol-label" for="view_flg">記事「表示・非表示」</label>
                              <br>
                              <label class="contorol-label" for="view_flg">表示</label>
                              <input type="radio" name="view_flg" value="1">
                              <label class="contorol-label" for="view_flg">非表示</label>
                              <input type="radio" name="view_flg" value="0">
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
<a href="list.php">戻る</a>
</body>
</html>
