<?php
$conn = mysqli_connect('localhost', 'root', '');
mysqli_set_charset($conn,'utf8');
if ($conn) {
    mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
    $sql="SELECT invoice_product.Pno,Pname,Pay_amount,iprice FROM invoice_product,product WHERE invoice_product.Pno=product.Pno AND invoice_product.Ino=".$_GET['ino'].";";
    $amount =mysqli_query($conn, $sql)or die('指定的数据不存在');
    $row = mysqli_fetch_row($amount);
?>

<table id="tablehead">
    <thead class="dan">
    <td class="num">序号</td>
    <td>产品号</td>
    <td>产品名称</td>
    <td>购买数量</td>
    <td>单价</td>
    <td>小计</td>
    </thead>
    <?php
    $i=1;
        while($row != null){
            ?>
            <tr <?php if($i%2==0){echo "class=\"dan\"";}?>>
                <td class="num"><?php echo $i?></td>
                <td><?php echo $row[0]?></td>
                <td><?php echo $row[1]?></td>
                <td><?php echo $row[2]?></td>
                <td><?php echo $row[3]?></td>
                <td><?php echo $row[3]*$row[2]?></td>
            </tr>
            <?php
            $row = mysqli_fetch_row($amount);
            $i++;
        }
    $sql="SELECT Ino,invoice.Cno,customer.Cname,Itime,Payment,Ccpm,Ppaid FROM invoice,customer WHERE invoice.Cno=customer.Cno AND invoice.ino=".$_GET['ino'].";";
    $amount =mysqli_query($conn, $sql)or die('指定的数据不存在');
    $row = mysqli_fetch_row($amount);
        ?>
        <tr></tr>
        <tr><td>发票信息</td></tr>
        <tr class="dan">
            <td class="num">客户号</td>
            <td>客户姓名</td>
            <td>开发日期</td>
            <td>应付金额</td>
            <td>预付款</td>
            <td>已付金额</td>
        </tr>
    <tr>
        <td class="num"><?php echo $row[1]?></td>
        <td><?php echo $row[2]?></td>
        <td><?php echo $row[3]?></td>
        <td><?php echo $row[4]?></td>
        <td><?php echo $row[5]?></td>
        <td><?php echo $row[6]?></td>
    </tr>
    <?php
    }//if的结束
    ?>
</table>
<style>
    td{
        height: 2em;
        width: 20em;
        border:1px solid #d3d3d3;
        padding: 0;
    }
    .num{
        width: 5em;
    }
    tr{
        height: 2em;
        width: auto;
    }
    tr:hover{
        background-color: #bebebe !important;
    }
    thead{
        background-color: #bebebe !important;
    }
    .dan{
        background-color: #e0e0e0;
    }
    table{
        border-collapse:collapse;
        text-align: left;
    }
</style>
<script>
    var str="共 ";
    document.getElementById("number").innerText=str+<?php echo $i-1?>+" 项";
</script>