$(document).ready(function () {
    var s_height=document.documentElement.clientHeight;
    $("body").css("height",s_height+"px");
    // document.getElementsByTagName("body")[0].style.fontSize = document.body.clientWidth / 37.5 + 'px';
    $("#top-mian").css("height",s_height*0.05+"px");
    $("#left-main").css("height",s_height*0.95+"px");
    $("#right-main").css("height",s_height*0.95+"px");
    $("#number").css("line-height",$("#r-bottom").height()+"px");
    $(".fagucan").css("font-size",s_height/37.5+"px");
    change_right_mian('invoice');
});
window.onresize = function() {
    var s_height=document.documentElement.clientHeight;
    $("body").css("height",s_height+"px");
    // document.getElementsByTagName("body")[0].style.fontSize = document.body.clientWidth / 37.5 + 'px';
    $("#top-mian").css("height",s_height*0.05+"px");
    $("#left-main").css("height",s_height*0.95+"px");
    $("#right-main").css("height",s_height*0.95+"px");
    $("#number").css("line-height",$("#r-bottom").height()+"px");
    $(".fagucan").css("font-size",s_height/37.5+"px");
}

//改变right-main
var change_right_mian = function(str){
    $("#product").css("background-color","transparent");
    $("#customer").css("background-color","transparent");
    $("#invoice").css("background-color","transparent");
    var divdata = $.ajax({url:"./view/"+str+".php",async:false});
    $("#r-table").html(divdata.responseText);
    if(str=="product_view"){
        str="product";
    }else if(str=="customer_view"){
        str="customer"
    }
    $("#"+str).css("background-color","#bebebe");
}

