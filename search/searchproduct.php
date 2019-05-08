<div id="form_ofc_s">
    <form action="" method="post" onsubmit="return false">
        <div class="input-div" id="form_head" style="font-size: 25px;margin-top:0px;">搜索筛选</div><br>
        <div class="input-div">
            <label for="pname">产品名:</label>
            <input type="text" name="pname" id="pname_s" placeholder="请输入产品名">
        </div>
        <?php if (!isset($_GET['alter'])) { ?>
            <div class="input-div">
                <label for="psize">规格:</label>
                <input type="text" name="psize" id="psize" placeholder="请输入规格">
            </div>
            <div class="input-div">
                <label for="pprice_max">价格范围:</label><br>
                <input type="text" name="pprice" id="pprice_min" placeholder="请输入价格下界">
                <input type="text" name="pprice" id="pprice_max" placeholder="请输入价格上界">
            </div>
            <div class="input-div">
                <label for="pamount_max">存货范围:</label><br>
                <input type="text" name="pamount" id="pamount_min" placeholder="请输入存货下界">
                <input type="text" name="pamount" id="pamount_max" placeholder="请输入存货上界">
            </div>
        <?php } ?>
        <button onclick="submitcust()">提&nbsp交</button>
    </form>
</div>
<div id="request_div">

</div>
<style>
    #form_ofc_s {
        margin: auto;
        margin-top: 10px;
        margin-bottom: 25px;
        padding: 10px;
        height: auto;
        width: 80%;
        border: 3px solid #d3d3d3;
        border-radius: 15px;
        box-shadow: 20px 13px 20px 0px rgba(136, 136, 136, 0.51);
    }
    #request_div {
        height: auto;
        width: 100%;
    }

    #form_ofc_s form {
        height: auto;
    }

    #form_head {
        width: 100%;
        margin: 0;
        display: block;
    }

    #form_ofc_s .input-div {
        width: 45%;
        height: auto;
        margin-bottom: 20px;
        display: inline-block;
    }

    #form_ofc_s label {
        vertical-align: top;
    }

    #form_ofc_s input {
        width: 70%;
        height: 1.6em;
        border: 1.5px solid #000000;
        vertical-align: middle;
    }

    #form_ofc_s input:focus, #form_ofc_s select:focus {
        outline-color: black;
    }

    #form_ofc_s select {
        width: 40%;
        height: 1.6em;
        border: 1.5px solid #000000;
        vertical-align: middle;
    }

    #form_ofc_s button {
        width: 100%;
        height: 35px;
        color: white;
        border: 1px solid #bebebe;
        background-color: #bebebe;
        border-radius: 15px;
        position: relative;
        font-size: 1em;
        bottom: 0px;
    }
</style>
<script>
    var submitcust = function () {
        var pname = document.getElementById("pname_s");
        <?php if(!isset($_GET['alter'])){?>
        var psize = document.getElementById("psize");
        var pprice_max = document.getElementById("pprice_max");
        var pprice_min = document.getElementById("pprice_min");
        var pamount_max = document.getElementById("pamount_max");
        var pamount_min = document.getElementById("pamount_min");
        var request_div = document.getElementById("request_div");
        pprice_max.style.borderColor = "black";
        pprice_min.style.borderColor = "black";
        pamount_max.style.borderColor = "black";
        pamount_min.style.borderColor = "black";
        <?php }?>
        var checkmax_min = 1;
        var datas = "unuse=0";
        if (pname.value) {
            datas = datas + "&pname=" + pname.value;
        }
        <?php if(!isset($_GET['alter'])){?>//暂时不需要
        if (psize.value) {
            datas = datas + "&psize=" + psize.value;
        }
        if (pprice_min.value && pprice_max.value && (parseInt(pprice_max.value) < parseInt(pprice_min.value))) {
            pprice_max.style.borderColor = "#ff536f";
            pprice_min.style.borderColor = "#ff536f";
            get_div.innerHTML = "*请保证最大值大于等于最小值";
            checkmax_min = 0;
        }
        if (pprice_max.value) {
            if (parseInt(pprice_max.value) < 0) {
                pprice_max.style.borderColor = "#ff536f";
                get_div.innerHTML = "*请保证金额大于0";
                checkmax_min = 0;
            } else {
                datas = datas + "&pprice_max=" + pprice_max.value;
            }
        }
        if (pprice_min.value) {
            if (parseInt(pprice_min.value) < 0) {
                pprice_min.style.borderColor = "#ff536f";
                get_div.innerHTML = "*请保证金额大于0";
                checkmax_min = 0;
            } else {
                datas = datas + "&pprice_min=" + pprice_min.value;
            }
        }

        if (pamount_max.value && pamount_min.value && (parseInt(pamount_max.value) < parseInt(pamount_min.value))) {
            pamount_max.style.borderColor = "#ff536f";
            pamount_min.style.borderColor = "#ff536f";
            get_div.innerHTML = "*请保证最大值大于等于最小值";
            checkmax_min = 0;
        }
        if (pamount_max.value) {
            if (parseInt(pamount_max.value) < 0) {
                pamount_max.style.borderColor = "#ff536f";
                get_div.innerHTML = "*请保证金额大于0";
                checkmax_min = 0;
            } else {
                datas = datas + "&pamount_max=" + pamount_max.value;
            }
        }
        if (pamount_min.value) {
            if (parseInt(pamount_min.value) < 0) {
                pamount_min.style.borderColor = "#ff536f";
                get_div.innerHTML = "*请保证金额大于0";
                checkmax_min = 0;
            } else {
                datas = datas + "&pamount_min=" + pamount_min.value;
            }
        }
        <?php }?>
        <?php if(isset($_GET['alter'])){?>//需要
        datas = datas + "&alter=0";
        <?php }?>
        if (checkmax_min) {
            $.ajax({
                url: "search/searchprod_formDB.php",
                type: 'post',
                timeout: 180000,
                data: datas,
                success: function (data) {
                    request_div.innerHTML = data;
                },
                error: function (res, error) {
                    alert('发生错误');
                }
            });
        }
    }
</script>