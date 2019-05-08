<?php
$conn = mysqli_connect('localhost', 'root', '');
mysqli_set_charset($conn,'utf8');
if ($conn) {
mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
$sql="SELECT * FROM Product_view ORDER BY sumamount DESC;";

$amount =mysqli_query($conn, $sql);
$row = mysqli_fetch_row($amount);
?>
<table id="tablehead">
    <thead class="dan">
    <td class="num">产品号</td>
    <td>产品名称</td>
    <td>规格</td>
    <td>单价(元)</td>
    <td>销量
        <div class="alter_bot" onclick="change_right_mian('product')">返回全部</div>
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
            <td><?php echo $row[4];?></td>
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
    <?php if(!isset($_GET['alter'])){?>
    var str="共 ";
    document.getElementById("number").innerText=str+<?php echo $i-1?>+" 项";
    <?php }?>
</script>