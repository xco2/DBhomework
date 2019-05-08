<?php
if(isset($_GET['no'])&&isset($_GET['choic'])){
    $conn = mysqli_connect('localhost', 'root', '');
    mysqli_set_charset($conn,'utf8');
    if ($conn) {
        mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
        $choic=$_GET['choic'];
        $no=$_GET['no'];
        $sql="DELETE FROM ".$choic." WHERE ";
        if($choic=="customer"){
            $sql=$sql."cno=\"".$no."\";";
        }else if($choic=="product"){
            $sql=$sql."pno=\"".$no."\";";
        }else if($choic=="invoice"){
            $sql=$sql."ino=\"".$no."\";";
        }
        if(mysqli_query($conn, $sql)){
            echo "删除完成";
        }else{
            echo "无法删除";
        }
    }
}