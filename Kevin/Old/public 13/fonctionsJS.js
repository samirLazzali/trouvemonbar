function Liker(T_id){
    document.location.href = 'Likes/Liker.php?T_id='+T_id;
}

function afficherCommentaire(T_id){
    document.location.href = 'tweetCommentaires.php?T_id='+T_id;
}


function suggestionHashtag(str){
    var xhttp;
    if (str.length == 0) {
        document.getElementById("hashtags").innerHTML = "";
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
            var Liste = this.responseText;
            var hashtags = Liste.split(";")
            var options = '';
            for (var i=0; i<Liste.length; i++){
                options += '<option value="'+hashtags[i]+'" />';
            }
            document.getElementById('hashtags').innerHTML = options;
        }
    };
    xhttp.open("GET", "Hashtag/suggestionHashtag.php?m="+str, true);
    xhttp.send();
}