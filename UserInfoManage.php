<html>
<meta http-equiv="Content-type" content="text/html;charset=UTF-8"/>
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
<body>
<!--<div align="center">-->
<!--    <p><font face="幼圆" size="5" color="#008000">-->
<!--            <b>用户信息管理</b></font></p>-->
<!--    <hr>-->
<!--</div>-->
<?php   require "util/loginInfo.php"  ?>
<hr>
<br><br>
<form name="frmUser" method="post" action="UserInfoManage.php" style="margin: 0">
    <table width="390" align="center">
        <tr>
            <td>
                <div align="left">
                    <p><font face="幼圆" size="3" color="#000000"><b>根据编号查询用户信息：</b></font></p>
                </div>
            </td>
            <td>
                <input name="USERID" id="UserId" type="text" size="10">
                <input type="submit" name="test" class="STYLE1" value="查找">
            </td>
        </tr>
    </table>
</form>
<?php
require "util/DBConnection.php";
@session_start();
if(@$_POST['USERID']){
    $number=@$_POST['USERID'];
    $_SESSION['USERID']=$number;
} elseif(isset($_SESSION['USERID'])){
    $number=$_SESSION['USERID'];
}else{
    if(isset($_SESSION['LOGUSERID'])){
        $number=$_SESSION['LOGUSERID'];
    }else{
        $number=@$_POST['USERID'];
        $_SESSION['USERID']=$number;
    }
}
$sql="select * from userinfo where userId=$number";

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);
if(($number!=null)&&(!$row))
    echo"<script>alert('没有该用户信息')</script>";
$timeTemp=strtotime($row['birthday']);
$time=date("Y-n-j",$timeTemp);
?>
<br><br>
<form name="frm2" method="post" style="margin: 0" enctype="multipart/form-data">
    <table bgcolor="#CCCCCC" width="390" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td bgcolor="#CCCCCC" width="100" align="center"><span >用户编号：</span></td>
            <td>
                <input name="UserId" type="text" size="35" class="STYLE1" value="<?php echo$row['userId']; ?>">
                <input name="h_UserId" type="hidden" value="<?php echo$row['userId'] ?>">
            </td>
        </tr>
        <tr>
            <td bgcolor="#CCCCCC" align="center"><span >用户姓名：</span></td>
            <td>
                <input name="UserName" type="text" size="35" class="STYLE1" value="<?php echo$row['username']; ?>">
            </td>
        </tr>
        <tr>
            <td bgcolor="#CCCCCC"  align="center"><span>登录密码：</span></td>
            <td>
                <input name="password" type="password" size="35" class="STYLE1" value="<?php echo$row['password']; ?>">
            </td>
        </tr>
        <tr>
            <td bgcolor="#CCCCCC"  align="center"><div >用户性别：</div></td>
            <?php
            if($row['usersex']==0){?>
                <td>
                    <input name="Sex" type="radio" value="1"><span class="STYLE1">男</span>
                    <input name="Sex" type="radio" value="0"><span class="STYLE1" checked="checked">女</span>
                </td>
            <?php
            }else{
                ?>

                <td>
                    <input name="Sex" type="radio" value="1"><span class="STYLE1" checked="checked">男</span>
                    <input name="Sex" type="radio" value="0"><span class="STYLE1" >女</span>
                </td>
            <?php
            }
            ?>

        </tr>
        <tr>
            <td bgcolor="#CCCCCC" align="center"><span >出生日期：</span></td>
            <td>
                <input name="birthday" type="text" size="35" class="STYLE1" value="<?php if($time) echo$time; ?>">
            </td>
        </tr>
        <tr>
            <td bgcolor="#CCCCCC" align="center"><span >职位：</span></td>
            <td>
                <input name="job" type="text" size="35" class="STYLE1" value="<?php echo$row['job']; ?>">
            </td>
        </tr>
        <tr>
            <td bgcolor="#CCCCCC" align="center"><span >电子邮箱：</span></td>
            <td>
                <input name="email" type="Email" size="35" class="STYLE1" value="<?php echo$row['email']; ?>">
            </td>
        </tr>
        <tr>
            <td bgcolor="#CCCCCC" align="center"><span >备注：</span></td>
            <td>
                <textarea cols="34" rows="4" name="insturction" class="STYLE1"><?php echo$row['insturction']; ?></textarea>
            </td>
        </tr>
        <tr>
            <td align="center" colspan="2" bgcolor="#CCCCCC">
                <input name="b" type="submit" value="修改" CLASS="STYLE1">&nbsp;&nbsp;
                <input name="b" type="submit" value="添加" CLASS="STYLE1">&nbsp;&nbsp;
                <input name="b" type="submit" value="删除" CLASS="STYLE1">&nbsp;&nbsp;
                <input name="b" type="button" value="退出" CLASS="STYLE1" onClick="window.location='MainFrame/mainPage.php'">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<?php
$userId=@$_POST['UserId'];
$h_userId=@$_POST['h_UserId'];
$username=@$_POST['UserName'];
$password=@$_POST['password'];
$usersex=@$_POST['Sex'];
$birthday=@$_POST['birthday'];
$job=@$_POST['job'];
$email=@$_POST['email'];
$insturction=@$_POST['insturction'];
if(@$_POST["b"]=="修改"){
    echo"<script>if(!confirm('确认修改')) return FALSE; </script>";

    if($userId!=$h_userId)
        echo "<script>alert('不能修改学号');</script>";
    else{
        $sql="update userInfo set userId=$userId,username='$username',password='$password',usersex=$usersex,birthday='$birthday',job='$job',email='$email',insturction='$insturction'";
        $update_result=mysqli_query($conn,$sql);
        if(mysqli_affected_rows($conn)!=0){
            $_SESSION['USERID']=$userId;
            echo "<script>alert('修改成功！');</script>";
        }else{
            echo "<script>alert('修改失败！');</script>";
        }
    }
}
if(@$_POST["b"]=="添加"){
    $sql="select userId from userInfo where userId = $userId";
    $s_result=mysqli_query($conn,$sql);
    $s_row=mysqli_fetch_array($s_result);
    if($s_row)
        echo "<script>alert('学号已存在，无法添加！');</script>";
    else{
        $insert_sql = "insert into userInfo(userId,username,password,usersex,birthday,job,email,insturction) values ($userId,'$username','$password',$usersex,'$birthday','$job','$email','$insturction')";
        $insert_result=mysqli_query($conn,$insert_sql);
        if(mysqli_affected_rows($conn)!=0){
            $_SESSION['USERID']=$userId;
            echo "<script>alert('添加成功！');</script>";
        }else{
            echo "<script>alert('添加失败！');</script>";
        }
    }
}
if(@$_POST["b"]=="删除"){
    if($userId==null){
        echo "<script>alert('请输入要删除的用户编号！');</script>";
    }else{
        $d_sql="select userId from userInfo where userId = $userId";
        $d_result=mysqli_query($conn,$d_sql);
        $d_row=mysqli_fetch_array($d_result);
        if(!$d_row)
            echo "<script>alert('学号不存在，无法删除！');</script>";
        else{
            $delect_sql = "delete from userInfo where userId=$userId";
            $delect_result=mysqli_query($conn,$delect_sql);
            if(mysqli_affected_rows($conn)!=0){
                echo "<script>alert('删除成功！');</script>";
            }else{
                echo "<script>alert('删除失败！');</script>";
            }
        }
    }
}

?>
