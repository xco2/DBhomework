$(document).ready(function () {
    var s_height=document.documentElement.clientHeight;
    $("body").css("height",s_height+"px");
    $("#top-mian").css("height",s_height*0.05+"px");
    $("#left-main").css("height",s_height*0.95+"px");
    $("#right-main").css("height",s_height*0.95+"px");
    $("#number").css("line-height",$("#r-bottom").height()+"px");
    $(".fagucan").css("font-size",s_height/37.5+"px");
});
window.onresize = function() {
    var s_height=document.documentElement.clientHeight;
    $("body").css("height",s_height+"px");
    $("#top-mian").css("height",s_height*0.05+"px");
    $("#left-main").css("height",s_height*0.95+"px");
    $("#right-main").css("height",s_height*0.95+"px");
    $("#number").css("line-height",$("#r-bottom").height()+"px");
    $(".fagucan").css("font-size",s_height/37.5+"px");
}

//改变right-main
var change_right_mian = function(str,alter,withcust){
    $("#product").css("background-color","transparent");
    $("#customer").css("background-color","transparent");
    $("#invoice").css("background-color","transparent");
    if(str=="detailed_invoice"){//跳转到发票详细信息
        var divdata = $.ajax({url:"./change/"+str,async:false});
        $("#r-form").html(divdata.responseText);
        str="invoice";
    }else{//跳转到添加其他信息
        var divdata;
        if(alter==-1){
            divdata = $.ajax({url:"./change/add"+str+".php",async:false});
        }else{
            divdata = $.ajax({url:"./change/add"+str+".php?no="+alter+"&withcust="+withcust,async:false});
        }
        $("#r-form").html(divdata.responseText);
    }
    $("#"+str).css("background-color","#bebebe");//改变选项颜色
}

//改变底下的提示条
var set_under=function (ino) {
    var get_div = document.getElementById("get_div");
    get_div.innerHTML="当前发票,发票号为:"+ino+",请录入详细信息";
}