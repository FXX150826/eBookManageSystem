<?php
$_SESSION['BOOKID'] = $bookId;
$textname=$h_filepath;
$newname=$bookName.".txt";

header("Content-type:text/plain;charset='utf-8'");                  //设置下载文件类型
header("Content-Length:".filesize($textname));          //设置下载文件大小
header("Content-Disposition:attachment;filename=$newname");
?>