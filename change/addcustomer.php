<script>
    var alter = -1;
    var set_input_value = function (cno_v, cname_v, ctel_v, caddress_v) {
        var cname = document.getElementById("cname");
        var ctel = document.getElementById("ctel");
        var caddress = document.getElementById("caddress");
        cname.value = cname_v;
        ctel.value = ctel_v;
        caddress.value = caddress_v;
        alter = cno_v;
        var formhead = document.getElementById("form_head");
        formhead.innerHTML = "请输入修改后的顾客信息";
        $('#delete').css("display", "block");
    }
</script>
<?php
if (isset($_GET['no'])) {//修改
    $conn = mysqli_connect('localhost', 'root', '');
    mysqli_set_charset($conn, 'utf8');
    if ($conn) {
        mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
        $sql = "SELECT * FROM Customer WHERE cno=" . $_GET['no'] . ";";
        $amount = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($amount);
        echo "<script>set_input_value(" . $row[0] . ",\"" . $row[1] . "\",\"" . $row[3] . "\",\"" . $row[2] . "\");</script>";
    }
}
?>
<div id="form_ofc">
    <div id="delete" onclick="delete_div()">删除</div>
    <form action="" method="post" onsubmit="return false">
        <div class="input-div" id="form_head" style="font-size: 25px;margin-top:0px;">请输入顾客信息</div>
        <div class="input-div">
            <label for="cname">姓名:</label>
            <input type="text" name="cname" id="cname" placeholder="请输入姓名">
        </div>
        <div class="input-div">
            <label for="ctel">电话:</label>
            <input type="text" name="ctel" id="ctel" placeholder="请输入电话号码" maxlength="11">
        </div>
        <div class="input-div">
            <label for="caddress">地址:</label>
            <textarea name="caddress" id="caddress" cols="30" rows="3" placeholder="请输入地址"></textarea>
        </div>
        <?php if (isset($_GET['no'])) {//修改?>
            <div class="input-div">
                <label for="ccredit">信用状况:</label>
                <select name="ccredit" id="ccredit">
                    <option value="a">a</option>
                    <option value="b">b</option>
                    <option value="c">c</option>
                    <option value="d">d</option>
                    <option value="e">e</option>
                </select>
            </div>
        <?php } ?>
        <button onclick="submitcust()">提&nbsp交</button>
    </form>
</div>
<style>
    #form_ofc {
        margin: auto;
        margin-top: 50px;
        padding: 5%;
        height: auto;
        width: 60%;
        border: 2px solid #d3d3d3;
        border-radius: 15px;
        box-shadow: 20px 13px 20px 0px rgba(136, 136, 136, 0.51);
    }

    form {
        height: auto;
    }

    #delete {
        float: right;
        width: 60px;
        height: 40px;
        line-height: 40px;
        background-color: #ff536f;
        color: white;
        border-radius: 10px;
        text-align: center;
        display: none;
    }

    #delete:hover {
        background-color: red;
    }

    .input-div {
        width: 100%;
        height: auto;
        margin: 20px;
    }

    label {
        vertical-align: top;
    }

    input {
        width: 70%;
        height: 1.6em;
        border: 1.5px solid #000000;
        vertical-align: middle;
    }

    input:focus {
        outline-color: black;
    }

    textarea {
        width: 70%;
        height: 2.6em;
        resize: none;
        border: 1.5px solid #000000;
    }

    textarea:focus {
        outline-color: black;
    }

    button {
        width: 100%;
        height: 45px;
        color: white;
        border: 1px solid #bebebe;
        background-color: #bebebe;
        border-radius: 25px;
        position: relative;
        font-size: 1em;
        bottom: 0px;
    }
</style>
<script>
    var submitcust = function () {
        var cname = document.getElementById("cname");
        var ctel = document.getElementById("ctel");
        var caddress = document.getElementById("caddress");
        <?php if(isset($_GET['no'])){//修改?>
        var ccredit = document.getElementById("ccredit");
        <?php }?>
        var get_div = document.getElementById("get_div");
        var allright = 0;
        var datas = "cname=" + cname.value + "&ctel=" + ctel.value + "&caddress=" + caddress.value;
        if (!cname.value) {
            cname.style.borderColor = "#ff536f";
            get_div.innerHTML = "*请将姓名填写完整";
        } else {
            cname.style.borderColor = "black";
            allright++;
        }
        if (!ctel.value || ctel.value.length != 11 || ("" + parseInt(ctel.value)).length != 11) {
            ctel.style.borderColor = "#ff536f";
            get_div.innerHTML = "*请将电话填写完整";
        } else {
            ctel.style.borderColor = "black";
            allright++;
        }
        if (!caddress.value) {
            caddress.style.borderColor = "#ff536f";
            get_div.innerHTML = "*请将地址填写完整";
        } else {
            caddress.style.borderColor = "black";
            allright++;
        }
        <?php if(isset($_GET['no'])){//修改?>
        datas = datas + "&ccredit=" + ccredit.value;
        <?php }?>
        if (allright == 3) {
            var theurl;
            if (alter != -1) {
                theurl = './change/addcust_toDB.php?cno=' + alter;
            } else {
                theurl = './change/addcust_toDB.php';
            }
            $.ajax({
                url: theurl,
                type: 'post',
                timeout: 180000,
                data: datas,
                success: function (data) {
                    alert(data);
                    get_div.innerHTML = data;
                    cname.value = "";
                    ctel.value = "";
                    caddress.value = "";
                },
                error: function (res, error) {
                    alert('发生错误');
                }
            });
        }
    }

    var delete_div = function () {
        var divdata = $.ajax({url: "change/delete_formDB.php?choic=customer&no=" + alter, async: false});
        alert(divdata.responseText);
        location.href = "index.html";
    }
</script>
