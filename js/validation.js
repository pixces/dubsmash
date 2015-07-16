/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/

$(document).ready(function(){
	//global vars
	var form = $("#customForm");
	var name = $("#name");
	var nameInfo = $("#nameInfo");
	var tittle = $("#tittle");
	var tittleInfo = $("#tittleInfo");
	var mobile = $("#mobile");
	var mobileInfo = $("#mobileInfo");
	var email = $("#email");
	var emailInfo = $("#emailInfo");
	var uploadvideo = $("#uploadvideo");
	var uploadvideoInfo = $("#uploadvideoInfo");
	var category = $("#category");
	var categoryInfo = $("#categoryInfo");
	var message = $("#message");
	
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
	form.submit(function(){
		if(validateName() & validatetittle() & validateMobile() & validateEmail() &  validateMessage() &  validateuploadvideo() &  validatecategory())
			return true
		else
			return false;
	});
	
		function validateName(){
		//if it's NOT valid
		if(name.val().length < 3){
			name.addClass("error");
			nameInfo.text("We want names with more than 2 letters!");
			nameInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			name.removeClass("error");
			nameInfo.text("What's your name?");
			nameInfo.removeClass("error");
			return true;
		}
	}
	
	function validatetittle(){
		//if it's NOT valid
		if(tittle.val().length < 3){
			tittle.addClass("error");
			tittleInfo.text("We want names with more than 2 letters!");
			tittleInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			tittle.removeClass("error");
			tittleInfo.text("What's your name?");
			tittleInfo.removeClass("error");
			return true;
		}
	}
	
	function validatecategory(){
		//if it's NOT valid
		if(category.val().length < 3){
			category.addClass("error");
			categoryInfo.text("We want names with more than 2 letters!");
			categoryInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			category.removeClass("error");
			categoryInfo.text("What's your name?");
			categoryInfo.removeClass("error");
			return true;
		}
	}
	
	function validateuploadvideo(){
		//if it's NOT valid
		if(uploadvideo.val().length < 3){
			uploadvideo.addClass("error");
			uploadvideo.text("We want names with more than 2 letters!");
			uploadvideoInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			uploadvideo.removeClass("error");
			uploadvideoInfo.text("What's your name?");
			uploadvideoInfo.removeClass("error");
			return true;
		}
	}

	//validation functions
	function validateMobile(){
		//testing regular expression
		var a = $("#mobile").val();
		var filter = /^[0-9-+]+$/;
		//if it's valid email
		if(filter.test(a)){
			mobile.removeClass("error");
			mobileInfo.text("Valid E-mail please, you will need it to log in!");
			mobileInfo.removeClass("error");
			return true;
		}
		//if it's NOT valid
		else{
			mobile.addClass("error");
			mobileInfo.text("Type a valid e-mail please");
			mobileInfo.addClass("error");
			return false;
		}
	}
	
	
	//validation functions
	function validateEmail(){
		//testing regular expression
		var a = $("#email").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		//if it's valid email
		if(filter.test(a)){
			email.removeClass("error");
			emailInfo.text("Valid E-mail please, you will need it to log in!");
			emailInfo.removeClass("error");
			return true;
		}
		//if it's NOT valid
		else{
			email.addClass("error");
			emailInfo.text("Type a valid e-mail please");
			emailInfo.addClass("error");
			return false;
		}
	}
	
	function validateMessage(){
		//it's NOT valid
		if(message.val().length < 5){
			message.addClass("error");
			return false;
		}
		//it's valid
		else{			
			message.removeClass("error");
			return true;
		}
	}
});