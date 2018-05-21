function toggleSubscription(username)
{
    // First, we need to verify if the user currently follows username
    var currentFollowing = false;
    Array.from(document.getElementsByClassName("follow-link-" + username)).forEach(
        function(element, index, array)
        {
            if (element.classList.contains("follow-link-following"))
                currentFollowing = true;
        }
    );

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            var result = JSON.parse(this.responseText);
            Array.from(document.getElementsByClassName("follow-link-" + username)).forEach(
                function(element, index, array)
                {
                    if (!currentFollowing) {
                        element.innerHTML = "Abonné !";
                        addClass(element, "follow-link-following");
                    }
                    else
                    {
                        element.innerHTML = "S'abonner";
                        removeClass(element, "follow-link-following");
                    }
                }
            )
        }
    }
    console.log(currentFollowing);
    if (currentFollowing)
        xhttp.open("GET", "/api/user/unfollow?identifier=" + username, true);
    else
        xhttp.open("GET", "/api/user/follow?identifier=" + username, true);
    xhttp.send();
    return false;
}

var reported = false;
function reportUser(username)
{
    if (reported)
        return false;

    reported = true;

    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            console.log(this.responseText);
            var result = JSON.parse(this.responseText);
            console.log(result);
            Array.from(document.getElementsByClassName("user-report-link-" + username)).forEach(
                function(element, index, array)
                {
                    element.innerHTML = "Signalé.";
                }
            );
        }
    }
    xhttp.open("POST", "/api/user/report", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("user=" + username);
    return false;
}