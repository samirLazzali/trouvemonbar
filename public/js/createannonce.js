function toggletextepayant(){
  Objp=document.getElementById('zonetextepaying');
	Objs=document.getElementById('zonetexteswap');
	Objp.style.display="block";
	Objs.style.display="none";
}

function toggletexteswap(){
  Objp=document.getElementById('zonetextepaying');
	Objs=document.getElementById('zonetexteswap');
	Objp.style.display="none";
	Objs.style.display="block";
}

function togglecacher(){
  Objp=document.getElementById('zonetextepaying');
	Objs=document.getElementById('zonetexteswap');
	Objp.style.display="none";
	Objs.style.display="none";
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
