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

var Responseactive = false;

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

function respondPost_onFocus(id)
{
    var div = document.getElementById("respond-post-" + id);
    addClass(div, "post-content-active");

    if(!Responseactive)
        div.innerHTML = "";
}

function respondPost_onBlur(id)
{
    var div = document.getElementById("respond-post-" + id);
    div.style.backgroundColor = "var(--darkblue)";
    div.innerHTML = div.innerHTML.trim();
    Responseactive = div.innerHTML != "";
    if(!Responseactive) {
        div.innerHTML = "Réponse...";
    }
}

function verifyAndSendResponse(id){
    var div = document.getElementById("respond-post-" + id);

    if(!Responseactive)
        return false;

    if (div.innerHTML.trim() == "")
    {
        console.log("Not sending empty post.");
        return false;
    }

    sendResponse(div.innerHTML, id);

    div.innerHTML = "";
    toggleBlock("Response-div-" + id);
    respondPost_onBlur(id);
    return false;
}

function sendResponse(value, id){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.status == 200 && this.readyState == 4)
        {
            var result = JSON.parse(xhttp.responseText);
            if (result["status"] == STATUS_OK)
            {
                var div = document.getElementById("respond-post-" + id);
                div.style.backgroundColor = "#8BC34A";
            }
            else
            {
                console.log("Can't post.");
            }
        }
    }
    xhttp.open("POST", "/api/post/new", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("content=" + value + "&responseTo=" + id);
}

function showLikes() {
    var divLikes = document.getElementById("details-likes");
    var divReposts = document.getElementById("details-reposts");
    var divResponses = document.getElementById("details-responses");

    var selectorDetailsLikes = document.getElementById("linkDetailsLikes");
    var selectorDetailsReposts = document.getElementById("linkDetailsReposts");
    var selectorDetailsResponses = document.getElementById("linkDetailsResponses");

    divLikes.style.display = "block";
    divResponses.style.display = "none";
    divReposts.style.display = "none";

    addClass(selectorDetailsLikes, "interaction-type-selected");
    removeClass(selectorDetailsReposts, "interaction-type-selected");
    removeClass(selectorDetailsResponses, "interaction-type-selected");
    return false;
}

function showReposts() {
    var divLikes = document.getElementById("details-likes");
    var divReposts = document.getElementById("details-reposts");
    var divResponses = document.getElementById("details-responses");

    var selectorDetailsLikes = document.getElementById("linkDetailsLikes");
    var selectorDetailsReposts = document.getElementById("linkDetailsReposts");
    var selectorDetailsResponses = document.getElementById("linkDetailsResponses");

    divLikes.style.display = "none";
    divResponses.style.display = "none";
    divReposts.style.display = "block";

    addClass(selectorDetailsReposts, "interaction-type-selected");
    removeClass(selectorDetailsLikes, "interaction-type-selected");
    removeClass(selectorDetailsResponses, "interaction-type-selected");
    return false;
}

function showResponses() {
    var divLikes = document.getElementById("details-likes");
    var divReposts = document.getElementById("details-reposts");
    var divResponses = document.getElementById("details-responses");

    var selectorDetailsLikes = document.getElementById("linkDetailsLikes");
    var selectorDetailsReposts = document.getElementById("linkDetailsReposts");
    var selectorDetailsResponses = document.getElementById("linkDetailsResponses");

    divLikes.style.display = "none";
    divResponses.style.display = "block";
    divReposts.style.display = "none";

    removeClass(selectorDetailsReposts, "interaction-type-selected");
    removeClass(selectorDetailsLikes, "interaction-type-selected");
    addClass(selectorDetailsResponses, "interaction-type-selected");
    return false;
}

function rawPostToHtml(post, showActions = true)
{
    var author = post["author"]["username"];
    var content = post["content"];
    var date = timeConverter(post["timestamp"]);
    var id = post["id"];
    var likes = post["likeCount"];
    var dislikes = post["dislikeCount"];
    var reposts = post["repostCount"];
    return postToHtml(author, content, date, id, likes, dislikes, reposts, showActions);
}

