function toggleSubscription(username)
{
    // First, we need to verify if the user currently follows username
    var currentFollowing = false;
    Array.from(document.getElementsByClassName("follow-link-" + username)).forEach(
        function(element, index, array)
        {
            if (element.classList.contains("follow-link-following"))
            {
                currentFollowing = true;
                return;
            }
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
    if (currentFollowing)
        xhttp.open("GET", "/api/user/unfollow?identifier=" + username, true);
    else
        xhttp.open("GET", "/api/user/follow?identifier=" + username, true);
    xhttp.send();
    return false;
}