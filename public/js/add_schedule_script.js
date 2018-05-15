
//arrays with all the schedules added by the user
let oneshots = [];
let reccurents = [];

//update the display of all schedules
function update_schedule_display()
{
    let text ="";



    for(let schedule of oneshots )
    {
        document.getElementById("listSchedules").innerHTML = schedule.date;

        text+= "<li> Le " +  schedule.date + " de " + schedule.starttime + " à " + schedule.endtime + "</li>";
    }

    for(let schedule of reccurents)
    {
        text+= "<li> Le " + int_to_day( schedule.dayofweek ) + " " + int_to_rec( schedule.reccurence ) + " de " + schedule.starttime + " à " + schedule.endtime + " </li>";
    }

    document.getElementById("listSchedules").innerHTML = text;


}

//add a one-shot schedule to the form and update display
function add_one_shot()
{
    //check if values are valid
    let date = new Date( document.getElementById("dateoneshot").value);
    let starttime = document.getElementById("starttimeoneshot").value;
    let endtime = document.getElementById("endtimeoneshot").value;

    //if values are, valid, add the schedule to the list
    if( checkDate(date) &&  checkTime(starttime) && checkTime(endtime)) {

        //create a new object that holds the new schedule data
        let new_oneshot = {};
        new_oneshot.date = date.getUTCDate() + "-" + addZ( date.getUTCMonth() ) + "-" + date.getUTCFullYear();
        new_oneshot.starttime = starttime;
        new_oneshot.endtime = endtime;

        //add this to a hidden field in the html
        let fd = document.forms['form_game'];

        let input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "oneshots[]");
        input.setAttribute("value", JSON.stringify(new_oneshot));

        fd.appendChild(input);

        //add this to the schedules to display and update display
        oneshots.push(new_oneshot);
        update_schedule_display();
    }

    //todo if not, display proper error messages
}


//add a reccurent schedule to the form
function add_reccurent() {

    //check if values are ok
    let starttime = document.getElementById("starttimereccurence").value;
    let endtime = document.getElementById("endtimereccurence").value;

    //if values are ok add the schedule to the list
    if(checkTime(starttime) && checkTime(endtime)) {

        //create a new object that holds the new schedule data
        let new_reccurent = {};
        new_reccurent.dayofweek = document.getElementById("dayofweek").value;
        new_reccurent.reccurence = document.getElementById("reccurence").value;
        new_reccurent.starttime = starttime;
        new_reccurent.endtime = endtime;

        //add this to a hidden field in the html
        let fd = document.forms['form_game'];

        let input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "reccurents[]");
        input.setAttribute("value", JSON.stringify(new_reccurent));

        fd.appendChild(input);

        //add this to the schedules to display and update display
        reccurents.push(new_reccurent);
        update_schedule_display();
    }


    //todo if not display proper error message
}

/**
 * @param date Date
 * @returns {boolean} is the date complete (does not check if the date is valid)
 */
function checkDate(date)
{
    return !isNaN(date.getDay()) && !isNaN(date.getMonth()) && !isNaN(date.getFullYear());
}

/**
 * @param time String
 * @returns {boolean} is the time complete (does not check is it is valid)
 */
function checkTime(time) {
    let split = time.split(":");
    return !isNaN(split[0]) && !isNaN(split[1]);

}

/**
 * @brief return the day of week correspondign to the nomber
 * @param int
 * @returns {string}
 */
function int_to_day(int)
{
    switch (int)
    {
        case "0":
            return "dimanche";
        case "1":
            return "lundi";
        case "2":
            return "mardi";
        case "3":
            return "mercredi";
        case "4":
            return "jeudi";
        case "5":
            return "vendredi";
        case "6":
            return "samedi";
        default:
            return "error";
    }
}

/**
 * @brief returns the reccurrence corresponding to the number
 * @param int
 * @returns {string}
 * @todo make it so this function gets its data from the db
 */
function int_to_rec(int)
{
    switch (int)
    {
        case "1":
            return "toutes les semaines";
        case "2":
            return "tous les quinze jours";
        case "3":
            return "toutes les trois semaines";
        case "4":
            return "une fois par mois";
        default :
            return "error";

    }
}

/**
 * @brief add a 0 in front of the string if it is a number inferior to 10
 * @param n
 * @returns {string}
 */
function addZ(n){return n<10? '0'+n:''+n;}





























