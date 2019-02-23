<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<head>
    <title>数字图书信息管理系统</title>
    <style type="text/css">
        <!--
        .STYLE1 {
            font-size: 15px;
            font-family: "幼圆";
        }
        body {
            background-color: transparent;
        }
        -->
    </style>
</head>
<body margintop="0" marginleft="0" marginbottom="0" marginright="0">
<hr>
<?php   require "../util/loginInfo.php"  ?>
<br><br>
<form name="frmSearchBook" method="post" action="main.php" style="margin: 0">
    <table width="650" align="center">
        <tr>
            <td colspan="7"><div align="left">
                    <p><font face="幼圆" size="3" color="#000000"><b>根据指定条件查询图书信息：</b></font></p>
                </div></td>
        </tr>
        <tr>
            <td height="10" class="STYLE1" bgcolor="#CCCCCC" align="center">编号</td>
            <td><input name="BOOKID" size="13" type="text"></td>
            <td class="STYLE1" bgcolor="#CCCCCC" align="center">名称</td>
            <td><input name="BOOKNAME" size="13" type="text"></td>
            <td class="STYLE1" bgcolor="#CCCCCC" align="center">类别</td>
            <td><?php
                require '../util/DBConnection.php';
                $sql = "select subject from subjectInfo ";
                $result = mysqli_query($conn, $sql);
                echo "<select name='SUBJECT'>";
                echo "<option>    </option>";
                while ($row = mysqli_fetch_row($result)) {
                    echo "<option>$row[0]</option>";
                }
                echo "</select>";
                ?>
            </td>
            <td  class="STYLE1" bgcolor="#CCCCCC" align="center">贡献者</td>
            <td>
                <?php
                require '../util/DBConnection.php';
                $con_sql = "select username from userinfo ";
                $con_result = mysqli_query($conn,$con_sql);

                echo"<select name='contributor'>";
                echo"<option>    </option>";
                while($con_row=mysqli_fetch_row($con_result)){
                    echo"<option>$con_row[0]</option>";
                }
                echo"</select>";
                ?>
            </td>
            <td  align="center">
                <input type="submit" name="test" class="STYLE1" value="查找">
            </td>
        </tr>
    </table>
</form>
<br>
<br>

<?php
require "../util/DBConnection.php";
@session_start();
//按照查询条件拼接sql语句
$bookid = @$_POST['BOOKID'];
$bookname = @$_POST['BOOKNAME'];
$subject = @$_POST['SUBJECT'];
$contributor = @$_POST['contributor'];
if ($subject == "    ") {
    $subject = null;
}
if ($contributor == "    ") {
    $contributor = null;
}
if ($bookid != null || $bookname != null || $subject != null || $contributor != null) {
    $sql = "select bookId,bookName,subject,language,author,contributor,press,scope from bookinfo where ";

    if ($bookid) {
        $sql = $sql . "bookId='$bookid' ";
    }
    if ($bookname) {
        $sql = $sql . "bookName like '%$bookname%' ";
    }
    if ($subject) {
        $sql = $sql . "subject='$subject' ";
    }
    if ($contributor) {
        $sql = $sql . "contributor='$contributor' ";
    }
} else {
    $sql = "select bookId,bookName,subject,language,author,contributor,press,scope from bookinfo";
    $row = null;
}
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);
if (!$row) {
    echo "<script>alert('没有该图书信息')</script>";
}
$_SESSION['BOOKID'] = $row['bookId'];
echo "<form name='frm2' method='post' action='main.php' style='margin: 0'>";
echo "<table width='600' border='1' align='center' cellpadding='0' cellspacing='0'>";
echo "<tr><td align='center' bgcolor='#CCCCCC'>编号</td><td align='center' bgcolor='#CCCCCC'>名称</td><td align='center' bgcolor='#CCCCCC'>类别</td><td align='center' bgcolor='#CCCCCC'>语言</td><td align='center' bgcolor='#CCCCCC'>作者</td><td align='center' bgcolor='#CCCCCC'>贡献者</td><td align='center' bgcolor='#CCCCCC'>出版社</td><td align='center' bgcolor='#CCCCCC'>库存</td></tr>";
while ($row) {

    echo "<tr><td align='center'><input type='radio' name='BOOKID' value='" . $row['bookId'] . "'>" . $row['bookId'] . "</td>";
    echo "<td align='center'>" . $row['bookName'] . "</td>";
    echo "<td align='center'>" . $row['subject'] . "</td>";
    echo "<td align='center'>" . $row['language'] . "</td>";
    echo "<td align='center'>" . $row['author'] . "</td>";
    echo "<td align='center'>" . $row['contributor']. "</td>";
    echo "<td align='center'>" . $row['press'] . "</td>";
    echo "<td align='center'>" . $row['scope'] . "</td>";
    echo "</tr>";
    $row = mysqli_fetch_array($result);
}
echo "<tr><td colspan='8' align='center' bgcolor='#CCCCCC'><input type='submit'  name='detail' class='STYLE1' value='查看详情'></tr>";
echo "</table>";
echo "</form>";
if (isset($_POST['detail'])) {
    $BOOKID = @$_POST['BOOKID'];
    if ($BOOKID) {
        $_SESSION['BOOKID'] = $BOOKID;
        header("Location:../BookInfoManage.php");
    } else {

    }
}
?>
</body>
</html>
