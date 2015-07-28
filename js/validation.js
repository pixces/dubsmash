/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function() {
    //global vars
    var form = $("#customForm");
    //var name = $("#username");
	var name = $("#customForm #username");
	
    var nameInfo = $("#nameInfo");
    var tittle = $("#mediatittle");
    var tittleInfo = $("#tittleInfo");
    var mobile = $("#usermobile");
    var mobileInfo = $("#mobileInfo");
    var email = $("#useremail");
    var emailInfo = $("#emailInfo");
    var uploadvideo = $("#uploadmedia");
    var uploadvideoInfo = $("#uploadmediaInfo");
    var category = $("#mediacategory");
    var categoryInfo = $("#categoryInfo");
    var message = $("#messagebox");
    var messageInfo = $("#messageInfo");

    //On blur
    name.blur(validateName);
    tittle.blur(validatetittle);
    mobile.blur(validateMobile);
    email.blur(validateEmail);
    uploadvideo.blur(validateuploadvideo);
    category.blur(validatecategory);
    //On key press
    name.keyup(validateName);
    message.keyup(validateMessage);
    //On Submitting


    $("form#customForm").on('submit', function(event) {
        event.preventDefault();
        $(this).find(":submit").hide();

        if (validateName() & validatetittle() & validateMobile() & validateEmail() & validateMessage() & validateuploadvideo() & validatecategory())
        {
            var fd = new FormData();
            var file_data = $('input[type="file"]')[0].files; // for multiple files
            for (var i = 0; i < file_data.length; i++) {
                fd.append("file_" + i, file_data[i]);
            }
            var other_data = $('form').serializeArray();
            $.each(other_data, function(key, input) {
                fd.append(input.name, input.value);
            });
            $.ajax({
                url: submitUrl,
                type: 'POST',
                data: fd,
                beforeSend: function() {
                    // do some loading options
                    $(this).find(":submit").show();
                    $("#ajax-loader-icon").removeClass("hide");
                },
                success: function(data) {
                    // on success do some validation or refresh the content div to display the uploaded images
                    Obj = JSON.parse(data);
                    $("#ajax-loader-icon").addClass("hide");
                    if (Obj.error == 0) {
                        $(".formResponse").removeClass("hide");
                        $(".Sbmtfrm").addClass("hide");
                    } else if (Obj.error == 1) {
                        $("#ajax-loader-icon").removeClass("hide");
                        $("#send").show();
                        alert("Error:" + Obj.message);
                        return false;
                    }
                },
                complete: function() {
                    $("#ajax-loader-icon").addClass("hide");
                },
                error: function(xhr, textStatus, error) {
                    $("#ajax-loader-icon").addClass("hide");
                    console.log(error);
                    $(this).find(":submit").show();
                },
                cache: false,
                contentType: false,
                processData: false
            });

        }

        else
        {
            $(this).find(":submit").show();
            $("#ajax-loader-icon").addClass("hide");
            return false;
        }


    });

    function validateName() {
        //if it's NOT valid
        if (name.val().length < 3) {
            name.addClass("error");
            //nameInfo.text("We want names with more than 2 letters!");
			nameInfo.text("Please enter your username");
            nameInfo.addClass("error");
            return false;
        }
        //if it's valid
        else {
            name.removeClass("error");
			//nameInfo.text("What's your name?");
            nameInfo.text(" ");
            nameInfo.removeClass("error");
            return true;
        }
    }

    function validatetittle() {
        //if it's NOT valid
        if (tittle.val().length < 3) {
            tittle.addClass("error");
            tittleInfo.text("Please enter your media title");
            tittleInfo.addClass("error");
            return false;
        }
        //if it's valid
        else {
            tittle.removeClass("error");
            tittleInfo.text(" ");
            tittleInfo.removeClass("error");
            return true;
        }
    }

    function validatecategory() {
        //if it's NOT valid
        if (category.val().length < 3) {
            category.addClass("error");
            categoryInfo.text("Please select your media category");
            categoryInfo.addClass("error");
            return false;
        }
        //if it's valid
        else {
            category.removeClass("error");
            categoryInfo.text(" ");
            categoryInfo.removeClass("error");
            return true;
        }
    }

    function validateuploadvideo() {
        //if it's NOT valid
        if (uploadvideo.val() == '') {
            uploadvideo.addClass("error");
            uploadvideoInfo.text("Upload a Dubsmash Video");
            uploadvideoInfo.addClass("error");
            return false;
        }
        //if it's valid
        else {
            uploadvideo.removeClass("error");
            uploadvideoInfo.text(" ");
            uploadvideoInfo.removeClass("error");
            return true;
        }
    }

    //validation functions
    function validateMobile() {
        //testing regular expression
        var a = $("#usermobile").val();
        var filter = /^[0-9-+]+$/;
        //if it's valid email
        if (filter.test(a)) {
            mobile.removeClass("error");
			mobileInfo.text(" ");
            mobileInfo.removeClass("error");
            return true;
        }

        else {
            mobile.addClass("error");
            mobileInfo.text("Please enter your mobile number");
            mobileInfo.addClass("error");
            return false;
        }
    }


    //validation functions
    function validateEmail() {
        //testing regular expression
        var a = $("#useremail").val();
        var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
        //if it's valid email
        if (filter.test(a)) {
            email.removeClass("error");
            //emailInfo.text("Valid E-mail please, you will need it to log in!");
			emailInfo.text(" ");
            emailInfo.removeClass("error");
            return true;
        }
        //if it's NOT valid
        else {
            email.addClass("error");
            emailInfo.text("Please enter your email address");
            emailInfo.addClass("error");
            return false;
        }
    }

    function validateMessage() {
        //it's NOT valid
        if (message.val().length < 5) {
            message.addClass("error");
            messageInfo.text("Please enter your message");
            messageInfo.addClass("error");
            return false;
        }
        //it's valid
        else {
            message.removeClass("error");
            messageInfo.text('');
            messageInfo.removeClass("error");
            return true;
        }
    }
});