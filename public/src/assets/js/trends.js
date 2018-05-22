var ttype = 0;
var llimit = 10;
var timelimit =  3600;
var ttag = '';

function getContent(result)
{
    var text = "";
    var author;
    var content;
    var date;
    var id;
    result.forEach(
        function (r) {
            author = r['author']['username'];
            content = r['content'];
            date = timeConverter(r['timestamp']);
            id = r['id'];
            if (r['original'] != null)
                text += rawRepostToHtml(r)
            else
                text += postToHtml(author, content, date, id);
        })
    text = text +
        '<a id="link-more-posts" class="link-more-posts" href="#" onclick="morePosts()">' +
            '<div class="post-in-feed" id="link-more-posts-wrapper">' +
                'Plus de posts' +
            '</div>' +
        '</a>'+
        '<a id="link-older-posts" class="link-more-posts" href="#" onclick="olderPosts()">' +
            '<div class="post-in-feed" id="link-more-posts-wrapper">' +
                'Voir des Viieux posts' +
            '</div>' +
        '</a>';
    return text;
}


function getTopLikes()
{
    if (ttype != 0)
    {
        llimit = 10;
        timelimit =  3600;
        ttype = 0;
    }
    addClass(document.getElementById("trend-selector-likes"), "selected");
    removeClass(document.getElementById("trend-selector-hashtags"), "selected");
    removeClass(document.getElementById("trend-selector-retweets"), "selected");
    removeClass(document.getElementById("trend-selector-dislikes"), "selected");
    document.getElementById("hashtag-list").style.display = "none";
    var request =  new XMLHttpRequest();
    request.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var result = JSON.parse(request.responseText)["result"];
            var text = getContent(result) +
                '<a id="link-older-posts" class="link-more-posts" href="#" onclick="ofAllTimes()">' +
                    '<div class="post-in-feed" id="link-more-posts-wrapper">' +
                        'Les plus aimés de tous les temps !' +
                    '</div>' +
                '</a>';
            document.getElementById('post-feed').innerHTML = text;
        }
    };
    request.open("GET", "/api/trends/toplikes?timelimit="+timelimit+"&limit="+llimit+"&getoriginals=true", true);

    request.send();
    return false;
}

function getTopDislikes()
{
    if (ttype != 1)
    {
        llimit = 10;
        timelimit =  3600;
        ttype = 1;
    }
    addClass(document.getElementById("trend-selector-dislikes"), "selected");
    removeClass(document.getElementById("trend-selector-likes"), "selected");
    removeClass(document.getElementById("trend-selector-hashtags"), "selected");
    removeClass(document.getElementById("trend-selector-retweets"), "selected");

    document.getElementById("hashtag-list").style.display = "none";
    var request =  new XMLHttpRequest();
    request.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var result = JSON.parse(request.responseText)["result"];
            var text = getContent(result) +
                '<a id="link-older-posts" class="link-more-posts" href="#" onclick="ofAllTimes()">' +
                    '<div class="post-in-feed" id="link-more-posts-wrapper">' +
                        'Les plus détestés de tous les temps !' +
                    '</div>' +
                '</a>';
            document.getElementById('post-feed').innerHTML = text;
        }
    };
    request.open("GET", "/api/trends/topdislikes?timelimit="+timelimit+"&limit="+llimit+"&getoriginals=true", true);
    request.send();
    return false;
}


function getTopRt()
{
    if (ttype != 2)
    {
        llimit = 10;
        timelimit =  3600;
        ttype = 2;
    }
    addClass(document.getElementById("trend-selector-retweets"), "selected");
    removeClass(document.getElementById("trend-selector-hashtags"), "selected");
    removeClass(document.getElementById("trend-selector-likes"), "selected");
    removeClass(document.getElementById("trend-selector-dislikes"), "selected");

    document.getElementById("hashtag-list").style.display = "none";
    var request =  new XMLHttpRequest();
    request.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var result = JSON.parse(request.responseText)["result"];
            var text = getContent(result) +
                '<a id="link-older-posts" class="link-more-posts" href="#" onclick="ofAllTimes()">' +
                    '<div class="post-in-feed" id="link-more-posts-wrapper">' +
                        'Les plus recyclés de tous les temps !' +
                    '</div>' +
                '</a>';
            document.getElementById('post-feed').innerHTML = text;
        }
    };
    request.open("GET", "/api/trends/toprt?timelimit="+timelimit+"&limit="+llimit+"&getoriginals=true", true);
    request.send();
    return false;
}

