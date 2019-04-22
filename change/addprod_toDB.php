<?php
if(isset($_POST)){
    $conn = mysqli_connect('localhost', 'root', '');
    mysqli_set_charset($conn,'utf8');
    if ($conn) {
        $pname=$_POST['pname'];
        $psize=$_POST['psize'];
        $pprice=$_POST['pprice'];
        $pamount=$_POST['pamount'];
        mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
        if(isset($_GET['pno'])){//修改
            $sql="UPDATE product SET Pname=\"".$pname."\",Psize=\"".$psize."\",Pprice=".$pprice.",Pamount=".$pamount." WHERE pno=".$_GET['pno'].";";
            $success="修改成功";
            $f="修改失败";
        }else {//增添
            $sql = "INSERT INTO product(Pname,Psize,Pprice,Pamount) VALUES(\"" . $pname . "\",\"" . $psize . "\"," . $pprice . "," . $pamount . ");";
            $success="录入成功";
            $f="修改失败";
        }
        if(mysqli_query($conn, $sql)){
            echo $success;
        }else{
            echo $f;
        }
    }else{
        echo "连接数据库出错";
    }
}else{
    echo "请填写信息";
}