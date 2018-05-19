function hasClass(ele,cls) {
    return !!ele.className.match(new RegExp('(\\s|^)'+cls+'(\\s|$)'));
}

function addClass(ele,cls) {
    if (!hasClass(ele,cls)) ele.className += " "+cls;
}

function removeClass(ele,cls) {
    if (hasClass(ele,cls)) {
        var reg = new RegExp('(\\s|^)'+cls+'(\\s|$)');
        ele.className=ele.className.replace(reg,' ');
    }
}

function toggleBlock(id)
{
    var elt = document.getElementById(id);
    if (elt.style.display == 'none')
        elt.style.display = 'block';
    else
        elt.style.display = 'none';
    return false;
}

function timeConverter(UNIX_timestamp){
    var a = new Date(UNIX_timestamp * 1000);
    var year = a.getFullYear();
    var month = a.getMonth() + 1;
    if (month < 10)
        month = '0' + month;
    var date = a.getDate();
    if (date < 10)
        date = '0' + date;
    var hour = a.getHours() - 2;
    if (hour < 10)
        hour = '0' + hour;
    var min = a.getMinutes();
    if (min < 10)
        min = '0' + min;
    var time = date + '/' + month + '/' + year + ' ' + hour + ':' + min;
    return time;
}

Element.prototype.remove = function() {
    this.parentElement.removeChild(this);
}
NodeList.prototype.remove = HTMLCollection.prototype.remove = function() {
    for(var i = this.length - 1; i >= 0; i--) {
        if(this[i] && this[i].parentElement) {
            this[i].parentElement.removeChild(this[i]);
        }
    }
}