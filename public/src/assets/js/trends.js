
function timeConverter(UNIX_timestamp){
  var a = new Date(UNIX_timestamp * 1000);
  var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
  var year = a.getFullYear();
  var month = months[a.getMonth()];
  var date = a.getDate();
  var hour = a.getHours();
  var min = a.getMinutes();
  var sec = a.getSeconds();
  var time = date + ' ' + month + ' ' + year + ' ' + hour + ':' + min + ':' + sec ;
  return time;
}

function getHashtags()
{
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
                text += "<a href='#' class='hashtag-link' onclick='getPostsFromHashtag(" + tag + ")'>" +
                    tag +
                    "</a>";
            }
            alert('wut ?')
            document.getElementById('hashtag-in-list').innerHTML = text;
            alert('wot ?')
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
    alert(nique)
    var request = new XMLHttpRequest();
    request.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var text = '';
            var author;
            var content;
            var date;
            var id;
            var result = JSON.parse(request.responseText)["result"];
            console.log(result);
            text += "<h2 class=\"selected-hashtag-name\">" +
                        "#" + hashtag +
                    "</h2>";
            result.forEach
            (function (r)
                {
                    author = r['author']['username'];
                    content = r['content'];
                    date = timeConverter(r['timestamp']);
                    id = r['id'];
                    text += postToHtml(author, content, date, id);
                }
            )
            document.getElementById('post-feed').innerHTML = text;
        }
    };
    request.open("GET", "/api/trends/fromTag?tag=" + hashtag, true);
    request.send();
    return false;
}


function getTopLikes()
{
    var request =  new XMLHttpRequest();
    request.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            console.log(this.responseText);
            var text = "";
            var author;
            var content;
            var date;
            var id;
            var result = JSON.parse(request.responseText)["result"];
            result.forEach(
                function (r) {
                    author = r['author']['username'];
                    content = r['content'];
                    date = timeConverter(r['timestamp']);
                    id = r['id'];
                    text += postToHtml(author, content, date, id);
            })

            document.getElementById('post-feed').innerHTML = text;
        }
    };
    request.open("GET", "/api/trends/toplikes", true);
    request.send();
    return false;

}

function test()
{
    document.getElementById('post-feed').innerHTML = "toto";
}