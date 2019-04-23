<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>添加</title>
    <script src="js/jquery-3.1.1.js"></script>
    <script src="js/add.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/nomal.css">
</head>
<body>
<div id="top-mian">
    <div id="title_name">xxxx系统</div>
</div>
<div id="left-main">
    <div id="invoice" class="fagucan" onclick="change_right_mian('invoice',-1)">发票</div>
    <div id="product" class="fagucan" onclick="change_right_mian('product',-1)">产品</div>
    <div id="customer" class="fagucan" onclick="change_right_mian('customer',-1)">顾客</div>
    <div id="back" class="fagucan"><a href="./"><div>返回查看</div></a></div>
</div>
<div id="right-main">
    <div id="r-form"></div>
    <div id="r-bottom">
        <div id="get_div"></div>
        <div id="number"></div>
    </div>
</div>
<script>
    <?php
    if(isset($_GET['ino'])){
        echo "set_under('".$_GET['ino']."');";
    }
    if(isset($_GET['choic'])){
        if(isset($_GET['no'])){//跳转修改,no为格表主码
            echo "change_right_mian('".$_GET['choic']."',".$_GET['no'].");";
        }else{//普通插入
            echo "change_right_mian('".$_GET['choic']."',-1);";
        }
    }

    ?>
</script>
</body>
</html>