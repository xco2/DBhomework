<script>
    var alter = -1;
    var set_input_value = function (pno_v, pname_v, psize_v, pprice_v, pamount_v) {
        var pname = document.getElementById("pname");
        var psize = document.getElementById("psize");
        var pprice = document.getElementById("pprice");
        var pamount = document.getElementById("pamount");
        pname.value = pname_v;
        psize.value = psize_v;
        pprice.value = pprice_v;
        pamount.value = pamount_v;
        alter = pno_v;
        var formhead = document.getElementById("form_head");
        formhead.innerHTML = "请输入修改后的产品信息";
        $('#delete').css("display", "block");
    }
</script>
<?php
if (isset($_GET['no'])) {
    $conn = mysqli_connect('localhost', 'root', '');
    mysqli_set_charset($conn, 'utf8');
    if ($conn) {
        mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
        $sql = "SELECT * FROM Product WHERE pno=" . $_GET['no'] . ";";
        $amount = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($amount);
        echo "<script>set_input_value(" . $row[0] . ",\"" . $row[1] . "\",\"" . $row[2] . "\",\"" . $row[3] . "\",\"" . $row[4] . "\");</script>";
    }
}
?>
<div id="form_ofc">
    <div id="delete" onclick="delete_div()">删除</div>
    <form action="" method="post" onsubmit="return false">
        <div class="input-div" id="form_head" style="font-size: 25px;margin-top:0px;">请输入产品信息</div>
        <table>
            <tr class="input-div">
                <td class="t-letf"><label for="pname">产品名:</label></td>
                <td><input type="text" name="pname" id="pname" placeholder="请输入产品名"></td>
            </tr>
            <tr class="input-div">
                <td class="t-letf"><label for="psize">产品规格:</label></td>
                <td><input type="text" name="psize" id="psize" placeholder="请输入产品规格"></td>
            </tr>
            <tr class="input-div">
                <td class="t-letf"><label for="pprice">单价(元):</label></td>
                <td><input type="text" name="pprice" id="pprice" placeholder="请输入产品单价"></td>
            </tr>
            <tr class="input-div">
                <td class="t-letf"><label for="pamount">产品存货:</label></td>
                <td><input type="text" name="pamount" id="pamount" placeholder="请输入产品存货"></td>
            </tr>
        </table>
        <button onclick="submitpro()">提&nbsp交</button>
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

    table {
        width: 100%;
        margin-bottom: 20px;
    }

    .t-letf {
        text-align: right;
        width: 5.2em;
    }

    label {
        vertical-align: top;
    }

    input {
        width: 100%;
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
        font-size: 1em;
        border-radius: 25px;
        position: relative;
        bottom: 0px;
    }
</style>
<script>
    var submitpro = function () {
        var pname = document.getElementById("pname");
        var psize = document.getElementById("psize");
        var pprice = document.getElementById("pprice");
        var pamount = document.getElementById("pamount");
        var get_div = document.getElementById("get_div");
        var allright = 0;
        if (!pname.value) {
            get_div.innerHTML = "*请将产品名填写完整";
            pname.style.borderColor = "#ff536f";
        } else {
            allright++;
            pname.style.borderColor = "black";
        }
        if (!psize.value) {
            get_div.innerHTML = "*请将产品规格填写完整";
            psize.style.borderColor = "#ff536f";
        } else {
            allright++;
            psize.style.borderColor = "black";
        }
        if (!pprice.value || parseInt(pprice.value) < 0) {
            get_div.innerHTML = "*请将产品价格填写完整";
            pprice.style.borderColor = "#ff536f";
        } else {
            allright++;
            pprice.style.borderColor = "black";
        }
        if (!pamount.value || parseInt(pamount.value) < 0) {
            get_div.innerHTML = "*请将存库量填写完整";
            pamount.style.borderColor = "#ff536f";
        } else {
            allright++;
            pamount.style.borderColor = "black";
        }
        if (allright == 4) {
            var theurl;
            if (alter != -1) {
                theurl = './change/addprod_toDB.php?pno=' + alter;
            } else {
                theurl = './change/addprod_toDB.php';
            }
            $.ajax({
                url: theurl,
                type: 'post',
                timeout: 180000,
                data: "pname=" + pname.value + "&psize=" + psize.value + "&pprice=" + pprice.value + "&pamount=" + parseInt(pamount.value),
                success: function (data) {
                    alert(data);
                    get_div.innerHTML = data;
                    pname.value = "";
                    psize.value = "";
                    pprice.value = "";
                    pamount.value = "";
                },
                error: function (res, error) {
                    alert('发生错误');
                }
            });
        }
    }

    var delete_div = function () {
        var divdata = $.ajax({url: "./change/delete_formDB.php?choic=product&no=" + alter, async: false});
        alert(divdata.responseText);
        location.href = "index.html";
    }
</script>