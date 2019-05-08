<?php
$conn = mysqli_connect('localhost', 'root', '');
mysqli_set_charset($conn,'utf8');
if ($conn) {
    mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
    $sql = "SELECT * FROM product WHERE 1";
    $order="pno";
    if(isset($_POST['pname'])){
        $sql=$sql." AND pname LIKE \"%".$_POST['pname']."%\"";
        $order="pname";
    }
    if(isset($_POST['psize'])){
        $sql=$sql." AND psize LIKE \"%".$_POST['psize']."%\"";
        $order="psize";
    }
    if(isset($_POST['pprice_max'])){
        $sql=$sql." AND pprice<=".$_POST['pprice_max']."";
        $order="pprice";
    }
    if(isset($_POST['pprice_min'])){
        $sql=$sql." AND pprice>=".$_POST['pprice_min']."";
        $order="pprice";
    }
    if(isset($_POST['pamount_max'])){
        $sql=$sql." AND pamount<=".$_POST['pamount_max']."";
        $order="pamount";
    }
    if(isset($_POST['pamount_min'])){
        $sql=$sql." AND pamount>=".$_POST['pamount_min']."";
        $order="pamount";
    }
    $sql=$sql." ORDER BY ".$order.";";
    //echo  $sql;
    $amount =mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($amount);
?>
<table id="tablehead">
    <thead class="dan">
    <td class="num">产品号</td>
    <td>产品名称</td>
    <td>规格</td>
    <td>单价(元)</td>
    <td>库存数量</td>
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
            <td><?php echo $row[4];
                if(!isset($_POST['alter'])){//发票详细,不输出修改按钮?>
                    <div class="alter_bot">
                        <a <?php echo "href=\"./add.php?choic=product&no=".$row[0]."\""?>>修改</a>
                    </div>
                    <?php
                }
                ?>
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
    #tablehead{
        border-collapse: collapse;
    }
    #tablehead td{
        height: 2em;
        width: 20em;
        border:1px solid #d3d3d3;
    }
    #tablehead .num{
        width: 4em;
    }
    #tablehead tr{
        height: 2em;
        width: auto;
    }
    #tablehead tr:hover{
        background-color: #bebebe !important;
    }
    #tablehead thead{
        background-color: #bebebe !important;
    }
    #tablehead .dan{
        background-color: #e0e0e0;
    }
    #tablehead table{
        border-collapse:collapse;
        text-align: left;
    }
    #tablehead .alter_bot{
        /*display: none;*/
        float: right;
        border-radius: 3px;
    }
</style>
<script>
    var str="共 ";
    document.getElementById("number").innerText=str+<?php echo $i-1?>+" 项";
</script>