<?php
if(isset($_POST)){
    $conn = mysqli_connect('b-xal0jvolhi6yzd.bch.rds.gz.baidubce.com:3306', 'b_xal0jvolhi6yzd', 'MY!!ZOMBIELANDSAGA!SQL#');
    mysqli_set_charset($conn,'utf8');
    if ($conn) {
        mysqli_select_db($conn, 'b_xal0jvolhi6yzd') or die('指定的数据库不存在');
        $pname=$_POST['pname'];
        $psize=$_POST['psize'];
        $pprice=$_POST['pprice'];
        $pamount=$_POST['pamount'];
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