<?php
if(isset($_POST)){
    $conn = mysqli_connect('localhost', 'root', '');
    mysqli_set_charset($conn,'utf8');
    if ($conn) {
        $cname=$_POST['cname'];
        $ctel=$_POST['ctel'];
        $caddress=$_POST['caddress'];
        mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
        if(isset($_GET['cno'])){//修改
            if(isset($_POST['ccredit'])){
                $sql="UPDATE customer SET Cname=\"".$cname."\",Caddress=\"".$caddress."\",Ctel=\"".$ctel."\",Ccredit=\"".$_POST['ccredit']."\" WHERE cno=".$_GET['cno'].";";
            }else{
                $sql="UPDATE customer SET Cname=\"".$cname."\",Caddress=\"".$caddress."\",Ctel=\"".$ctel."\" WHERE cno=".$_GET['cno'].";";
            }
            $success="修改成功";
            $f="修改失败";
        }else{//增添
            $sql ="INSERT INTO customer(Cname,Caddress,Ctel,Ccredit) VALUES(\"".$cname."\",\"".$caddress."\",\"".$ctel."\",'a');";
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
