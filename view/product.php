<?php
$conn = mysqli_connect('localhost', 'root', '');
mysqli_set_charset($conn,'utf8');
if ($conn) {
    mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
    $sql="SELECT * FROM Product;";

    $amount =mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($amount);
    ?>
    <table id="tablehead">
        <thead class="dan">
            <td class="num">产品号</td>
            <td>产品名称</td>
            <td>规格</td>
            <td>单价(元)</td>
            <td>库存数量
                <div class="alter_bot">
                    <a href="../add.php?choic=product">增添
<!--                     <!--<img src="" alt="">-->
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
                <td><?php echo $row[4]?><div class="alter_bot"><a <?php echo "href=\"./add.php?choic=product&no=".$row[0]."\""?>>修改</a></div></td>
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
    }
    .num{
        width: 4em;
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
    }
</style>
<script>
    var str="共 ";
    document.getElementById("number").innerText=str+<?php echo $i-1?>+" 项";
</script>