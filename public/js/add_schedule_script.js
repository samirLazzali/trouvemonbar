
//arrays with all the schedules added by the user
let oneshots = [];
let reccurents = [];

//update the display of all schedules
function update_schedule_display()
{
    let text ="";



    for(let schedule of oneshots )
    {

        text+= "<li> Le " +  schedule.date.getDay() + "/" + (schedule.date.getMonth() + 1) + "/" + schedule.date.getFullYear()  + " de " + schedule.starttime + " à " + schedule.endtime + "</li>";
    }

    for(let schedule of reccurents)
    {
        text+= "<li> Le " + schedule.day + " " + schedule.reccurence + " de " + schedule.starttime + " à " + schedule.endtime + " </li>";
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
        let new_oneshot = {};
        new_oneshot.date = date;
        new_oneshot.starttime = starttime;
        new_oneshot.endtime = endtime;
        oneshots.push(new_oneshot);

        //todo add a hidden field with these info to the html form

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
        let new_reccurent = {};
        new_reccurent.day = document.getElementById("dayofweek").value;
        new_reccurent.reccurence = document.getElementById("reccurence").value;
        new_reccurent.starttime = starttime;
        new_reccurent.endtime = endtime;

        //todo add a hidden field with there info to the html form

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










