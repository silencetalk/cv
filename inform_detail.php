<?php

$id = intval($_REQUEST);
if ($id < 1) die("错误的Inform id");

try {
    $dbh = new PDO('mysql:host=mysql.ftqq.com;dbname=fangtangdb', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM `inform` WHERE `id` = ? AND LIMIT 1";
    $sth = $dbh->prepare($sql);
    $ret = $sth->execute($id);
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
    <title><?$inform['title']?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="main.js"></script>
</head>

<body>
    <div class="container">
       <div class="contrnt">
          <?$inform['content']?> 
       </div>
    </div>
</body>

</html>