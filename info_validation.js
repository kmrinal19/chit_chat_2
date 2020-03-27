var info_error={'name_info':1,'email_info':1,'phone_info':1,'birthday_info':1}
var sum_info_error=0
function hide(id){
    document.getElementById(id).style.visibility="hidden"
}
function show(id){
    document.getElementById(id).style.visibility="visible"
}
function write_in(id,string){
    document.getElementById(id).innerHTML=string
}
function find_value(id){
    return document.getElementById(id).value
}
function check_info_name(){
    let pattern=/[A-Za-z\s\.]+/
    let id="info_name_err"
    let name=find_value("name_info")
    if(name.length==0){
        write_in(id,"Please enter your name")
        show(id)
        info_error['name_info']=1
    }
    else{
        if(pattern.test(name)){
            hide(id)
            info_error['name_info']=0
        }
        else{
            write_in(id,"Invalid name")
            show(id)
            info_error['name_info']=1
        }
    }
}

function check_info_email(){
    let email=find_value("email_info")
    let pattern=/^[\w\.]+@[\w]+\.[\w\.]*[\w]+$/
    let id="info_email_err"
    if(email.length==0){
        write_in(id,"Please enter your email")
        show(id)
        info_error['email_info']=1
    }
    else{
        if(pattern.test(email)){
            let check_request= new XMLHttpRequest()
            check_request.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                if(this.responseText=="true"){
                    write_in(id,"This e-mail id is already registered")
                    show(id)
                    info_error['email_info']=1
                }
                else{
                    hide(id)
                    info_error['email_info']=0
                }
            }}
            check_request.open("GET","check_update_email.php?email="+email,true)
            check_request.send()
        }
        else{
            write_in(id,"Invalid email")
            show(id)
            info_error['name_info']=1
        }
    }
}

function check_info_phone(){
    let phone=find_value("phone_info")
    let pattern=/^((\+91)|(91)|0)?[1-9]\d{9}$/
    let id="info_phone_err"
    if(phone.length==0){
        write_in(id,"Please enter your phone no.")
        show(id)
        info_error['phone_info']=1
    }
    else{
        if(pattern.test(phone)){
            let check_request= new XMLHttpRequest()
            check_request.onreadystatechange=function(){
            if(this.readyState==4 && this.status==200){
                if(this.responseText=="true"){
                    write_in(id,"This phone no. is already registered")
                    show(id)
                    info_error['phone_info']=1
                }
                else{
                    hide(id)
                    info_error['phone_info']=0
                }
            }}
            check_request.open("GET","check_update_phone.php?phone="+phone,true)
            check_request.send()
        }
        else{
            write_in(id,"Invalid phone no.")
            show(id)
            info_error['phone_info']=1
        }
    }
}

function check_info_birthday(){
    id="info_birthday_err"
    let birthdate=find_value("birthdate")
    let birthmonth=find_value("birthmonth")
    let birthyear=find_value("birthyear")
    var months=['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']
    var month_days={'Jan':31,'Feb':29,'Mar':31,'Apr':30,'May':31,'Jun':30,'Jul':31,'Aug':31,'Sep':30,'Oct':31,'Nov':30,'Dec':31}
    if((birthyear%4!=0)||((birthyear%100==0)&&(birthyear%400!=0))){
        month_days['Feb']=28;
    }
    if(month_days[birthmonth]<birthdate){
        write_in(id,"Invalid Date")
        show(id)
        info_error['birthday_info']=1
    }
    else{
        hide(id)
        info_error['birthday_info']=0
    }
}
check_info_name()
check_info_email()
check_info_phone()
check_info_birthday()
function check_profile_status(){
    sum_info_error=0
    check_info_name()
    check_info_email()
    check_info_phone()
    check_info_birthday()
    for(x in info_error){
        sum_info_error+=info_error[x]
    }
    if(sum_info_error==0){
        document.getElementById("profile_info_left").submit()
    }
}
function password_change_validate(){
    let pattern=/^[\w@#$!&%*?\.+-,]{4,}$/
    let new_pass=find_value("new_password")
    let id="new_pass_err"
    if(!pattern.test(new_pass)){
        show(id)
    }
    else{
        hide(id);
    }
}
function password_change_request(){
    let pattern=/^[\w@#$!&%*?\.+-,]{4,}$/
    let id="new_pass_err"
    let new_pass=find_value("new_password")
    if(pattern.test(new_pass)){
        hide(id);
        document.getElementById("password_form").submit();
    }
    else{
        show(id)
    }
}