function formatterNombre(n, mot)
{
    if (n == 0)
        return "Aucun " + mot;
    else if (n == 1)
        return "1 " + mot;
    else
        return n + " " + mot + "s";
}

function rawRepostToHtml(post) {
    var original = post['original'];
    var originalId = original['id'];
    var author = post['author']['username'];
    var date = timeConverter(post['timestamp']);
    var id = post['id'];
    var text =
        '    <div class="post-in-feed">\n' +
        '        <div class="post-header">\n' +
        '            <a href="/profile/' + author + '>" class="post-header-author">\n' +
        '                ' + author + '\n' +
        '            </a>\n' +
        '            <span class="notification-reposted-you"> a recyclé</span>\n' +
        '            <span class="post-header-date">' + date + '</span>\n' +
        '        </div>\n' +
        '\n' +
        '        <div class="post-content">\n';
    text = text + rawPostToHtml(original, false);
    text = text +
        '        </div>\n' +
        '        <div class="post-actions">\n' +
        '            <span class="post-action">\n' +
        '                <a onClick="return repost(' + originalId + ');"  href="#" class="action-repost-<?=$original->getID()?> action-link" title="Je souhaite republier ce contenu.">\n' +
        '                    ' + formatterNombre(original["repostCount"], "recyclage") + '\n' +
        '                </a>\n' +
        '            </span>\n' +
        '            <span class="post-actions">\n' +
        '\n' +
        '            </span>\n' +
        '        </div><div id="report-form-' + id + '"></div>\n' +
        '    </div>';
    return text;
}

function postToHtml(author, content, date, id, likecount = -1, dislikecount = -1, repostcount = -1, showActions = true)
{
    if (likecount < 0 || dislikecount < 0 || repostcount < 0) {
        likeText = "Like";
        dislikeText = "Dislike";
        repostText = "Recycler";
    }
    else
    {
        likeText = formatterNombre(likecount, "like");
        dislikeText = formatterNombre(dislikecount, "dislike");
        repostText = formatterNombre(repostcount, "recyclage");
    }

    var text =
        '    <div class="post-in-feed">\n' +
        '        <div class="post-header">\n' +
        '            <a href="/profile/' + author + '" class="post-header-author" title="Se rendre sur le profil de l\'auteur.">\n' +
        '                ' + author + '\n' +
        '            <span class="post-header-date" title="Permalien">\n' +
        '                <a href="/post/' + id + '" class="post-header-date">\n' +
        '                    ' + date + '\n' +
        '                </a>\n' +
        '            </span>\n' +
        '        </div>\n' +
        '\n' +
        '        <div class="post-content">\n' +
        '            ' + content + '\n' +
        '        </div>\n' +
        '\n';
    if (showActions) {
        text +=
            '        <div class="post-actions">\n' +
            '            <span class="post-action">\n' +
            '                <a onClick="return likePost(\'' + id + '\');" href="#" class="action-like-' + id + ' action-link" title="J\'aime cette publication">\n' +
            '                     ' + likeText + '\n' +
            '                </a>\n' +
            '            </span>\n' +
            '            <span class="post-action">\n' +
            '                <a onClick="return dislikePost(\'' + id + '\');" href="#" class="action-dislike-' + id + ' action-link" title="Je n\'aime pas cette publication.">\n' +
            '                    ' + dislikeText + '\n' +
            '                </a>\n' +
            '            </span>\n' +
            '            <span class="post-action">\n' +
            '                <a onClick="return repost(\'' + id + '\');"  href="#" class="action-repost-' + id + ' action-link" title="Republier ce contenu">\n' +
            '                    ' + repostText + '\n' +
            '                </a>\n' +
            '            </span>\n' +
            '            <span class="post-action">\n' +
            '                <a onClick="return toggleBlock(\'Response-div-' + id + '\');"  href="#" class="action-respond-' + id + ' action-link" title="Répondre à cette publication">\n' +
            '                    Riposter\n' +
            '                </a>\n' +
            '            </span>\n' +
            '            <span class="post-action">\n' +
            '                <a onClick="toggleBlock(\'report-form-' + id + '\');"  href="#" class="action-report-' + id + ' action-link action-link-report" title="Cette publication pose un problème ?">\n' +
            '                    Signaler\n' +
            '                </a>\n' +
            '            </span>\n' +
            '        </div>\n' +
            '        <div style="display: none" class="report-form-wrapper" id="report-form-' + id + '">\n' +
            '            <form onSubmit="return reportPost(\'' + id + '\')" class="report-form">\n' +
            '                <input type="text" id="report-reason-' + id + '" class="report-field" placeholder="Raison du signalement">\n' +
            '                <button type="submit" class="report-submit" title="Confirmer le signalement">\n' +
            '                    Signaler\n' +
            '                </button>\n' +
            '            </form>\n' +
            '        </div>\n' +
            '        <div style="display: none" class="response-form-wrapper" id="Response-div-' + id + '">\n' +
            '            <div onBlur="respondPost_onBlur(\'' + id + '\')" class="response-field" onFocus="respondPost_onFocus(\'' + id + '\')" id="respond-post-' + id + '" contenteditable="true">\n' +
            '                  Réponse...\n' +
            '            </div>\n' +
            '            <button class="fas fa-paper-plane response-submit" type="submit" onClick="return verifyAndSendResponse(\'' + id + '\');" title="Envoyer la réponse">\n' +
            '\n' +
            '            </button>\n' +
            '        </div>\n';
    }
    text +=
        '    </div>';
    return text;
}

