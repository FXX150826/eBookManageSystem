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
<body bgcolor="D9DFAA">
<!--<div align="center">-->
<!--    <p><font face="幼圆" size="5" color="#008000">-->
<!--            <b>图书信息管理</b></font></p>-->
<!--    <hr>-->
<!--</div>-->
<hr>
<br>
<br>
<?php   require "util/loginInfo.php"  ?>
<form name="frmSearchBook" method="post" action="BookInfoManage.php" style="margin: 0">
    <table width="390" align="center">
        <tr>
            <td>
                <div align="left">
                    <p><font face="幼圆" size="3" color="#000000"><b>根据编号查询图书信息：</b></font></p>
                </div>
            </td>
<!--            <td><td height="10" class="STYLE1" bgcolor="#CCCCCC">图书编号</td>-->
            <td><input name="BOOKID" size="13" type="text"></td>
            <td>
                <input type="submit" name="test" class="STYLE1" value="查找">
            </td>
        </tr>
    </table>
</form>
<?php
require "util/DBConnection.php";
@session_start();

if(@$_POST['BOOKID']){
    $bookid=@$_POST['BOOKID'];
    $_SESSION['BOOKID']=$bookid;
}elseif(isset($_SESSION['BOOKID'])){
    $bookid=$_SESSION['BOOKID'];
}else{
    $bookid =@$_POST['BOOKID'];
}
//echo "bookId= ".$bookid;
if($bookid!=null){
    $sql = "select * from bookinfo where bookId='$bookid' ";

    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    if(!$row){
        echo"<script>alert('没有该图书信息')</script>";
    }
    $_SESSION['BOOKID']=$row['bookId'];
}else{
    $sql = "";
    $row=null;
}
//print_r($row);
?>
<br><br>
<form name="frm2" method="post" style="margin: 0" enctype="multipart/form-data">
    <table bgcolor="#CCCCCC" width="390" border="1" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td bgcolor="#CCCCCC" width="90" align='center'><span >图书编号：</span></td>
            <td>
                <input name="BookId" type="text" size="35" class="STYLE1" value="<?php echo$row['bookId']; ?>">
                <input name="h_BookId" type="hidden" value="<?php echo$row['bookId'] ?>">
<!--                <span name="BookId" type="text" size="35" class="STYLE1">--><?php //echo$row['bookId']; ?><!--</span>-->
            </td>
        </tr>
        <tr>
            <td bgcolor="#CCCCCC" width="90" align='center'><span >图书名称：</span></td>
            <td>
                <input name="bookName" type="text" size="35" class="STYLE1" value="<?php echo$row['bookName']; ?>">
            </td>
        </tr>
        <tr>
            <td bgcolor="#CCCCCC" width="90" align='center'><span >图书类别：</span></td>
            <td>
                <?php
                require 'util/DBConnection.php';
                $sub_sql = "select subject from subjectinfo ";
                $sub_result = mysqli_query($conn,$sub_sql);

                echo"<select name='SUBJECT'>";
                echo"<option>    </option>";
                while($sub_row=mysqli_fetch_row($sub_result)){
                    if($sub_row[0]==$row['subject']) echo"<option selected>$sub_row[0]</option>";
                    else echo"<option>$sub_row[0]</option>";
                }
                echo"</select>";
                ?>
            </td>
        </tr>
        <tr>
            <td bgcolor="#CCCCCC" width="90" align='center'><span >图书语言：</span></td>
            <td>
                <?php
                require 'util/DBConnection.php';
                $lan_sql = "select lanName from languageInfo ";
                $lan_result = mysqli_query($conn,$lan_sql);

                echo"<select name='Language'>";
                echo"<option>    </option>";
                while($lan_row=mysqli_fetch_row($lan_result)){
                    if($lan_row[0]==$row['language']) echo"<option selected>$lan_row[0]</option>";
                    else echo"<option>$lan_row[0]</option>";
                }
                echo"</select>";
                ?>
            </td>
        </tr>
        <tr>
            <td bgcolor="#CCCCCC" align='center'><span >出版社：</span></td>
            <td>
                <input name="press" type="text" size="35" class="STYLE1" value="<?php echo$row['press']; ?>">
            </td>
        </tr>
        <tr>
            <td bgcolor="#CCCCCC" align='center'><span >作者：</span></td>
            <td>
                <input name="author" type="text" size="35" class="STYLE1" value="<?php echo$row['author']; ?>">
            </td>
        </tr>
        <tr>
            <td bgcolor="#CCCCCC" align='center'><span >贡献者：</span></td>
            <td>
