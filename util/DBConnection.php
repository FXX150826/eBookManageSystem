<?php
$server = "localhost";    //服务器名
$user = "root";           //用户名
$password = "";           //密码
$database = "bookmanagesystem";           //要连接的数据库
$DSN = "mysql:host="+$server+";dbname="+$database;

$conn = mysqli_connect($server,$user,$password);    //连接服务器
mysqli_select_db($conn,$database) or die('数据库选择失败');//打开数据库

mysqli_query($conn,"SET NAMES 'utf8'");              //设置字符集
//-------------------PDO方式连接数据库---------------
/*try{
    $db = new PDO($DSN,$user,$password);
}catch(PDOException $e){
    echo"数据库连接失败：".$e->getMessage();
}*/
?>