//list of files so far
let files = [];

//name of currently selected file
let select = "";

updateselect();

//update the display of files
function update_files_display()
{
    let text = "";

    for(let file of files)
    {
        text += "<li>" + file.name +"</li>";
    }

    document.getElementById("listfiles").innerHTML = text;
}

//add a file to the form and update displau
function add_file()
{
    if(select !== "") {
        //create a new object that holds the selected values
        let new_file = {};
        new_file.id = document.getElementById("userfiles").value
        new_file.name = select;

        //add this to a hidden field in the html
        let fd = document.forms['form_game'];

        let input = document.createElement("input");
        input.setAttribute("type", "hidden");
        input.setAttribute("name", "files[]");
        input.setAttribute("value", JSON.stringify(new_file));

        fd.appendChild(input);
        files.push(new_file);
        update_files_display();
    }

}

//update name of currently selected file
function updateselect() {
    let selector = document.getElementById("userfiles");
    select = selector.options[selector.selectedIndex].innerHTML;
}