<!--                <input name="contributor" type="text" size="35" class="STYLE1" value="--><?php //echo$row['contributor']; ?><!--">-->
                <?php
                require 'util/DBConnection.php';
                $con_sql = "select username from userinfo ";
                $con_result = mysqli_query($conn,$con_sql);

                echo"<select name='contributor'>";
                echo"<option>    </option>";
                while($con_row=mysqli_fetch_row($con_result)){
                    if($con_row[0]==$row['contributor']) echo"<option selected>$con_row[0]</option>";
                    else echo"<option>$con_row[0]</option>";
                }
                echo"</select>";
                ?>
            </td>
        </tr>
        <tr>
            <td bgcolor="#CCCCCC" align='center'> <span >库存：</span></td>
            <td>
                <input name="scope" type="text" size="35" class="STYLE1" value="<?php echo$row['scope'];?>">
            </td>
        </tr>
        <tr>
            <td bgcolor="#CCCCCC" align='center'><span >图书简介：</span></td>
            <td>
                <textarea cols="34" rows="4" name="insturction" class="STYLE1"><?php echo$row['insturction'];?></textarea>
            </td>
        </tr>
        <tr>
            <td bgcolor="#CCCCCC" align='center'><span >文件路径：</span></td>

            <td>
<!--                <textarea cols="34" rows="4" name="filepath" class="STYLE1">--><?php //echo$row['filepath'];?><!--</textarea>-->
                <input type="file" name="filepath">
                <input name="b" type="submit"   value="上传" CLASS="STYLE1">
                <input name="h_filepath" type="hidden" value="<?php echo$row['filepath'] ?>">
            </td>

        </tr>
        <tr>
            <td align="center" colspan="2" bgcolor="#CCCCCC">
                <input name="b" type="submit" value="修改" CLASS="STYLE1">&nbsp;&nbsp;
                <input name="b" type="submit" value="添加" CLASS="STYLE1">&nbsp;&nbsp;
                <input name="b" type="submit" value="删除" CLASS="STYLE1">
                <input name="b" type="submit" value="下载文件" CLASS="STYLE1">
<!--                <input name="b" type="button" value="下载文件" CLASS="STYLE1" onclick="window.location='util/DownloadBook.php'">-->
                <input name="b" type="button" value="退出" CLASS="STYLE1" onClick="unset($_SESSION['BOOKID']);window.location='MainFrame/mainPage.php'">
            </td>
        </tr>
    </table>
</form>
</body>
</html>
<?php
$bookId=@$_POST['BookId'];
$h_bookId=@$_POST['h_BookId'];
$bookName=@$_POST['bookName'];
$subject=@$_POST['SUBJECT'];
$language=@$_POST['Language'];
$press=@$_POST['press'];
$author=@$_POST['author'];
$filepath=@$_POST['filepath'];
$h_filepath=@$_POST['h_filepath'];
$insturction=@$_POST['insturction'];
$scope=@$_POST['scope'];
$contributor=@$_POST['contributor'];
if($contributor=="    "){
    $contributor=$_SESSION["LOGUSERNAME"];
}

