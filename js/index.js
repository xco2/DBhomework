$(document).ready(function () {
    var s_height=document.documentElement.clientHeight;
    $("body").css("height",s_height+"px");
    // document.getElementsByTagName("body")[0].style.fontSize = document.body.clientWidth / 37.5 + 'px';
    $("#top-mian").css("height",s_height*0.05+"px");
    loginhight(s_height);
    $("#left-main").css("height",s_height*0.95+"px");
    $("#right-main").css("height",s_height*0.95+"px");
    $("#number").css("line-height",$("#r-bottom").height()+"px");
    change_right_mian('invoice');
});
window.onresize = function() {
    var s_height=document.documentElement.clientHeight;
    $("body").css("height",s_height+"px");
    // document.getElementsByTagName("body")[0].style.fontSize = document.body.clientWidth / 37.5 + 'px';
    $("#top-mian").css("height",s_height*0.05+"px");
    loginhight(s_height);
    $("#left-main").css("height",s_height*0.95+"px");
    $("#right-main").css("height",s_height*0.95+"px");
    $("#number").css("line-height",$("#r-bottom").height()+"px");
}
// 登录按钮竖直居中
var loginhight=function (s_height) {
    $("#login").css("line-height",s_height*0.05+"px");
}

//改变right-main
var change_right_mian = function(str){
    $("#product").css("background-color","transparent");
    $("#customer").css("background-color","transparent");
    $("#invoice").css("background-color","transparent");
    $("#"+str).css("background-color","#97ddff");
    var divdata = $.ajax({url:"./view/"+str+".php",async:false});
    $("#r-table").html(divdata.responseText);
}

