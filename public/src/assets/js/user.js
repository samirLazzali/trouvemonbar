function subscribeToUser(username)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200)
        {
            var result = JSON.parse(this.responseText);
            Array.from(document.getElementsByClassName("follow-link-" + username)).forEach(
                function(element, index, array)
                {
                    element.innerHTML = "Abonné !";
                }
            )
        }
    }
    xhttp.open("GET", "/api/user/follow?identifier=" + username, true);
    xhttp.send();
    return false;
}