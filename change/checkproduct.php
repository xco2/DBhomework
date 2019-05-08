<?php
if(isset($_GET)){
    $conn = mysqli_connect('localhost', 'root', '');
    mysqli_set_charset($conn,'utf8');
    if ($conn) {
        $pno=$_GET['pno'];
        mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
        $sql ="SELECT pname,psize,pamount FROM product WHERE pno=".$pno.";";
        $amount =mysqli_query($conn, $sql);
        if($amount==NULL){
            echo "查无此货";
        }else {
            $row = mysqli_fetch_row($amount);
            if ($row == NULL) {
                echo "查无此货";
            } else {
                echo $row[0] . " | " . $row[1];
                if ($row[2] == "0") {
                    echo "(暂时无货!)";
                }
            }
        }
    }else{
        echo "连接数据库出错";
    }
}else{
    echo"..";
}