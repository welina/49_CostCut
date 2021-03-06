<?php
session_start();
//require（ファイル名）;
//指定されたファイルの中身が丸々移植される
//DBとつなげるときに使う関数require
require('../dbconnect.php');

//49_LearnSNSのセッションが空だった場合、register.phpに強制的に遷移（強制遷移の実装）
if(!isset($_SESSION['49_CostCut'])){
    //register.phpへの遷移処理
    header('Location: register.php');
    //exit();以降の処理は全ておこなわれない
    exit();
}

$name = $_SESSION['49_CostCut']['name'];
$email = $_SESSION['49_CostCut']['email'];
$password = $_SESSION['49_CostCut']['password'];

//POST送信されたとき（=POST送信じゃなく、ないとき
//register.phpからデータが送られてきた状態
if(!empty($_POST)){
    echo 'POST送信されました';
    //ユーザー登録処理
    //CREATE処理 INSERT文
    $sql = 'INSERT INTO `owners` (`name`,`email`,`password`,`created`)VALUES(?,?,?,NOW())';

    //password_hash
    //文字列を単純に保管するのは危険
    //ハッシュ化という文字列の暗号化をおこなう
    //$nameとかは16行目から18行目で定義している
    $data = [$name,$email,password_hash($password,PASSWORD_DEFAULT)];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    //不要になったセッション情報を破棄する
    unset($_SESSION['49_CostCut']);

    //index.phpへの遷移
    header('Location: count.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>CebuCostsSimulator</title>
    <link rel="stylesheet" type="text/css" href="js/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans+JP:700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css">
    <link href="js/material-kit.css?v=2.0.5" rel="stylesheet" />
</head>
<body style="margin-top: 60px">
    <div class="container">
        <div class="row">
            <div class="col-xs-8 col-xs-offset-2 thumbnail">
                <h2 class="text-center content_header">アカウント情報確認</h2>
                <div class="row">
                    <div class="col-xs-8">
                        <div>
                            <span>ユーザー名</span>
                            <p class="lead"><?php echo htmlspecialchars($name); ?></p>
                        </div>
                        <div>
                            <span>メールアドレス</span>
                            <p class="lead"><?php echo htmlspecialchars($email); ?></p>
                        </div>
                        <div>
                            <span>パスワード</span>
                            <p class="lead">●●●●●●●●</p>
                        </div>
                        <form method="POST" action="check.php">
                            <a href="register.php?action=rewrite" class="btn btn-default">&laquo;&nbsp;戻る</a>
                            <!-- type='hidden'ブラウザ上にはなにも表示がされない ユーザーが入力/選択する必要はないが、処理する上で必要なものを設定する-->
                            <input type="hidden" name="action" value="submit">
                            <input type="submit" class="btn btn-primary" value="ユーザー登録">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/jquery-3.1.1.js"></script>
    <script src="../assets/js/jquery-migrate-1.4.1.js"></script>
    <script src="../assets/js/bootstrap.js"></script>
</body>
</html>