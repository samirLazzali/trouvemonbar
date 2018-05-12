function postToHtml(author, content, date, id)
{
    var text =
        '    <div class="post-in-feed">\n' +
        '        <div class="post-header">\n' +
        '            <a href="profile/'+ author +'" class="post-header-author">\n' +
        '                <?= $author ?>\n' +
        '            </a>\n' +
        '            <span class="post-header-date">\n' +
        '                <?= $date ?>\n' +
        '            </span>\n' +
        '        </div>\n' +
        '        <div class="post-content">\n' +
                         content +
        '        </div>\n' +
        '        <div class="post-actions">\n' +
        '            <span class="post-action">\n' +
        '                <a onclick="like(' + id + ')" href="#" class="action-link">\n' +
        '                    Like\n' +
        '                </a>\n' +
        '            </span>\n' +
        '            <span class="post-action">\n' +
        '                <a onclick="dislike(' + id + ')" href="#" class="action-link">\n' +
        '                    Dislike\n' +
        '                </a>\n' +
        '            </span>\n' +
        '            <span class="post-action">\n' +
        '                <a onclick="respondTo(' + id + ')" href="#" class="action-link">\n' +
        '                    Riposter\n' +
        '                </a>\n' +
        '            </span>\n' +
        '            <span class="post-action">\n' +
        '                <a onclick="repost(' + id + ')" href="#" class="action-link">\n' +
        '                    <span class="far fa-redo-alt"></span>\n' +
        '                </a>\n' +
        '            </span>\n' +
        '            <span class="post-action">\n' +
        '                <a onclick="report(' + id + ')" href="#" class="action-link">\n' +
        '                    Signaler\n' +
        '                </a>\n' +
        '            </span>\n' +
        '        </div>\n' +
        '    </div>';
    return text;
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
            var author;
            var content;
            var date;
            var id;
            var result = JSON.parse(request.responseText);
            text += "<h2 class=\"selected-hashtag-name\">" +
                        #hashtag +
                    "</h2>";
            forEach(result as r)
            {
                author = r['author'];
                content = r['content'];
                date = r['timestamp'];
                id = r['id'];
                text += postToHtml(author, content, date, id);
            }
            document.getElementById('div.post-feed').innerHTML = text;
        }
        else
        {
            alert("Va te faire foutre.");
        }
    };
    request.open("/api/trends/fromTag?tag=" + hashtag);
    request.send();
    return false;
}

function getHashtags()
{
    var request =  new XMLHttpRequest();
    request.onreadystatechange = function()
    {
        if (this.readyState == 4 && this.status == 200)
        {
            var result = JSON.parse(request.responseText);
            var text = '';
            forEach(result as r)
            {
                text += "<a href='#' class='hashtag-link' onclick='getPostsFromHashtag("+ r +")'>" +
                            r +
                        "</a>";
            }
            document.getElementById('div.hashtag-in-list').innerHTML = text;
        }
        else
        {
            alert("Va te faire foutre.");
        }
    };
    request.open("/api/trends/hashtag");
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
            var text = '';
            var author;
            var content;
            var date;
            var id;
            var result = JSON.parse(request.responseText);
            forEach(result as r)
            {
                author = r['author'];
                content = r['content'];
                date = r['timestamp'];
                id = r['id'];
                text += postToHtml(author, content, date, id);
            }
            document.getElementById('div.post-feed').innerHTML = text;
        }
    };
    request.open("/api/trends/toplikes");
    request.send();
    return false;

}
