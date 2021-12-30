var regReady=false;
function initValidation(){
    setTimeout(validate,100);
    return regReady;
}
function validate(){
    let frm=document.getElementById("form_rht");
    let inputs=frm.querySelectorAll("input");
    regReady=true;
    if(inputs[0].value.length==0){
        inputs[0].reportValidity();
        regReady=false;
        return;
    }
    
    if(inputs[1].value.length==0){
        inputs[1].reportValidity();
        regReady=false;
        return;
    }
    
    if(inputs[2].value.length==0){
        inputs[2].reportValidity();
        regReady=false;
        return;
    }
    
    if(inputs[3].value.length==0){
        inputs[3].reportValidity();
        regReady=false;
        return;
    }
    
    if(inputs[4].value.length==0){
        inputs[4].reportValidity();
        regReady=false;
        return;
    }
    
    if(inputs[5].value.length==0){
        inputs[5].reportValidity();
        regReady=false;
        return;
    }

    if(inputs[3].value!==inputs[4].value){
        inputs[4].setCustomValidity("Passwords didn't match");
        inputs[4].reportValidity();
        inputs[4].addEventListener('input', function(){
            inputs[4].setCustomValidity("");
        });
        
        inputs[3].addEventListener('input', function(){
            inputs[4].setCustomValidity("");
        });

        regReady=false;
        return;
    }
    
    if(usernameAvaliable(inputs[0].value)==false){
        inputs[0].setCustomValidity("Username already exists");
        inputs[0].reportValidity();
        inputs[0].addEventListener('input', function(){
            inputs[0].setCustomValidity("");
        });
        regReady=false;
        return;
    }
    if(!emailAvaliable(inputs[2].value)){
        inputs[2].setCustomValidity("Email already exists");
        inputs[2].reportValidity();
        inputs[2].addEventListener('input', function(){
            inputs[2].setCustomValidity("");
        });
        regReady=false;
        return;
    }
    regReady = true;
}

function usernameAvaliable(s){
    let req=new XMLHttpRequest();
    let url="extra/username_exists.php";
    ret=false;
	req.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
            if(this.responseText==0){
                 ret=true;
			}
	  	}
	};
	req.open("POST", url, false);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send("jsonUsername="+JSON.stringify(s));
    return ret;
}

function emailAvaliable(s){
    let req=new XMLHttpRequest();
    let url="extra/email_exists.php";
    ret=false;
	req.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
            if(this.responseText==0){
                 ret=true;
			}
	  	}
	};
	req.open("POST", url, false);
	req.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	req.send("jsonEmail="+JSON.stringify(s));
    return ret;
}