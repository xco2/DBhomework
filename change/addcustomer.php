<script>
    var alter=-1;
    var set_input_value=function (cno_v,cname_v,ctel_v,caddress_v) {
        var cname = document.getElementById("cname");
        var ctel = document.getElementById("ctel");
        var caddress = document.getElementById("caddress");
        cname.value=cname_v;
        ctel.value=ctel_v;
        caddress.value=caddress_v;
        alter=cno_v;
        var formhead=document.getElementById("form_head");
        formhead.innerHTML="请输入修改后的顾客信息";
    }
</script>
<?php
if(isset($_GET['no'])){
    $conn = mysqli_connect('b-xal0jvolhi6yzd.bch.rds.gz.baidubce.com:3306', 'b_xal0jvolhi6yzd', 'MY!!ZOMBIELANDSAGA!SQL#');
    mysqli_set_charset($conn,'utf8');
    if ($conn) {
        mysqli_select_db($conn, 'b_xal0jvolhi6yzd') or die('指定的数据库不存在');
        $sql = "SELECT * FROM customer WHERE cno=".$_GET['no'].";";
        $amount = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($amount);
        echo "<script>set_input_value(".$row[0].",\"".$row[1]."\",\"".$row[3]."\",\"".$row[2]."\");</script>";
    }
}
?>
<div id="form_ofc">
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
        <button onclick="submitcust()">提交</button>
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
    label{
        vertical-align: top;
    }
    input{
         width: 70%;
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
    var submitcust=function () {
        var cname = document.getElementById("cname");
        var ctel = document.getElementById("ctel");
        var caddress = document.getElementById("caddress");
        var get_div = document.getElementById("get_div");
        var allright=0;
        if (!cname.value) {
            cname.style.borderColor="#ff536f";
            get_div.innerHTML="*请将姓名填写完整";
        }else{
            cname.style.borderColor="black";
            allright++;
        }
        if (!ctel.value || ctel.value.length != 11 || (""+parseInt(ctel.value)).length!=11) {
            ctel.style.borderColor="#ff536f";
            get_div.innerHTML="*请将电话填写完整";
        }else{
            ctel.style.borderColor="black";
            allright++;
        }
        if (!caddress.value) {
            caddress.style.borderColor="#ff536f";
            get_div.innerHTML="*请将地址填写完整";
        }else{
            caddress.style.borderColor="black";
            allright++;
        }
        if(allright==3) {
            var theurl;
            if(alter!=-1){
                theurl='change/addcust_toDB.php?cno='+alter;
            }else{
                theurl='change/addcust_toDB.php';
            }
            $.ajax({
                url: theurl,
                type: 'post',
                timeout: 180000,
                data: "cname="+cname.value+"&ctel="+ctel.value+"&caddress="+caddress.value,
                success: function (data) {
                    alert(data);
                    get_div.innerHTML=data;
                    cname.value="";
                    ctel.value="";
                    caddress.value="";
                },
                error: function (res, error) {
                    alert('发生错误');
                }
            });
        }
    }
</script>
