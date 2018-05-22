	var sous_menu = document.getElementById('sous_menu');
	
	var score = document.getElementsByClassName('parametres_pos')[0];
	
	sous_menu.style.left = score.offsetLeft + 'px';
	sous_menu.style.top = (score.offsetTop + 60) + 'px';
	
	var display_menu = false;
		
	score.onclick = function() {
		if (display_menu) {
			display_menu = false;
			sous_menu.style.display = 'none';
			score.style.background = '#f8f8f8';
		}else {
			display_menu = true;
			sous_menu.style.display = 'block';
			score.style.background = '#aacbff';
		}
	}
	
	
	
	
	
	window.onresize = function() {
		sous_menu.style.left = score.offsetLeft + 'px';
		sous_menu.style.top = (score.offsetTop + 60) + 'px';
	}
