<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>产品销售</title>
    <script src="js/jquery-3.1.1.js"></script>
    <script src="js/search.js"></script>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/nomal.css">
</head>
<body>
<div id="top-mian">
    <div id="title_name">xxxx系统</div>
</div>
<div id="left-main">
    <div id="invoice" class="fagucan" onclick="change_right_mian('invoice')">发&nbsp票</div>
    <div id="product" class="fagucan" onclick="change_right_mian('product')">产&nbsp品</div>
    <div id="customer" class="fagucan" onclick="change_right_mian('customer')">顾&nbsp客</div>
    <div id="back" class="fagucan"><a href="index.html"><div>返回查看</div></a></div>
    <div id="back" class="fagucan"><a href="add.php?choic=invoice"><div>录入</div></a></div>
</div>
<div id="right-main">
    <div id="r-table"></div>
    <div id="r-bottom">
        <div id="get_div"></div>
        <div id="number"></div>
    </div>
</div>
<script>
    <?php
    if(isset($_GET['choic'])){
        echo "change_right_mian('".$_GET['choic']."');";
    }
    ?>
</script>
</body>
</html>