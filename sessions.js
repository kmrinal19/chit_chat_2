function update_session(){
    var ses_update = new XMLHttpRequest()
    ses_update.open("GET", "update_session_time.php", true)
    ses_update.send()
}
var update=setInterval(update_session,5000)