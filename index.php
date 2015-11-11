<!--
・NEWSにリンク
・ページ遷移機能
-->
<?php
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
      $view .= '<a href="news.php/?id='.$result['id'].'" method="get" action="news.php">'.$result['indate'].$result['news_title'].'</a><br>';
    }
    
  }
?>

<!DOCTYPE html>
<html>
<head>
    <title>チーズアカデミーTOKYO</title>
    <meta charset="UTF-8">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-2.1.0.min.js"></script>
    <script>
    $(function(){
        $(window).on("ready resize",function(){
        $(".slides").css({"width":1440,
                         "position":"relative",
                          left:-(1440-$(window).width())/2
                         });
        });
    });
    </script>
</head>
<body>

<div class="wrapper">
    <!-- header  -->
    <header id="header">
       <div class="inner clearfix">
        <h1 class="logo"><img src="image/logo-top.png" alt="Cheese Academy Tokyo" /></h1>
        <ul class="note_wrap">
            <li>CHEESE DEVELOPMENT</li>
            <li>GROWTH CHEESE</li>
            <li>CHEESE PERSPECTIVE</li>
            <li>CHEESE GENERATOR</li>
        </ul>
        </div>
    </header>

    <!--　main_visual   -->
    <section id="main_visual" class="slidesWrap">
        <div class="inner">
            <h2 class="catch">授業後払いのチーズ職人養成学校<br />『チーズアカデミーTOKYO』はじまります。</h2>
        </div>
        <div class="slider">
            <ul class="slides clearfix">
                <li><img src="image/photo-mini.png" alt="" /></li>
                <li><img src="image/photo-mini.png" alt="" /></li>
                <li class="center"><img src="image/photo-main.png" alt="" /></li>
                <li><img src="image/photo-mini.png" alt="" /></li>
                <li><img src="image/photo-mini.png" alt="" /></li>
            </ul>
        </div>

        <div class="inner">
           <?php include("nav.html"); ?>
        </div>
        
    </section>
    
    <!--news    -->
    <section id="news" class="contents-box">
        <h2 class="section-title yellow">NEWS</h2>
        <p class="section-note">お知らせ・更新情報</p>
        <div class="inner">
            <dl class="news-list clearfix">
<?=$view?>
<!--
                <dt class="news-list--date">2015.04.11</dt>
                <dd class="news-list--note"><a href="#">初日開講オリエンテーションが行われました！</a></dd>
                <dt class="news-list--date">2015.04.08</dt>
                <dd class="news-list--note"><a href="#">主席講師インタービューが更新されました！</a></dd>
                <dt class="news-list--date">2015.03.21</dt>
                <dd class="news-list--note"><a href="#">トーキョーチーズFesを開催いたしました！</a></dd>
-->
            </dl>
