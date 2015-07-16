/**
 * Created by zainulabdeen on 17/07/15.
 */

$(document).ready(function () {

    $(".hmprcptBtn").click(function () {
        $(".participateprceCntr").addClass("hide");
        $(".participatelgnCntr").removeClass("hide");
    });

    $(".participatelgncls").click(function () {
        $(".participateprceCntr").removeClass("hide");
        $(".participatelgnCntr").addClass("hide");
    });

    $(".sldetp").click(function(){
        $("html, body").animate({ scrollTop: "0px" });
    });


});

