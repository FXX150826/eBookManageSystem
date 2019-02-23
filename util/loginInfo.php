<?php
    session_start();
    if(isset($_SESSION["LOGUSERID"])){
        $LOGUSERID=@$_SESSION["LOGUSERID"];
//        echo"<div align='right'><p><font face='隶书' size='2' color='#ffffff'><b>你好，$USERNAME</b></font></p><hr></div>";
    }else{
        header("Location:/loginCheck.php");
    }
?>

