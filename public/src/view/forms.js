function validate_input_signup() {
    var fUsername = document.getElementById("field-username");
    var fPassword = document.getElementById("field-password");
    var fEmail = document.getElementById("field-email");

    if (fUsername.value == "")
    {
        alert("Vous devez entrer un nom d'utilisateur !");
        return false;
    }

    // La meme chose avec les autres champs

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200)
        {
            var result = JSON.parse(xhttp.responseText);
            if (result["status"] == "success")
            {
                alert("Vous etes désormais inscrit !");
            }
            else
            {
                // alert(xhttp.responseText);
                alert("Erreur : " + result["description"]);
            }
        }
    };
    xhttp.open("POST", "../api/user/new.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username=" + fUsername.value + "&password=" + fPassword.value + "&email=" + fEmail.value);

    console.log("salut");
    return false;
}