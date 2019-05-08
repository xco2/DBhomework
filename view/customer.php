<?php
$conn = mysqli_connect('localhost', 'root', '');
mysqli_set_charset($conn,'utf8');
if ($conn) {
    mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
    $sql="SELECT * FROM Customer ORDER BY cno";

    $amount =mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($amount);
    ?>

    <table id="nomal">
        <thead class="dan">
            <td class="num">客户号</td>
            <td>姓名</td>
            <td>地址</td>
            <td>电话</td>
            <td>信用状况
                <div class="alter_bot">
                    <div onclick="change_right_mian('customer_view')">总交易额排行</div>
                    <a href="search.php?choic=customer">筛选</a>
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
                <td><?php echo $row[4]?>
                    <div class="alter_bot">
                        <a <?php echo "href=\"./add.php?choic=customer&no=".$row[0]."\""?>>修改</a>
                        <a <?php echo "href=\"./add.php?choic=invoice&withcust=1&no=".$row[0]."\""?>>&nbsp开发票</a>
                    </div>
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
        /*display: none;*/
        float: right;
        border-radius: 3px;
    }
    .alter_bot div{
        display: inline-block;
        color: #549ac8;
        cursor:pointer;
        margin-right:7px;
    }
</style>
<script>
    var str="共 ";
    document.getElementById("number").innerText=str+<?php echo $i-1?>+" 位";
</script>