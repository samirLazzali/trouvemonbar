var newPostActive = false;
var newUsernameActive = false;
var newMdpActive = false;
var newEmailActive = false;


function newPost_onFocus()
{
    var div = document.getElementById("new-post-content");

    if(!newPostActive)
        div.innerHTML = "";
}

function newPost_onBlur()
{
    var div = document.getElementById("new-post-content");
    div.innerHTML = div.innerHTML.trim();
    newPostActive = div.innerHTML != "";
    if(!newPostActive)
        div.innerHTML = "Nouvelle publication...";
}

function sendNewPost()
{
    var div = document.getElementById("new-post-content");

    if (div.innerHTML.trim() == "")
        return;

    CreatePost(div.innerHTML, null);

    div.innerHTML = "";
    newPost_onBlur();
}

function CreatePost(value, user_Response)
{
    var xhttp = new XMLHttpRequest();
    xhttp.open("POST", "/api/post/new.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if(user_Response == null){
        xhttp.send("content="+value);
    }
    else {
        xhttp.send("content=" + value + "&ResponseTo=" + user_Response);
    }
}



