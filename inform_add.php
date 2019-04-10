<?php
session_start();
if (intval($_SESSION['uid']) < 1) {
        header("Location: user_login.php");
        die("请先<a href='user_login.php'>登入</a>再添加简历");
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>添加Inform</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="http://lib.sinaapp.com/js/jquery/3.1.0/jquery-3.1.0.min.js"></script>
    <script src="main.js"></script>
</head>

<body>
    <div class="container">
        <h1>添加Inform</h1>
        <form action="inform_save.php" method="post" id="form_inform" onsubmit="send_form('form_inform');return false;">
            <div id="form_inform_notice" class="form_info full"></div>

            <p><input type="text" name="title" placeholder="Inform标题" class="full" /></p>

            <p><textarea name="content" placeholder="Inform内容，支持 Markdown 语法" class="full"></textarea></p>


            <p><input type="submit" value="保存" class="middle-button"><input type="button" value="返回" class="middle-button cancel-button" onClick="history.back(1);void(0);"></p>
        </form>
    </div>
</body>

</html>