function toggletextepayant(){
  Objp=document.getElementById('zonetextepaying');
	Objs=document.getElementById('zonetexteswap');
	Objp.style.visibility="visible";
	Objs.style.visibility="hidden";
}

function toggletexteswap(){
  Objp=document.getElementById('zonetextepaying');
	Objs=document.getElementById('zonetexteswap');
	Objp.style.visibility="hidden";
	Objs.style.visibility="visible";
}

function togglecacher(){
  Objp=document.getElementById('zonetextepaying');
	Objs=document.getElementById('zonetexteswap');
	Objp.style.visibility="hidden";
	Objs.style.visibility="hidden";
}

//var modules = [document.getElementById("selectmodule1"), document.getElementById("selectmodule2"), document.getElementById("selectmodule3"), document.getElementById("selectmodule4"), document.getElementById("selectmodule5"), document.getElementById("selectmodule6")];
var modules = [document.getElementById("selectmodule1"), document.getElementById("selectmodule2"), document.getElementById("selectmodule3"), document.getElementById("selectmodule4")];

function disappear(item, index) {
    item.style.display = 'none';
}

$(".toggle").on('click', function (e) {
    modules.forEach(disappear);
    modules[this.innerHTML-1].style.display = 'block';
});
