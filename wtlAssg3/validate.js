function validateForm(){

	var uname=document.forms['myForm']['uname'].value;
	if(uname==""){
		alert("Username must be filled out.");
		return false;
	}
	if(uname.includes(" ")){
		alert("Username must not contain spaces.");
		return false;
	}


	var email= document.forms['myForm']['email'].value;
	if(email==""){
		alert("Email ID must be filled out.");
		return false;
	}
	if(!email.includes("@")|| !email.includes(".")){
		alert("Email ID must be contain '@' and'.'");
		return false;
	}
	if(email.search(/@/)<6){
		alert("Email ID must be contain a few letters before '@'");
		return false;
	}
	if((email.indexOf(".")-email.indexOf("@"))!=4){
		alert("Email ID must be contain 3 letters between '@' and '.'");
		return false;
	}
	if(((email.length-1)-email.indexOf("."))!=2 && ((email.length-1)-email.indexOf("."))!=3){
		alert("Email ID must be contain 2/3 letters after '.'");
		return false;
	}
	if(email.includes(" ")){
		alert("Email ID must not contain spaces.");
		return false;
	}



	var phno=document.forms['myForm']['phno'].value;
	if(phno==""){
		alert("Phone number must be filled out");
		return false;
	}
	if(phno.length!=10){
		alert("Please enter 10-digit phone number");
		return false;
	}


	var pswd=document.forms['myForm']['pswd'].value;
	if(pswd==""){
		alert("Password must be filled out");
		return false;
	}
	if(pswd.length<7){
		alert("Password must contain atleast 7-characters.");
		return false;
	}
	if(!pswd.includes("$") && !pswd.includes("&") && !pswd.includes("@") && !pswd.includes("#")){
		alert("Password must contain @/$/#/&.");
		return false;
	}
	if(pswd.search(/[A-Z]/)<1){
		alert("Password must contain a capital letter.");
		return false;
	}
	if(pswd.search(/[0-9]/)<1){
		alert("Password must contain a number.");
		return false;
	}
	if(pswd.includes(" ")){
		alert("Password must not contain spaces.");
		return false;
	}


	var cpswd=document.forms['myForm']['cpswd'].value;
	if(cpswd!=pswd){
		alert("Passwords don't match. Re-enter password.");
		document.forms['myForm']['cpswd'].value="";
		
		return false;
	}
}