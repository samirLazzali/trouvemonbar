//name of currently selected system
let select = "";
let selector = document.getElementById("select_system");
//all selected systems
let systems = [];
update_select();

//update the display of systems
function update_systems_display()
{
    let text = "";

    for(let system of systems)
    {
        text += "<li class='list-group-item'>" + system.name +"</li>";
    }

    document.getElementById("list_systems").innerHTML = text;
}

function add_system()
{
    //if it is not already added
    if(selector.options[selector.selectedIndex].disabled === false) {
        //create a new object that holds the selected values
        let new_system = {};
        new_system.id = document.getElementById("select_system").value
        new_system.name = select;

        //add this to a hidden field in the html
        let fd = document.forms['edit_profile'];

        let input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "gamesystems[]");
        input.setAttribute("value", JSON.stringify(new_system));

        fd.appendChild(input);
        systems.push(new_system);
        update_systems_display();
        selector.options[selector.selectedIndex].disabled = true;
    }
}

//update name of currently selected system
function update_select() {
    select = selector.options[selector.selectedIndex].innerHTML;
}