<!--            <p class="news-note__more"><a href="news.html">ニュース一覧を見る</a></p>-->
        </div>
    </section>
    
    <!--#feature-->
    <section id="feature" class="contents-box bg-orange">
        <h2 class="section-title white">FEATURE</h2>
        <p class="section-note">特徴</p>
        <div class="inner">
            <ul class="feature-list clearfix">
                <li class="clearfix">
                    <h3 class="point-heading white">POINT<span class="point-count white">1</span></h3>
                    <p class="white">
                        <span class="point-topics">一流職人によるチーズ作り指導</span>
                        基本習得後は2ヶ月間チーズ職人の指導で自家製チーズ完成を目指します。
                    </p>
                </li>
                <li class="clearfix">
                    <h3 class="point-heading white">POINT<span class="point-count white">2</span></h3>
                    <p class="white">
                        <span class="point-topics">960万円までの<br />
                        創業支援出資</span>
                        創業志望者をチーズアカデミー<br />
                        大学院が支援（審査あり）します。
                    </p>
                </li>
                <li class="last clearfix">
                    <h3 class="point-heading white">POINT<span class="point-count white">3</span></h3>
                    <p class="white">
                        <span class="point-topics">初心者歓迎授業料後払い</span>
                        丸暗記ではなく、創りながら。<br />
                        初心者のための授業料後払い制度です。
                    </p>
                </li>
            </ul>
        </div>
    </section>
    <!--end #feature-->
    
    <!--#concept    -->
    <section id="concept" class="contents-box">
        <h2 class="section-title yellow">CONCEPT</h2>
        <p class="section-note">コンセプト</p>
        <p class="contents-catch">世界を震わすチーズを創ろう。</p>
        <p class="contents-summary">
            今、世界中の人たちが足りないと感じている、栄養素があります。<br />
            その栄養は『カルシウム』と『マグネシウム』<br />
            小さい子供の成長に欠かせないカルシウム<br />
            イライラをなくすには欠かせないカルシウム<br />
            今まで食べたことのないチーズから取れるカルシウム<br />
            そんな悩みを抱えているあなたこそ、<br />
            プロレベルのチーズ作りスキルを持つべきだと思うのです。<br />
        </p>
        <p class="contents-summary">
            できるだけ多くの若い人に本格的なチーズ作りのスキルを学ぶ機会を創りたい。<br />
            そして願わくば、この場所から世界中の多くの人がおいしいと言えるような新感覚のチーズが生まれてほしい。
        </p>
        <p class="contents-summary">
            そんな思いでデジタルハリウッドが<br />
            チーズづくりのためだけの場所「チーズアカデミーTOKYO」をつくりました。
        </p>
        <p class="contents-summary">
            最初は全くの初心者でOK。<br />
            まずは純粋にチーズ作りを楽しんでいただくことから始めて、<br />
            最後には現役で活躍する一流農家のサポートを受けながら<br />
            オリジナルのチーズを開発〜完成させます。
        </p>
        <p class="contents-summary">
            卒業後の「就職」はもちろん「独立」まで、さまざまなサポート企業や<br />
            チーズアクセラレーターがバックアップ。
        </p>
        <p class="contents-summary">さあ、まもなく【CHEESE】への扉がひらかれます。</p>
    </section>
    <!--end #concept-->
    
    <!--#cource    -->
    <section id="gallery" class="contents-box">
        <div class="contents-heading bg-yellow">
            <h2 class="section-title">COURCE</h2>
            <p class="section-note white">コース紹介</p>
        </div>
        <div class="inner">

            <ul class="cource-list">
                <li class="clearfix">
                    <div class="cource-cap">
                        <img src="image/cource.png" alt="" />
                    </div>
                    <div class="cource-summary">
                        <h4>LABコース</h4>
                        <p>
                            週末集中型の初心者対象のチーズ職人養成講座です。
                            週末集中型の初心者対象のチーズ職人養成講座です。
                            週末集中型の初心者対象のチーズ職人養成講座です。
                            週末集中型の初心者対象のチーズ職人養成講座です。
                            週末集中型の初心者対象のチーズ職人養成講座です。
                        </p> 
                    </div>
                </li>
                <li class="clearfix">
                    <div class="cource-cap-reverse">
                        <img src="image/cource.png" alt="" />
                    </div>
                    <div class="cource-summary-reverse">
                        <h4>LABコース</h4>
                        <p>
                            週末集中型の初心者対象のチーズ職人養成講座です。
                            週末集中型の初心者対象のチーズ職人養成講座です。
                            週末集中型の初心者対象のチーズ職人養成講座です。
                            週末集中型の初心者対象のチーズ職人養成講座です。
                            週末集中型の初心者対象のチーズ職人養成講座です。
                        </p> 
                    </div>
                </li>     
            </ul>
        </div>
    </section>
    <!--end #cource-->

    <!--#gallery    -->
    <section id="gallery" class="contents-box">
        <div class="contents-heading bg-yellow">
            <h2 class="section-title">GALLERY</h2>
            <p class="section-note white">ギャラリー</p>
        </div>
        <div class="inner">
            <ul class="gallery-list clearfix">
                <li><a href=""><img src="image/gallery01.jpg" alt="" /></a></li>
                <li><a href=""><img src="image/gallery01.jpg" alt="" /></a></li>
                <li><a href=""><img src="image/gallery01.jpg" alt="" /></a></li>
                <li class="no-white-space"><a href=""><img src="image/gallery01.jpg" alt="" /></a></li>
                <li><a href=""><img src="image/gallery01.jpg" alt="" /></a></li>
                <li><a href=""><img src="image/gallery01.jpg" alt="" /></a></li>
                <li><a href=""><img src="image/gallery01.jpg" alt="" /></a></li>
                <li class="no-white-space"><a href=""><img src="image/gallery01.jpg" alt="" /></a></li>
                <li><a href=""><img src="image/gallery01.jpg" alt="" /></a></li>
                <li><a href=""><img src="image/gallery01.jpg" alt="" /></a></li>
                <li><a href=""><img src="image/gallery01.jpg" alt="" /></a></li>
                <li class="no-white-space"><a href=""><img src="image/gallery01.jpg" alt="" /></a></li>
            </ul>
        </div>
    </section>
    <!--end #gallery-->

    <!--#entry    -->
    <section id="entry" class="contents-box">
        <div class="contents-heading bg-orange">
            <h2 class="section-title">ENTRY</h2>
            <p class="section-note">説明会に申し込む</p>
        </div>
        <p class="entry-summary">入学をご希望の方に向けて、学校説明会を実施しております。<br />
フォームからお申し込みください。（無料・完全予約制）</p>
        <button class="entry-btn">
            <p class="entry-btn-title">ENTRY</p>
            <p class="entry-btn-note">説明会に申し込む</p>
        </button>
    </section>
    <!--end #entry-->
    
    <!--#information-->
    <section id="information" class="contents-box">
        <h2 class="section-title">INFORMATION</h2>
        <p class="section-note">基本情報</p>
        <div class="inner">
            <?php include("footer.html"); ?>
        </div>
    </section>
    <!--end #information-->
    
</div>
</body>
</html>