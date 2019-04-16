<?php
session_start();
if (intval($_SESSION['uid']) < 1) {
        header("Location:user_login.php");
        die("请先<a href='user_login.php'>登录</a>再添加Inform");
    }
error_reporting(E_ALL & ~E_NOTICE);

$id = intval($_REQUEST['id']);
if ($id < 1) die("错误的Inform id");

try {
    $dbh = new PDO('mysql:host=mysql.ftqq.com;dbname=fangtangdb', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM `inform` WHERE `uid` = ? LIMIT 1";

    $sth = $dbh->prepare($sql);
    $ret = $sth->execute([$id]);
    $inform = $sth->fetchAll(PDO::FETCH_ASSOC);

    if ($inform['uid'] != $_SESSION['uid']) die("只能修改自己建立的Inform");
} catch (Exception $Exception) {
    die($Exception->getMessage());
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>修改Inform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="main.js"></script>
</head>

<body>
    <div class="container">
        <h1>修改Inform</h1>
        <form action="inform_update.php" method="post" id="form_inform" onsubmit="send_form('form_inform');return false;">
            <div id="form_inform_notice" class="form_info full"></div>

            <p><input type="text" name="title" placeholder="Inform名称" class="full" value="<?= $inform['title'] ?>" /></p>

            <p><textarea name="content" placeholder="Inform内容，支持 Markdown 语法" class="full"><?= htmlspecialchars($inform['content']) ?></textarea></p>

            <input type="hidden" name="id" value="<?= $inform['id'] ?>" />
            <p><input type="submit" value="更新Inform" class="middle-button"><input type="button" value="返回" class="middle-button cancel-button" onClick="history.back(1);void(0);"></p>
        </form>
    </div>
</body>

</html>