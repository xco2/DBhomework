<?php
$conn = mysqli_connect('localhost', 'root', '');
mysqli_set_charset($conn,'utf8');
if ($conn) {
mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
$sql="SELECT * FROM Customer_view ORDER BY sumpaid DESC";

$amount =mysqli_query($conn, $sql);
$row = mysqli_fetch_row($amount);
?>

<table id="nomal">
    <thead class="dan">
    <td class="num">客户号</td>
    <td>姓名</td>
    <td>地址</td>
    <td>电话</td>
    <td>信用状况</td>
    <td>总交易金额
        <div class="alter_bot" onclick="change_right_mian('customer')">返回全部</div>
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
        border:1px solid #d3d3d3;
        padding: 0;
    }
    .num{
        width: 4em;
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
    .alter_bot{
        color: #549ac8;
        cursor:pointer;
        float: right;
        border-radius: 3px;
    }
</style>
<script>
    var str="共 ";
    document.getElementById("number").innerText=str+<?php echo $i-1?>+" 位";
</script>