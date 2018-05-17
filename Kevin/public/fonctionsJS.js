
function Liker(T_id){
    document.location.href = 'Likes/Liker.php?T_id='+T_id;
}

function deja_liker(T_id){

    document.getElementById(T_id).innerHTML="Je n'aime plus";

}

function afficherCommentaire(T_id){
    document.location.href = 'tweetCommentaires.php?T_id='+T_id;
}

function tweets(){
    document.write("<div class=\"alltweets\">Derniers Tweets :<br/><br/>");
    for(var i=0; i<Tweets.length;i++){
        document.write("<div class=\"tweets\">" + Tweets[i][0] + " a tweeté à " + Tweets[i][2] +" : <br/>"+ Tweets[i][1]+"<br/>" );
        document.write("<button id=\""+ Tweets[i][3] + "\" onclick=\"Liker("+Tweets[i][3]+")\">J'aime</button> Nb de J'aimes :"+ Tweets[i][4] +"</br>");
        document.write("<button id=\"Comment\" onclick=\"afficherCommentaire("+Tweets[i][3]+")\">Afficher les commentaires</button></div><br/><br/>");

    }
    document.write("</div>");

}

/**************************************** FIN AJOUT *************************************/


function EcrireTweet(){
    var ok = document.getElementById("ok");
    ok.type="submit";
    var textarea = document.getElementById("textarea");
    textarea.style="display";
}

function ConfirmationTweet(){
    alert("Tweet Envoyé");
}

function liste_amis(){
    document.write("<div class=\"amis\">Vos amis:<br/>");
    for(var i=0;i<FriendList.length;i++){
        document.write("<a href=\"profil.php?pseudo=" + FriendList[i][1] + "\">@" + FriendList[i][1] + "</a><br/>");
    }
    document.write("</div>");
}
function liste_pseudos(){
    for(var i=0;i<AtList.length;i++){
        document.write("<option value='"+AtList[i]+"' id='"+AtList[i]+"'>");
    }
}
function surligne(champ, erreur){
    if(erreur) champ.style.backgroundColor = "#fba";
    else champ.style.backgroundColor = "";
}
function is_in_list(value){
    for(var i=0;i<AtList.length;i++){
        if(value==AtList[i]){
            return true;
        }
    }
    return false;
}
function verifPseudo(champ){
    var err = document.getElementById("err");
    var visite = document.getElementById("visite");
    if(champ.value.length==0){
        surligne(champ, false);
        err.innerHTML="";
        return true;
    }
    else if(!(is_in_list(champ.value))){
        surligne(champ, true);
        err.innerHTML="Entrez un pseudo valide";
        visite.type="hidden";
        return false;
    }
    else{
        surligne(champ, false);
        err.innerHTML="";
        visite.type="submit";
        return true;
    }
}

/* function suggestionHashtag(){

 }
 function suggestionUser(){

 }*/

