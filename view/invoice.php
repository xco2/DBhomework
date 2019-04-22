<?php
$conn = mysqli_connect('localhost', 'root', '');
mysqli_set_charset($conn,'utf8');
if ($conn) {
mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
$sql="SELECT Ino,invoice.Cno,customer.Cname,Itime,Payment,Ccpm,Ppaid FROM invoice,customer WHERE invoice.Cno=customer.Cno;";

$amount =mysqli_query($conn, $sql);
$row = mysqli_fetch_row($amount);
?>

<table id="tablehead">
    <thead class="dan">
    <td class="num">订单号</td>
    <td>客户号</td>
    <td>客户姓名</td>
    <td>开发日期</td>
    <td>应付金额</td>
    <td>预付款</td>
    <td>已付金额
        <div class="alter_bot">
            <a href="../add.php?choic=invoice">增添
                <!--<img src="" alt="">-->
            </a>
        </div>
    </td>
    </thead>
    <?php
    $i=1;
    while($row != null){
        ?>

        <tr <?php if($i%2==0){echo "class=\"dan\"";}?>>
            <td class="num"><?php echo $row[0]?></td>
            <td><?php echo $row[1]?></td>
            <td><?php echo $row[2]?></td>
            <td><?php echo $row[3]?></td>
            <td><?php echo $row[4]?></td>
            <td><?php echo $row[5]?></td>
            <td><?php echo $row[6]?>
                <div class="alter_bot"><a <?php echo "href=\"./add.php?choic=invoice&no=".$row[0]."\""?>>修改</a></div>
                <div class="alter_bot"><a <?php echo "href=\"../add.php?choic=detailed_invoice&ino=".$row[0]."\""?>>详细</a></div>
            </td>
        </tr>
        <?php
        $row = mysqli_fetch_row($amount);
        $i++;
    }
    }
    ?>
</table>
<style>
    td{
        height: 2em;
        width: 20em;
        border:1px solid #c7e9ff;
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
        background-color: #97ddff !important;
    }
    thead{
        background-color: #97ddff !important;
    }
    .dan{
        background-color: #def3ff;
    }
    table{
        border-collapse:collapse;
        text-align: left;
    }
    .alter_bot{
        /*display: none;*/
        float: right;
        border-radius: 3px;
        width: 2.3em;
        text-align: center;
    }
</style>
<script>
    var str="共 ";
    document.getElementById("number").innerText=str+<?php echo $i-1?>+" 份";
</script>