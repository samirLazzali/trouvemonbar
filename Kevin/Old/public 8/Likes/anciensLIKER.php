
 /*  var xhttp;

        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
                if (this.responseText == -1){

                    var xhttp2;
                    xhttp2 = new XMLHttpRequest();
                    xhttp2.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {// 4 = request finished and response is ready, 200 = "OK"
                            alert("Tweet Disliké");
                            document.location.reload(true);
                        }
                    };
                    xhttp2.open("GET", "Likes/Dislike.php?pseudo_id=&T_id="+T_id, true);
                    xhttp2.send();
                }
                else{
                    alert("Tweet Liké");
                    document.location.reload(true);
                }
            }
        };
        xhttp.open("GET", "Likes/Liker.php?pseudo_id=>&T_id="+T_id, true);
        xhttp.send();*/