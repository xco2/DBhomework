<script>
    var alter=-1;
    var set_input_value=function (ino_v,cno_v,ccmp_v,Ppaid_v) {
        var cno = document.getElementById("cno");
        var ccmp = document.getElementById("ccmp");
        var Ppaid = document.getElementById("Ppaid");
        var divdata = $.ajax({url:"./change/checkcname?cno="+cno_v,async:false});
        $("#cname").html(divdata.responseText);
        cno.value=cno_v;
        ccmp.value=ccmp_v;
        Ppaid.value=Ppaid_v;
        alter=ino_v;
        var formhead=document.getElementById("form_head");
        formhead.innerHTML="请输入修改后的发票信息";
    }
</script>
<?php
if(isset($_GET['no'])){
    $conn = mysqli_connect('localhost', 'root', '');
    mysqli_set_charset($conn,'utf8');
    if ($conn) {
        mysqli_select_db($conn, 'production_marketing') or die('指定的数据库不存在');
        $sql = "SELECT * FROM invoice WHERE ino=".$_GET['no'].";";
        $amount = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($amount);
        echo "<script>set_input_value(".$row[0].",\"".$row[1]."\",\"".$row[4]."\",\"".$row[5]."\");</script>";
    }
}
?>
<div id="form_ofc">
    <form action="" method="post" onsubmit="return false">
        <div class="input-div" id="form_head" style="font-size: 25px;margin-top:0px;">请输入发票信息</div>
        <table>
            <tr class="input-div">
                <td class="t-letf"><label for="cno">客户号:</label></td>
                <td><input type="text" name="cno" id="cno" placeholder="请输入客户号"></td>
            </tr>
            <tr class="input-div">
                <td class="t-letf"><label for="cname">客户姓名:</label></td>
                <td><div id="cname">..</div></td>
            </tr>
            <tr class="input-div">
                <td class="t-letf"><label for="ccmp">预付款(元):</label></td>
                <td><input type="text" name="ccmp" id="ccmp" placeholder="请输入预付款"></td>
            </tr>
            <tr class="input-div">
                <td class="t-letf"><label for="Ppaid">已付金额(元):</label></td>
                <td><input type="text" name="Ppaid" id="Ppaid" placeholder="请输入已付金额,若未完成交易,请输入0"></td>
            </tr>
        </table>
        <button onclick="submitpro()">提交</button>
    </form>
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
        text-align: right;
        width: 6.2em;
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
    $('#cno').bind('input propertychange', function() {
        if(this.value){
            var divdata = $.ajax({url:"./change/checkcname?cno="+this.value,async:false});
            $("#cname").html(divdata.responseText);
        }else{
            $("#cname").html("..");
        }
    });
    //输入订单完成后跳转
    var goto_detailed_invoice=function () {
        $("#invoice").css("background-color","#97ddff");
        var divdata = $.ajax({url:"./change/detailed_invoice.php",async:false});
        $("#r-form").html(divdata.responseText);
    }
    var submitpro=function () {
        var cno = document.getElementById("cno");
        var cname = document.getElementById("cname");
        var ccmp = document.getElementById("ccmp");
        var Ppaid = document.getElementById("Ppaid");
        var get_div = document.getElementById("get_div");
        var allright=0;
        if (!cno.value) {
            get_div.innerHTML="*请将客户号填写完整";
            cno.style.borderColor="#ff536f";
        }else{
            allright++;
            cno.style.borderColor="black";
        }
        if (cname.innerText == "查无此人" || cname.innerText == "..") {
            cname.style.color="#ff536f";
        }else{
            allright++;
            cname.style.color="black";
        }
        if (!ccmp.value) {
            get_div.innerHTML="*请将预付款填写完整";
            ccmp.style.borderColor="#ff536f";
        }else{
            allright++;
            ccmp.style.borderColor="black";
        }
        if (!Ppaid.value) {
            get_div.innerHTML="*请将已付金额填写完整,若未完成交易,请输入0";
            Ppaid.style.borderColor="#ff536f";
        }else{
            allright++;
            Ppaid.style.borderColor="black";
        }
        if(allright==4){
            var theurl;
            if(alter!=-1){
                theurl='./change/addinvo_toDB.php?ino='+alter;
            }else{
                theurl='./change/addinvo_toDB.php';
            }
            $.ajax({
                url: theurl,
                type: 'post',
                timeout: 180000,
                data: "cno="+cno.value+"&ccmp="+ccmp.value+"&ppaid="+Ppaid.value,
                success: function (data) {
                    alert(data);
                    get_div.innerHTML=data;
                    goto_detailed_invoice();//输入订单完成后跳转
                },
                error: function (res, error) {
                    alert('发生错误');
                }
            });
        }
    }
</script>