//boolean for the diffrent required parts
let title_ok = false;
let duration_ok = false;
let schedule_ok = false;
let desc_ok = false;


//called at the end of each function
//unlok the submit button when all conditions are met
function unlock_submit()
{
    let submit = document.getElementById("submit");
    if(title_ok && duration_ok && schedule_ok && desc_ok) {
        submit.disabled = false;
    }

    else
        submit.disabled = true;
}

//check if title is not empty
function check_title() {

    let title = document.getElementById("gamename").value;
    if(title === "")
    {
        document.getElementById("warning_gamename").innerHTML = "Le nom de la table ne peut pas être vide";
        title_ok = false;
    }
    else
    {
        document.getElementById("warning_gamename").innerHTML = "";
        title_ok = true;
    }
    unlock_submit();
}

//check if duration is not empty and > 0
function check_duration() {
    let duration = document.getElementById("duration").value;
    if(duration === "")
    {
        document.getElementById("warning_duration").innerHTML = "La durée doit être renseignée";
        duration_ok = false;
    }
    else if(duration <= 0) {
        document.getElementById("warning_duration").innerHTML = "La table doit durer au moins une séance";
        duration_ok = false;
    }
    else
    {
        document.getElementById("warning_duration").innerHTML = "";
        duration_ok = true;
    }
    unlock_submit();
}

//called once we press the add schedule button once
function check_schedule(){
    schedule_ok = true;
    unlock_submit();
}

function check_desc() {
    let desc = document.getElementById("gamedesc").value;
    if(desc === "") {
        document.getElementById("warning_gamedesc").innerHTML = "La table doit comporter une description";
        desc_ok = false;
    }
    else
    {
        document.getElementById("warning_gamedesc").innerHTML = "";
        desc_ok = true;
    }
    unlock_submit();
}

















