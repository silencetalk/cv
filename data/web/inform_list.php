<?php
session_start();
if (intval($_SESSION['uid']) < 1) {
    header("Location: user_login.php");
    die("请先<a href='user_login.php'>登入</a>再添加Inform");
}
$is_login = true;
try {
    $dbh = new PDO('mysql:host=mysql.ftqq.com;dbname=fangtangdb', 'php', 'fangtang');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT `id`,`uid`,`title`,`created_at` FROM `inform` WHERE `uid` = ? AND `is_deleted` != 1";
    $sth = $dbh->prepare($sql);
    $ret = $sth->execute([intval($_SESSION['uid'])]);
    $inform_list = $sth->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $Exception) {
    die($Exception->getMessage());
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Daily Inform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="main.js"></script>
</head>

<body>
    <div class="container">
        <?php include 'header.php' ?>
        <h1>值班交接</h1>
        <?php if ($inform_list) : ?>
            <ul class="inform_list">
                <?php foreach ($inform_list  as $item) : ?>
                    <li id="infolist-<?= $item['id'] ?>">
                        <span class="menu_square_large"></span>
                        <a href="inform_detail.php?id=<?= $item['id'] ?>" class="title  middle" target="_blank"><?= $item['title'] ?></a>
                        <a href="inform_detail.php?id=<?= $item['id'] ?>" target="_blank"><img src="image/open_in_new.png" alt="查看"></a>
                        <a href="inform_modify.php?id=<?= $item['id'] ?>"><img src="image/mode_edit.png" alt="编辑"></a>
                        <a href="javascript:confirm_delete('<?= $item['id'] ?>');void(0);"><img src="image/close.png" alt="删除"></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <p><a href="inform_add.php" class="inform_add"><img src="image/add.png" alt="添加Inform"> 添加Inform</a></p>
    </div>
</body>

</html>