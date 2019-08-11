function TxtBoxExtensionValidate(txtBoxValue,extArray)
{
    var n=txtBoxValue.split(".");
    var allowedExt=extArray.split(",");
    var error=true;
    for(var i=0;i<allowedExt.length;i++)
    {
        if(n[1]==allowedExt[i]) error=false;
    }
    return error;
}

function txtValidate(txt) 
{ 
	txt = document.getElementById(txt);
	txt.value = txt.value.replace(/[^,0-9\n\r]+/g, '');
}

function validateEmail(email_value) 
{
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   var address = email_value;
   if(reg.test(address) == false) {
      return false;
   }
   else
   {
   	return true;
   }
}

function checkIt(evt,ele) {
    evt = (evt) ? evt : window.event
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		alert("This field accepts numbers only");
		document.getElementById(ele).focus();
        return false;
    }
	else {return true;}
    status = "";
}

function checkPwStrength(pw)
{
   
    var err="";
    var reg1 = /[0-9]+/;
    if(reg1.test(pw) == false)
    {
        err+="Password must contain at least one digit";
    }
   
    var reg2 = /[a-zA-Z]+/;
    if(reg2.test(pw) == false)
    {
        err+="\nPassword must contain at least one alphabet";
    }
   
    var reg3 = /[!|@|#|$|%|^|&|*|_]+/;       
    if(reg3.test(pw) == false)
    {
        err+="\nPassword must contain at least one special character such as ! @ # $ % ^ & * _";
    }        
    if(err!="")
    {
        alert(err);
        //document.getElementById('pw').focus();
        return false;
    }
    
    return true;
}
function nameValidator(name)
{
    var regex = /^[a-zA-Z. ]*$/;
    if(regex.test(name) == false)
    {      
       return false;
    }
    else
    {
       return true;
    }
}

