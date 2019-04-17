<?php
error_reporting(E_ALL & ~E_NOTICE);
session_start();
$is_login = intval($_SESSION['uid']) < 1 ? false : true;

try {
    $dbh = new PDO('mysql:host=mysql.ftqq.com;dbname=fangtangdb', 'php','fangtang');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT `id`,`uid`,`title`,`created_at` FROM `inform` WHERE `is_deleted` != 1";

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
    <title>值班交接</title>
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
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>

</html>