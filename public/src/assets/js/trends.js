function getHashtags()
{
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
            console.log(request.responseText);
            var result = JSON.parse(request.responseText)['result'];
            console.log(result);
            var text = '';
            for(var tag in result) {
                text += "<div class='hashtag-in-list' title='Afficher les publications liées à ce hashtag'><a href='#' class='hashtag-link' onclick='getPostsFromHashtag(\"" + tag + "\")'>" + tag + "</a></div>";
            }
            document.getElementById('hashtag-list').innerHTML = text;
        }
    };
    request.open("GET", "/api/trends/hashtag", true);
    request.send();
    return false;
}


/*fonction qui affiche dans la page tout les posts cotentant un tag
@param hashtag le tag à passer en entrée
 */

function getPostsFromHashtag(hashtag)
{
    var request = new XMLHttpRequest();
    request.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var text = '';
            var result = JSON.parse(request.responseText)["result"];
            text += "<h2 class=\"selected-hashtag-name\">" +
                        "#" + hashtag +
                    "</h2>";
            text += getContent(result);
            document.getElementById('post-feed').innerHTML = text;
        }
    };
    hashtag = hashtag.replace("#", "");
    request.open("GET", "/api/trends/fromtag?limit=$trendLimit&getoriginals=true&tag=" + hashtag, true);
    request.send();
    return false;
}

function getContent(result)
{
    var text = "";
    var author;
    var content;
    var date;
    var id;
    result.forEach(
        function (r) {
            console.log(r);
            author = r['author']['username'];
            content = r['content'];
            date = timeConverter(r['timestamp']);
            id = r['id'];
            if (r['repostOf'] != null)
                text += rawRepostToHtml(r)
            else
                text += postToHtml(author, content, date, id);
        })
    return text;
}

function getTopLikes()
{
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
            var text = getContent(result);
            document.getElementById('post-feed').innerHTML = text;
        }
    };
    request.open("GET", "/api/trends/toplikes?limit=$trendLimit&getoriginals=true", true);
    request.send();
    return false;
}

function getTopDislikes()
{
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
            var text = getContent(result);
            document.getElementById('post-feed').innerHTML = text;
        }
    };
    request.open("GET", "/api/trends/topdislikes?limit=$trendLimit&getoriginals=true", true);
    request.send();
    return false;
}


function getTopRt()
{
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
            console.log(request)
            var result = JSON.parse(request.responseText)["result"];
            var text = getContent(result);
            document.getElementById('post-feed').innerHTML = text;
        }
    };
    request.open("GET", "/api/trends/toprt?limit=$trendLimit&getoriginals=true", true);
    request.send();
    return false;
}