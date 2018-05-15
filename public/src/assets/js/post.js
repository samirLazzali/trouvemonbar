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

                console.log("Liked post " + id + " successfully.");
            }
            else
            {
                console.log("Couldn't like post " + id + " : " + result);
            }
        }
    };
    xhttp.open("GET", "/api/post/appreciate?type=Like&post=" + id, true);
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
                console.log("Disliked post " + id + " successfully.");
            }
            else
            {
                console.log("Couldn't like post " + id + " : " + result);
            }
        }
    };
    xhttp.open("GET", "/api/post/appreciate?type=Dislike&post=" + id, true);
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
                console.log("Reposted post " + id + " successfully.");
            }
            else
            {
                console.log("Couldn't repost " + id + " : " + result);
            }
        }
    };
    xhttp.open("GET", "/api/post/repost?post=" + id, true);
    xhttp.send();
    return false;
}

function reportPost(id)
{
    var reason = document.getElementById("report-reason-" + id).value;
    console.log(reason);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            console.log(xhttp.responseText);
            var result = JSON.parse(xhttp.responseText);
            if (result["status"] == STATUS_OK)
            {
                var reportForm = document.getElementById("report-form-" + id);
                reportForm.style.display = "none";
                var reportLinks = document.getElementsByClassName("action-report-" + id);
                Array.from(reportLinks).forEach(
                    function(element, index, array)
                    {
                        addClass(element, "action-reported");
                    }
                )
                console.log("Reported post " + id + " successfully.");
            }
        }
    }
    xhttp.open("POST", "/api/post/report", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    if (reason != '')
        xhttp.send("post=" + id + "&reason=" + reason);
    else
        xhttp.send("post=" + id);

    return false;
}

function showLikes() {
    var divLikes = document.getElementById("details-likes");
    var divReposts = document.getElementById("details-reposts");

    var selectorDetailsLikes = document.getElementById("linkDetailsLikes");
    var selectorDetailsReposts = document.getElementById("linkDetailsReposts");

    divLikes.style.display = "block";
    divReposts.style.display = "none";

    addClass(selectorDetailsLikes, "interaction-type-selected");
    removeClass(selectorDetailsReposts, "interaction-type-selected");
    return false;
}

function showReposts() {
    var divLikes = document.getElementById("details-likes");
    var divReposts = document.getElementById("details-reposts");

    var selectorDetailsLikes = document.getElementById("linkDetailsLikes");
    var selectorDetailsReposts = document.getElementById("linkDetailsReposts");

    divLikes.style.display = "none";
    divReposts.style.display = "block";

    addClass(selectorDetailsReposts, "interaction-type-selected");
    removeClass(selectorDetailsLikes, "interaction-type-selected");
    return false;
}

function postToHtml(author, content, date, id)
{
    var text =
        '    <div class="post-in-feed">\n' +
        '        <div class="post-header">\n' +
        '            <a href="profile/'+ author +'" class="post-header-author">\n' +
        author +
        '            </a>\n' +
        '            <span class="post-header-date">\n' +
        '                ' + date + '\n' +
        '            </span>\n' +
        '        </div>\n' +
        '        <div class="post-content">\n' +
        content +
        '        </div>\n' +
        '        <div class="post-actions">\n' +
        '            <span class="post-action">\n' +
        '                <a onclick="likePost(\'' + id + '\')" href="#" class="action-link">\n' +
        '                    Like\n' +
        '                </a>\n' +
        '            </span>\n' +
        '            <span class="post-action">\n' +
        '                <a onclick="dislikePost(\'' + id + '\')" href="#" class="action-link">\n' +
        '                    Dislike\n' +
        '                </a>\n' +
        '            </span>\n' +
        '            <span class="post-action">\n' +
        '                <a onclick="respondTo(\'' + id + '\')" href="#" class="action-link">\n' +
        '                    Riposter\n' +
        '                </a>\n' +
        '            </span>\n' +
        '            <span class="post-action">\n' +
        '                <a onclick="repost(\'' + id + '\')" href="#" class="action-link">\n' +
        '                    Recycler<!--<span class="fa fa-redo-alt"></span>-->\n' +
        '                </a>\n' +
        '            </span>\n' +
        '            <span class="post-action">\n' +
        '                <a onclick="toggleBlock(\'report-form-' + id + '\')" href="#" class="action-link">\n' +
        '                    Signaler\n' +
        '                </a>\n' +
        '            </span>\n' +
        '        </div>\n' +
        '        <div style="display: none" class="report-form-wrapper" id="report-form-' + id + '">\n' +
        '            <form onSubmit="return reportPost(\'' + id + '\')" class="report-form">\n' +
        '                <input type="text" id="report-reason-' + id + '" class="report-field" placeholder="Raison du signalement">\n' +
        '                <button type="submit" class="report-submit">\n' +
        '                    Signaler\n' +
        '                </button>\n' +
        '            </form>\n' +
        '        </div>\n' +
        '    </div>';
    return text;
}