function refreshFeed(lastRefresh, filter = "")
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            var result = JSON.parse(xhttp.responseText);
            if (result["status"] == 200)
            {
                lastRefresh = result["timestamp"] - 1;
                result = result["result"];
                if (result.length > 0) {
                    Array.from(result).forEach(function(elt, idx, arr) {
                        postsWaiting.push(elt);
                    });
                    document.getElementById("link-posts-waiting").style.display = "block";
                }
                // On rappelle refreshFeed dans cinq secondes
                setTimeout(function () {
                    refreshFeed(lastRefresh, filter);
                }, 1000);
            }
            else
            {
                console.log("Error while refreshing feed: status = " + result["status"] + " (" + result["description"] + ")");
            }
        }
    };
    xhttp.open("POST", "/api/post/latest");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("after=" + lastRefresh + "&limit=25&filter=" + filter);
    return false;
}

function showWaitingPosts()
{
    var feed = document.getElementById("post-feed");
    var html;
    postsWaiting.forEach(function(elt, index, arr) {
        var currentReport = document.getElementById("report-form-" + elt["id"]);
        if (currentReport != undefined)
            return;

        if (elt["repostOf"] != null)
            html = rawRepostToHtml(elt);
        else
            html = rawPostToHtml(elt);
    });
    feed.innerHTML = html + feed.innerHTML;
    toggleBlock("link-posts-waiting");
}

function getPostsBefore(before, filter = "")
{
    console.log("Before : " + before);
    var feed = document.getElementById("post-feed");
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            var result = JSON.parse(xhttp.responseText);
            if (result["status"] == 200)
            {
                result = result["result"];
                var html;
                if (result.length > 0) {
                    Array.from(result).forEach(function(elt, idx, arr) {
                        var currentReport = document.getElementById("report-form-" + elt["id"]);
                        if (currentReport != undefined)
                            return;

                        if (elt["repostOf"] != null)
                            html = rawRepostToHtml(elt);
                        else
                            html = rawPostToHtml(elt);

                        feed.innerHTML += html;

                        _before = elt["timestamp"];
                    });
                }
            }
            else
            {
                console.log("Error while refreshing feed: status = " + result["status"] + " (" + result["description"] + ")");
            }
        }
    };
    document.getElementById("link-more-posts-wrapper").innerHTML = "Chargement...";
    xhttp.open("POST", "/api/post/latest");
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("before=" + before+ "&limit=25&filter=" + filter);
    return false;
}