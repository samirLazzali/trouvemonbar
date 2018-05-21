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

function resolvePostReport(postId, deletePost)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200)
        {
            console.log(xhttp.responseText);
            var result = JSON.parse(xhttp.responseText);
            if (result["status"] == STATUS_OK)
            {
                var div = document.getElementById("post-report-" + postId);
                addClass(div, "report-resolved");
                console.log("Resolved post report " + postId + " successfully.");
            }
            else
            {
                console.log("Couldn't resolve reports for " + postId + " : " + result);
            }
        }
    };
    xhttp.open("GET", "/api/moderation/resolvepost?post=" + postId + "&delete=" + deletePost, true);
    xhttp.send();
    return false;
}

function resolveUserReport(userId, deactivate)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200)
        {
            console.log(xhttp.responseText);
            var result = JSON.parse(xhttp.responseText);
            if (result["status"] == STATUS_OK)
            {
                var div = document.getElementById("user-report-" + userId);
                addClass(div, "report-resolved");
                console.log("Resolved user report " + userId + " successfully.");
            }
            else
            {
                console.log("Couldn't resolve reports for " + userId + " : ");
                console.log(result);
            }
        }
    };
    xhttp.open("GET", "/api/moderation/resolveuser?user=" + userId + "&deactivate=" + deactivate, true);
    xhttp.send();
    return false;
}