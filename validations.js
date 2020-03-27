var error={"up_uname":1,"email":1,"phone":1,"up_password":1,"confirm_password":1,"gender":1}
var error_sum=0

function check_up_username(element){
    let uname=element.value
    if(uname.length>1){
        let check_request= new XMLHttpRequest()
        check_request.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                if(this.responseText=="true"){
                    document.getElementById("up_uname_msg_icon").className="fa fa-exclamation-circle danger"
                    error["up_uname"]=1
                    document.getElementById("up_uname_err").innerHTML="This username is already taken"
                }
                else{
                    let pattern=/^[@\w]+$/
                    if(pattern.test(uname)){
                        document.getElementById("up_uname_msg_icon").className="fa fa-check-circle safe"
                        error["up_uname"]=0
                        document.getElementById("up_uname_err").innerHTML="Invalid username"
                        document.getElementById("up_uname_err").style.visibility="hidden"
                    }
                    else{
                        document.getElementById("up_uname_msg_icon").className="fa fa-exclamation-circle danger"
                        error["up_uname"]=1
                        document.getElementById("up_uname_err").innerHTML="Invalid username"
                    }
                }
            }
        }
        check_request.open("GET","check_username.php?uname="+uname,true)
        check_request.send()
    }
    else{
        document.getElementById("up_uname_msg_icon").className="fa fa-exclamation-circle danger"
        error["up_uname"]=1
        document.getElementById("up_uname_err").innerHTML="username too short"
    }
}

function check_email(element){
    let email=element.value
    let check_request= new XMLHttpRequest()
    check_request.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
        if(this.responseText=="true"){
            document.getElementById("email_msg_icon").className="fa fa-exclamation-circle danger"
                error["email"]=1
                document.getElementById("email_err").innerHTML="This email is already registered"
            }
            else{
                let pattern=/^[\w\.]+@[\w]+\.[\w\.]*[\w]+$/
                if(pattern.test(email)){
                    document.getElementById("email_msg_icon").className="fa fa-check-circle safe"
                    error["email"]=0
                    document.getElementById("email_err").innerHTML="Invalid email"
                    document.getElementById("email_err").style.visibility="hidden"
                }
                else{
                    document.getElementById("email_msg_icon").className="fa fa-exclamation-circle danger"
                    error["email"]=1
                    document.getElementById("email_err").innerHTML="Invalid email"
                }
            }
        }
    }
    check_request.open("GET","check_email.php?email="+email,true)
    check_request.send()
}

function check_phone(element){
    let phone = element.value
    let check_request= new XMLHttpRequest()
    check_request.onreadystatechange=function(){
    if(this.readyState==4 && this.status==200){
        if(this.responseText=="true"){
            document.getElementById("phone_msg_icon").className="fa fa-exclamation-circle danger"
                error["phone"]=1
                document.getElementById("phone_err").innerHTML="This phone no. is already registered"
            }
            else{
                let pattern=/^((\+91)|(91)|0)?[1-9]\d{9}$/
                if(pattern.test(phone)){
                    document.getElementById("phone_msg_icon").className="fa fa-check-circle safe"
                    error["phone"]=0
                    document.getElementById("phone_err").innerHTML="Invalid phone no."
                    document.getElementById("phone_err").style.visibility="hidden"
                }
                else{
                    document.getElementById("phone_msg_icon").className="fa fa-exclamation-circle danger"
                    error["phone"]=1
                    document.getElementById("phone_err").innerHTML="Invalid phone no."
                }
            }
        }
    }
    check_request.open("GET","check_phone.php?phone="+phone,true)
    check_request.send()
}

function check_up_password(element){
    let password = element.value
    let pattern=/^[\w@#$!&%*?\.+-,]{4,}$/
    if(pattern.test(password)){
        document.getElementById("up_password_msg_icon").className="fa fa-check-circle safe"
        error["up_password"]=0
        document.getElementById("up_password_err").innerHTML="Invalid password"
        document.getElementById("up_password_err").style.visibility="hidden"
    }
    else{
        document.getElementById("up_password_msg_icon").className="fa fa-exclamation-circle danger"
        error["up_password"]=1
        document.getElementById("up_password_err").innerHTML="Invalid password"
    }
}

function check_confirm_password(element){
    let confirm_password = element.value
    let password = document.getElementById("up_password").value
    if(password===confirm_password){
        document.getElementById("confirm_password_msg_icon").className="fa fa-check-circle safe"
        error["confirm_password"]=0
        document.getElementById("confirm_password_err").innerHTML="Password didn't match"
        document.getElementById("confirm_password_err").style.visibility="hidden"
    }
    else{
        document.getElementById("confirm_password_msg_icon").className="fa fa-exclamation-circle danger"
        error["confirm_password"]=1
        document.getElementById("confirm_password_err").innerHTML="Password didn't match"
    }
}

function check_gender(){
    if(document.getElementById("male").checked){
        error['gender']=0
        document.getElementById("gender_err").visibility="hidden"
    }
    else if(document.getElementById("female").checked){
        error['gender']=0
        document.getElementById("gender_err").visibility="hidden"
    }
    else if(document.getElementById("others").checked){
        error['gender']=0
        document.getElementById("gender_err").visibility="hidden"
    }
    else{
        error['gender']=1
        document.getElementById("gender_err").style.visibility="visible"
    }
}

function send_sign_up_form(){
    check_gender()
    check_up_username(document.getElementById("up_uname"))
    check_email(document.getElementById("email"))
    check_phone(document.getElementById("phone"))
    for(x in error){
        error_sum+=error[x]
    }
    if(error_sum==0){
        document.getElementById("sign_up_form").submit()
    }
    else{
        if(error['up_uname']==1){
            document.getElementById("up_uname_err").style.visibility="visible"
        }
        if(error['email']==1){
            document.getElementById("email_err").style.visibility="visible"
        }
        if(error['phone']==1){
            document.getElementById("phone_err").style.visibility="visible"
        }
        if(error['up_password']==1){
            document.getElementById("up_password_err").style.visibility="visible"
        }
        if(error['confirm_password']==1){
            document.getElementById("confirm_password_err").style.visibility="visible"
        }
        error_sum=0
    }
}

function display_in_uname_err(){
    document.getElementById("in_uname_err").style.visibility="visible"
}
function display_in_password_err(){
    document.getElementById("in_password_err").style.visibility="visible"
}