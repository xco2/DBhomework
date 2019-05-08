<?php
if(isset($_POST)){
    $conn = mysqli_connect('localhost', 'root', '');
    mysqli_set_charset($conn,'utf8');
    if ($conn) {
        $ino=$_POST['ino'];
        $pno=$_POST['pno'];
        $pay_amount=$_POST['pay_amount'];
        mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
        $get_price_sql="SELECT pprice FROM product WHERE Pno=".$pno.";";//搜索当时价格
        $amount =mysqli_query($conn, $get_price_sql)or die('指定的数据不存在');
        $row = mysqli_fetch_row($amount);
        $pprice=$row[0];
        $sql ="INSERT INTO invoice_product(Ino,Pno,Pay_amount,iprice) VALUES (".$ino.",".$pno.",".$pay_amount.",".$pprice.");";//新加一条购买信息
        $check_re_sql="SELECT * FROM invoice_product WHERE Pno=".$pno." AND Ino=".$ino." AND iprice=".$pprice.";";//搜索是否重复
        $amount =mysqli_query($conn, $check_re_sql)or die('指定的数据不存在');
        $row = mysqli_fetch_row($amount);
        if($row!=null){//此商品已存在于该订单,且单价没变
            $sql="UPDATE invoice_product SET Pay_amount=Pay_amount+".$pay_amount." WHERE Pno=".$pno." AND Ino=".$ino." AND iprice=".$pprice.";";
        }
        $this_payment=(float)$pprice*(int)$pay_amount;//单价×数量
        $changepayment_sql="UPDATE invoice SET Payment=Payment+".$this_payment." WHERE Ino=".$ino.";";//修改订单的总金额
        $changepamount_sql="UPDATE product SET Pamount=Pamount-".$pay_amount." WHERE Pno=".$pno.";";//修改货存
        if(mysqli_query($conn, $changepamount_sql)){//修改存货
            if(mysqli_query($conn, $sql)&&mysqli_query($conn, $changepayment_sql)){//修改中金额与发票信息
                echo "录入成功";
            }else{
                echo "录入失败";
            }
        }else{
            echo "货存不足";
        }
    }else{
        echo "连接数据库出错";
    }
}else{
    echo "请填写信息";
}
