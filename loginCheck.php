<html>
<body background="image/bgimg1.jpg">
<br><br>
<div align="center">
    <p><font face="幼圆" size="6" color="#000000">
            <b>数字图书信息管理系统</b></font></p>
</div>
<br>
<form action="" method="post">
    <table border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td colspan="2" align="center" bgColoor="#999999">用户登录</td>
        </tr>
        <tr>
            <td>用户名：</td><td><input name="username" type="text"></td>
        </tr>
        <tr>
            <td>密码：</td><td><input name="password" type="password" "></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="submit" value="登录">
                <input type="reset" name="reset" value="重置">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<?php
require 'util/DBConnection.php';
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
//		$conn = mysql_connect('localhost','root','');
//		mysql_select_db('bookmanagesystem',$conn) or die('数据库选择失败');
    $sql = "select userId,password from userInfo where username='" . $username . "'";
    $result = mysqli_query($conn, $sql);
    if ($result != null) {
        $row = mysqli_fetch_array($result);

        if ($password == $row['password'] && $password) {
            session_start();
            $_SESSION['LOGUSERID'] = $row['userId'];
            $_SESSION['LOGUSERNAME'] = $username;
            header("Location:MainFrame/mainPage.php");
        } else {
            echo "<script>alter('登录失败');</script>";
        }
    } else {
        echo "sql语句执失败";
    }
}
?>