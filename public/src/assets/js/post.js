var STATUS_OK = 200;
var STATUS_ERROR = 400;
var ERROR_NotFound = 404;
var ERROR_EmailRegistered = 460;
var ERROR_UsernameRegistered = 461;
var ERROR_PasswordWeak = 462;
var ERROR_FieldMissing = 463;
var ERROR_WrongPassword = 464;
var ERROR_Permissions = 465;
var ERROR_InvalidType = 466;

function likePost(id)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200)
        {
            var result = JSON.parse(xhttp.responseText);
            if (result["status"] == STATUS_OK)
            {
                var actionLinks = document.getElementsByClassName("action-like-" + id);
                Array.from(actionLinks).forEach(
                    function(element, index, array)
                    {
                        addClass(element, "action-like-on");
                    }
                );

                actionLinks = document.getElementsByClassName("action-dislike-" + id);
                Array.from(actionLinks).forEach(
                    function(element, index, array)
                    {
                        removeClass(element, "action-dislike-on");
                    }
                );
            }
            else
            {
                console.log("Couldn't like post " + id + " : " + result);
            }
        }
    };
    xhttp.open("POST", "/api/post/appreciate?type=Like&post=" + id, true);
    xhttp.send();
    return false;
}

function dislikePost(id)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200)
        {
            var result = JSON.parse(xhttp.responseText);
            if (result["status"] == STATUS_OK)
            {
                var actionLinks = document.getElementsByClassName("action-like-" + id);
                Array.from(actionLinks).forEach(
                    function(element, index, array)
                    {
                        removeClass(element, "action-like-on");
                    }
                );

                actionLinks = document.getElementsByClassName("action-dislike-" + id);
                Array.from(actionLinks).forEach(
                    function(element, index, array)
                    {
                        addClass(element, "action-dislike-on");
                    }
                );
            }
            else
            {
                console.log("Couldn't like post " + id + " : " + result);
            }
        }
    };
    xhttp.open("POST", "/api/post/appreciate?type=Dislike&post=" + id, true);
    xhttp.send();
    return false;
}

function repost(id)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200)
        {
            var result = JSON.parse(xhttp.responseText);
            if (result["status"] == STATUS_OK)
            {
                actionLinks = document.getElementsByClassName("action-repost-" + id);
                Array.from(actionLinks).forEach(
                    function(element, index, array)
                    {
                        addClass(element, "action-repost-on");
                    }
                );
            }
            else
            {
                console.log("Couldn't repost " + id + " : " + result);
            }
        }
    };
    xhttp.open("POST", "/api/post/repost?post=" + id, true);
    xhttp.send();
    return false;
}

function reportPost(id)
{

}