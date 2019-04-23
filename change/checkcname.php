<?php
if(isset($_GET)){
    $conn = mysqli_connect('b-xal0jvolhi6yzd.bch.rds.gz.baidubce.com:3306', 'b_xal0jvolhi6yzd', 'MY!!ZOMBIELANDSAGA!SQL#');
    mysqli_set_charset($conn,'utf8');
    if ($conn) {
        mysqli_select_db($conn, 'b_xal0jvolhi6yzd') or die('指定的数据库不存在');
        $cno=$_GET['cno'];
        $sql ="SELECT cname FROM customer WHERE cno=".$cno.";";
        $amount =mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($amount);
        if($row==NULL){
            echo "查无此人";
        }else{
            echo $row[0];
        }
    }else{
        echo "连接数据库出错";
    }
}else{
    echo"..";
}