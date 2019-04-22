<?php
if(isset($_POST)){
    $conn = mysqli_connect('localhost', 'root', '');
    mysqli_set_charset($conn,'utf8');
    if ($conn) {
        $cno=$_POST['cno'];
        $ccmp=$_POST['ccmp'];
        $ppaid=$_POST['ppaid'];
        mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
        if(isset($_GET['ino'])){//修改
            $sql="UPDATE invoice SET Cno=".$cno.",Itime=now(),Ccpm=".$ccmp.",Ppaid=".$ppaid." WHERE ino=".$_GET['ino'].";";
            $success="修改成功,";
            $f="修改失败";
        }else {//增添
            $sql = "INSERT INTO invoice(Cno,Itime,Payment,Ccpm,Ppaid) VALUES (" . $cno . ",now(), 0 ," . $ccmp . ",".$ppaid.");";
            $success="录入成功,";
            $f="录入失败";
        }
        if(mysqli_query($conn, $sql)){
            $amount=mysqli_query($conn,"select last_insert_id()");
            $row = mysqli_fetch_row($amount);
            echo $success;
            echo "发票号为:".$row[0].",请继续录入详细信息";
        }else{
            echo $f;
        }
    }else{
        echo "连接数据库出错";
    }
}else{
    echo "请填写信息";
}
