<?php

function ajout_champ(){
/* fonction qui prend comme arguments dans l'ordre: type, value, name, label, id, (required), (step)
    (les arguments entre parenthèses ne sont pas obligatoires, mais doivent être à l'index prévu:
    par exemple, si on veut indiquer un argument step, il faut mettre un argument required)
*/

	$tmp='';
	//label
	if(! empty(func_get_arg(3))){
		$tmp.= '<label for="'.func_get_arg(4) .'">'.func_get_arg(3).':</label>';
	}
	$tmp .= '<input type="'.func_get_arg(0).'" ';
	if(! empty(func_get_arg(4))){
		$tmp.= 'id="'.func_get_arg(4).'" ';
	}
	if(! empty(func_get_arg(1))){
		$tmp.= 'value="'.func_get_arg(1).'" ';
	}
	if(! empty(func_get_arg(2))){
		$tmp.= 'name="'.func_get_arg(2).'" ';
	}
	if(func_num_args()>5 && func_get_arg(5)){
		$tmp.= 'required="required" ';
	}
	if(func_num_args() > 6 && func_get_arg(0) == "number" && func_get_arg(6) == -1){
		$tmp .= 'step="any" ';
	}

	$tmp.='>';
	return $tmp;
}

function affiche_menu(){
	affiche_info("Connection");
	affiche_info("Veuillez rentrez votre indentifiant et votre mot de passe");
	echo '<form action="identification.php" formmethod="post" >
				Identifiant <input type="text" size="20" maxlength="18" name="identifiant"><br/>
				Mot de passe <input type="password" size="20" maxlength="18" name="password"><br/>';
	echo '<input type="submit" name="action" value="Connexion">';
	echo '</form>';
	echo "<br/>\n";
	echo '<form action="comptes.php" formmethod="post">';
	echo '<input type="submit" value="S\'inscrire">';
	echo '</form>';
}

function affiche_info($str) {
    echo '<p>'.$str.'</p>';
}

function affiche_erreur($str) {
    echo '<p class="erreur">'.$str.'</p>';
}

?>