function getHashtags()
{
    ttype = 3;
    removeClass(document.getElementById("trend-selector-likes"), "selected");
    addClass(document.getElementById("trend-selector-hashtags"), "selected");
    removeClass(document.getElementById("trend-selector-dislikes"), "selected");
    removeClass(document.getElementById("trend-selector-retweets"), "selected");
    document.getElementById("hashtag-list").style.display = "flex";
    var request =  new XMLHttpRequest();
    request.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var result = JSON.parse(request.responseText)['result'];
            var text = '';
            for(var tag in result)
            {
                text += "<div class='hashtag-in-list' title='Afficher les publications liées à ce hashtag'>" +
                            "<a href='#' class='hashtag-link' onclick='getPostsFromHashtag(\"" + tag + "\")'>" + tag + "</a>" +
                        "</div>";
            }
            text += '<div class=\'hashtag-in-list\' title=\'meilleurs tags ever\'>' +
                        '<a href="#" class=\'hashtag-link\' onclick="ofAllTimes()">top#ever</a>' +
                    '</div>' +
                    '<div class=\'hashtag-in-list\' title=\'plus de GWAAK\'>'+
                        '<a href="#" class=\'hashtag-link\' onclick="moreTags()">plus...</a>' +
                    '</div>';

            document.getElementById('hashtag-list').innerHTML = text;
        }
    };
    request.open("GET", "/api/trends/hashtag?timelimit="+timelimit+"&limit="+llimit+"&getoriginals=true", true);
    request.send();
    return false;
}


/**
 * Fonction qui affiche tous les posts contenant un tag
 * @param hashtag le tag à passer en entrée
 */
function getPostsFromHashtag(hashtag)
{
    if (ttype != 3)
    {
        llimit = 10;
        timelimit =  3600;
        ttype = 3;
    }
    else {
        if (hashtag != ttag)
        {
            llimit = 10;
            timelimit =  3600;
            ttag = hashtag;
        }
    }

    var request = new XMLHttpRequest();
    request.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var text = '';
            console.log(request.responseText);
            var result = JSON.parse(request.responseText)["result"];
            text += "<h2 class=\"selected-hashtag-name\">" +
                "#" + hashtag +
                "</h2>";
            text += getContent(result);
            document.getElementById('post-feed').innerHTML = text;
        }
    };
    hashtag = hashtag.replace("#", "");
    console.log(hashtag);
    request.open("GET", "/api/trends/fromtag?timelimit="+timelimit+"&limit="+llimit+"&getoriginals=true&tag="+hashtag, true);
    request.send();
    return false;
}

function morePosts()
{
    switch(ttype)
    {
        case 0 :
            llimit += 10;
            getTopLikes();
            break;
        case 1 :
            llimit += 10;
            getTopDislikes();
            break;
        case 2 :
            llimit += 10;
            getTopRt();
            break;
        case 3 :
            llimit += 10;
            getPostsFromHashtag(ttag);
            break;
        default :
            break;
    }
}

function olderPosts()
{
    switch(ttype)
    {
        case 0 :
            timelimit += 7200;
            getTopLikes();
            break;
        case 1 :
            timelimit += 7200;
            getTopDislikes();
            break;
        case 2 :
            timelimit += 7200;
            getTopRt();
            break;
        case 3 :
            llimit += 10;
            getPostsFromHashtag(ttag);
            break;
        default :
            break;
    }
}

function ofAllTimes()
{
    switch(ttype)
    {
        case 0 :
            timelimit = 0;
            getTopLikes();
            break;
        case 1 :
            timelimit = 0;
            getTopDislikes();
            break;
        case 2 :
            timelimit = 0;
            getTopRt();
            break;
        case 3 :
            timelimit = 0;
            getHashtags(ttag);
            break;
        default :
            break;
    }
}


function moreTags(){

}