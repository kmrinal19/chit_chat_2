function update_online_people(){
    let fetch_request = new XMLHttpRequest()
    fetch_request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("people_list").innerHTML = this.responseText
        }
    }
    fetch_request.open("GET", "fetch_online_users.php", true)
    fetch_request.send()
}
update_online_people()
var update_online=setInterval(update_online_people,5000)
var name_1
var listen

function openchatbox(name){
    document.getElementById("chat_overlay").style.display="grid";
    document.getElementById("chat_head_name").innerHTML=name;
    document.getElementById("sendchat").setAttribute("onclick","send_msg('"+name+"')");
    name_1=name;
    listen_allchat();
    listen_chat_update()
    listen=setInterval(listen_chat_update,500);
}

function listen_allchat(){
    var listen_all_request = new XMLHttpRequest();
    listen_all_request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chat").innerHTML = this.responseText;
        }
    }
    listen_all_request.open("GET", "fetch_chat.php?chatWith="+name_1, true);
    listen_all_request.send();
}

function listen_chat_update(){
    var listen_new_request = new XMLHttpRequest();
    listen_new_request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("chat").innerHTML+= this.responseText;
        }
    }
    listen_new_request.open("GET", "fetch_chat_update.php?chatWith="+name_1, true);
    listen_new_request.send();
}
function send_msg(name){
    var send_request = new XMLHttpRequest();
    var content = document.getElementById("chat_text").value;
    content=content.replace(/'/g,"''");
    document.getElementById("chat_text").value="";
    send_request.open("POST", "send_msg.php", true);
    send_request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    send_request.send("content="+encodeURIComponent(content)+"&chat_with="+name);
}
function closechatbox(){
    document.getElementById("chat_overlay").style.display="none";
    document.getElementById("chat").innerHTML ="";
    clearInterval(listen);
}