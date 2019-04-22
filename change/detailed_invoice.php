<div id="form_ofc">
    <form action="" method="post" onsubmit="return false">
        <div class="input-div" style="font-size: 25px;margin-top:0px;">请输入发票详细信息</div>
        <table>
            <tr class="input-div">
                <td class="t-letf"><label for="pno">产品号:</label></td>
                <td><input type="text" name="pno" id="pno" placeholder="请输入产品号"></td>
            </tr>
            <tr class="input-div">
                <td class="t-letf"><label for="pname">产品名:</label></td>
                <td><div id="pname">..</div></td>
            </tr>
            <tr class="input-div">
                <td class="t-letf"><label for="pay_amount">购买数量:</label></td>
                <td><input type="text" name="pay_amount" id="pay_amount" placeholder="请输入购买数量"></td>
            </tr>
        </table>
        <button onclick="submitpro()">提交</button>
    </form>
</div>
<div id="look_det">

</div>
<style>
    #form_ofc{
        margin:auto;
        margin-top: 50px;
        padding: 5%;
        height: auto;
        width: 60%;
        border:3px solid #c7e9ff;
        border-radius: 15px;
    }
    #look_det{
        height: auto;
        width: 100%;
    }
    form{
        height: auto;
    }
    .input-div{
        width: 100%;
        height: auto;
        margin:20px;
    }
    table{
        width: 100%;
        margin-bottom: 20px;
    }
    .t-letf{
        width: 5.2em;
    }
    label{
        vertical-align: top;
    }
    input{
        width: 100%;
        height: 1.6em;
        border:1.5px solid #000000;
        vertical-align: middle;
    }
    input:focus{
        outline-color: black;
    }
    textarea{
        width: 70%;
        height: 2.6em;
        resize: none;
        border:1.5px solid #000000;
    }
    textarea:focus{
        outline-color: black;
    }
    button{
        width: 100%;
        height: 45px;
        color: white;
        border:1px solid #89f3ff;
        background-color: #89f3ff;
        border-radius: 25px;
        position: relative;
        bottom:0px;
    }
</style>
<script>
    var data=document.getElementById("get_div").innerHTML;
    var data_arr=data.split(",");
    var ino=data_arr[1].split(":");//把ino切出来
    var divdata = $.ajax({url:"./view/v_det_invoice?ino="+ino[1],async:false});
    $("#look_det").html(divdata.responseText);

    $('#pno').bind('input propertychange', function() {
        if(this.value){
            var divdata = $.ajax({url:"./change/checkproduct?pno="+this.value,async:false});
            $("#pname").html(divdata.responseText);
        }else{
            $("#pname").html("..");
        }
    });
    var submitpro=function () {
        var pno = document.getElementById("pno");
        var pname = document.getElementById("pname");
        var pay_amount = document.getElementById("pay_amount");
        var get_div = document.getElementById("get_div");
        var data=document.getElementById("get_div").innerHTML;
        var data_arr=data.split(",");
        var ino=data_arr[1].split(":");//把ino切出来
        var allright=0;
        if (!pno.value) {
            get_div.innerHTML="*请将客户号填写完整";
            pno.style.borderColor="#ff536f";
        }else{
            allright++;
            pno.style.borderColor="black";
        }
        if (pname.innerText == "查无此货" || pname.innerText == "..") {
            pname.style.color="#ff536f";
        }else{
            allright++;
            pname.style.color="black";
        }
        if (!pay_amount.value) {
            get_div.innerHTML="*请将预付款填写完整";
            pay_amount.style.borderColor="#ff536f";
        }else{
            allright++;
            pay_amount.style.borderColor="black";
        }
        if(allright == 3){
            $.ajax({
                url: './change/add_det_inv_toDB.php',
                type: 'post',
                timeout: 180000,
                data: "ino="+ino[1]+"&pno="+pno.value+"&pay_amount="+pay_amount.value,
                success: function (dataout) {
                    alert(dataout);
                    get_div.innerHTML=data;
                    var divdata = $.ajax({url:"./view/v_det_invoice?ino="+ino[1],async:false});
                    $("#look_det").html(divdata.responseText);
                },
                error: function (res, error) {
                    alert('发生错误');
                }
            });
        }
    }
</script>