if(@$_POST["b"]=="修改"){
    echo"<script>if(!confirm('确认修改')) return FALSE; </script>";
    if($bookId!=$h_bookId)
        echo "<script>alert('不能修改图书编号');</script>";
    else{
    require 'util/DBConnection.php';
        $sql="update bookInfo set bookName='$bookName',subject='$subject',language='$language',press='$press',author='$author',scope=$scope,filepath='$filepath',insturction='$insturction',contributor='$contributor'";
        $update_result=mysqli_query($conn,$sql);
        if(mysqli_affected_rows($conn)!=0){
            echo "<script>alert('修改成功！');</script>";
        }else{
            echo "<script>alert('修改失败！');</script>";
        }
    }
}
if(@$_POST["b"]=="添加"){

    $sql="select bookId from bookInfo where bookId = $bookId";
    $s_result=mysqli_query($conn,$sql);
    $s_row=mysqli_fetch_array($s_result);

    if($s_row)
        echo "<script>alert('图书已存在，无法添加！');</script>";
    else{
    require 'util/DBConnection.php';
    if(!$scope) $scope=0;
        $insert_sql = "insert into bookInfo(bookName,subject,language,press,author,scope,filepath,insturction,contributor) values ('$bookName','$subject','$language','$press','$author',$scope,'$filepath','$insturction','$contributor')";
        $insert_result=mysqli_query($conn,$insert_sql);

        if(mysqli_affected_rows($conn)!=0){
            if($filepath){
                if(uploadfile($conn,$bookId)){
                    $_SESSION['BOOKID'] = $bookId;
                    echo "<script>alert('添加成功！');</script>";
                }else{
                    echo "<script>alert('添加失败！');</script>";
                }
            }else{
                $_SESSION['BOOKID'] = $bookId;
                echo "<script>alert('添加成功！');</script>";
            }
        }else{
            echo "<script>alert('添加失败！');</script>";
        }
    }
}
if(@$_POST["b"]=="删除"){

    if($bookId==null){
        echo "<script>alert('请输入要删除的图书编号！');</script>";
    }else{
        $d_sql="select bookId from bookInfo where bookId = $bookId";
        $d_result=mysqli_query($conn,$d_sql);
        $d_row=mysqli_fetch_array($d_result);
        if(!$d_row)
            echo "<script>alert('图书不存在，无法删除！');</script>";
        else{
            $delect_sql = "delete from bookInfo where bookId=$bookId";
            $delect_result=mysqli_query($conn,$delect_sql);
            if(mysqli_affected_rows($conn)!=0){
                echo "<script>alert('删除成功！');</script>";
            }else{
                echo "<script>alert('删除失败！');</script>";
            }
        }
    }
}
if(@$_POST["b"]=="上传"){
    if(uploadfile($conn,$bookId)){
        $_SESSION['BOOKID'] = $bookId;
        echo"<script>alert('文件上传成功！,文件大小为：".($_FILES['filepath']['size']/1024)."KB')</script>";
    }else{
        echo"<script>alert('文件上传失败!')</script>";
    }
}
if(@$_POST["b"]=="下载文件"){

//    header("Location:util/DownloadBook.php");

//    $_SESSION['BOOKID'] = $bookId;
    $textname=$h_filepath;
    $newname=$bookName;

    header("Content-type:text/plain;charset='utf-8'");                  //设置下载文件类型
    header("Content-Length:".filesize($textname));          //设置下载文件大小
    header("Content-Disposition:attachment;filename=$newname");         //设置下载文件名

//    readfile($textname);

}
function uploadfile($conn,$bookId){
    if($_FILES['filepath']['error']>0){
        echo"错误：".$_FILES['filepath']['error'];
    }else{
        $tmp_filename=$_FILES['filepath']['tmp_name'];
        $filename=$_FILES['filepath']['name'];              //上传的文件名
        $dir="BookFiles/";
        if(is_uploaded_file($tmp_filename)){
            if(move_uploaded_file($tmp_filename,"$dir$filename")){
                if(@$_POST["b"]=="上传") {
                    require 'util/DBConnection.php';
                    $sql = "update bookInfo set filepath='$dir$filename' where bookId=$bookId";
                    $update_result = mysqli_query($conn, $sql);
                    if (mysqli_affected_rows($conn) != 0) {
                        return true;
                    } else {
                        return false;
                    }
                }else return true;
            }else{
                return false;
            }
        }
    }
}

?>
