<?php
if(isset($_POST)){
    $conn = mysqli_connect('localhost', 'root', '');
    mysqli_set_charset($conn,'utf8');
    if ($conn) {
        $ino=$_POST['ino'];
        $pno=$_POST['pno'];
        $pay_amount=$_POST['pay_amount'];
        mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');

        $sql_1="SELECT Pno FROM invoice_product WHERE Pno=".$pno." AND Ino=".$ino.";";
        $sql ="INSERT INTO invoice_product(Ino,Pno,Pay_amount) VALUES (".$ino.",".$pno.",".$pay_amount.");";
        $amount =mysqli_query($conn, $sql_1)or die('指定的数据不存在');
        $row = mysqli_fetch_row($amount);
        if($row!=null){//此商品已存在于该订单
            $sql="UPDATE invoice_product SET Pay_amount=Pay_amount+".$pay_amount." WHERE Pno=".$pno." AND Ino=".$ino.";";
        }
        if(mysqli_query($conn, $sql)){
            $sql="SELECT pprice FROM product WHERE Pno=".$pno.";";
            $amount =mysqli_query($conn, $sql)or die('指定的数据不存在');
            $row = mysqli_fetch_row($amount);
            $this_payment=(int)$row[0]*(int)$pay_amount;
            $sql="UPDATE invoice,product SET Payment=Payment+".$this_payment.",Pamount=Pamount-".$pay_amount." WHERE Ino=".$ino.";";//修改订单的总金额
            if(mysqli_query($conn, $sql)){
                echo "录入成功";
            }else{
                echo "录入失败1";
            }
        }else{
            echo "录入失败";
        }
    }else{
        echo "连接数据库出错";
    }
}else{
    echo "请填写信息";
}
