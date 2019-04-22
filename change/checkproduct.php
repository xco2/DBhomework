<?php
if(isset($_GET)){
    $conn = mysqli_connect('localhost', 'root', '');
    mysqli_set_charset($conn,'utf8');
    if ($conn) {
        $pno=$_GET['pno'];
        mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
        $sql ="SELECT pname FROM product WHERE pno=".$pno.";";
        $amount =mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($amount);
        if($row==NULL){
            echo "查无此货";
        }else{
            echo $row[0];
        }
    }else{
        echo "连接数据库出错";
    }
}else{
    echo"..";
}