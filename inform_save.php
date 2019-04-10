<?php
session_start();
if (intval($_SESSION['uid']) < 1) {
        header("Location: user_login.php");
        die("请先<a href='user_login.php'>登入</a>再添加Inform");
    }
error_reporting(E_ALL & ~E_NOTICE);
// 获取输入参数
$title = trim($_REQUEST['title']);
$content = strip_tags(trim($_REQUEST['content']));
// 参数检查
if (strlen($title) < 1) die("Inform标题不能为空");
if (mb_strlen($content) < 10) die("Inform内容不能少于10个字符");
// die("数据OK");
// 链接数据库
try {
    $dbh = new PDO('mysql:host=mysql.ftqq.com;dbname=fangtangdb', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO `inform` ( `title` , `content` , `uid` , `created_at` ) VALUES ( ? , ? , ? , ? )";
    $sth = $dbh->prepare($sql);
    $ret = $sth->execute([$title, $content, intval($_SESSION['uid']), date("Y-m-d H:i:s")]);

    // header("Location: user_login.php");
    die("简历保存成功<script>location='inform_list.php'</script>");
} catch (PDOException $Exception) {
    $errorInfo = $sth->errorInfo();
    if ($errorInfo[1] == 1062) {
            die($Exception->getMessage() . "Inform标题已存在");
        } else {
            die($Exception->getMessage());
        }
} catch (Exception $Exception) {
    die($Exception->getMessage());
}
// echo $sql;
