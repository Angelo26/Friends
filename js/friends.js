
$(document).ready(function(){
    
    $("#signup").click(function(){
        $(".log").css("display","none");
        $(".reg").fadeIn(500);
        $(".reg").css("display","flex");
    });
    $("#signin").click(function(){
        $(".reg").css("display","none");
        $(".log").fadeIn(500);
    });
});