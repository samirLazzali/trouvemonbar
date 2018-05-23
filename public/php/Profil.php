<?php
/**
 * Created by PhpStorm.
 * User: chenzeyu
 * Date: 2018/5/3
 * Time: 09:19
 */
include("Modele.php");
include("Vue.php");
verif_authent();
entete();
bandeau();
container();


$uname = $_SESSION['nomuser'];
$testdnais = null ;
$testage = null;
$connection = db_connect();
$users = db_fetchAll_Users($connection);
foreach ($users as $user){
    if (($testuname=$user->getPseudo()) == $uname){
        $testdnais = date_format($user->getBirthday(),"Y-m-d");
        $testage = $user->getAge();
        //echo "TRUE IS $testage";
    }
}


echo "
    <h1>Welcome to SCANATION,".$uname."</h1>
    <br/>
    <h2>Votre date de naissance : ".$testdnais."</h2>
    <h2>Votre age : ".$testage."</h2>
";
?>

<br/><br/>
<button type="button" id="editbutton" class="btn1" style="display: inline-block;" onclick="editshow()">Edit your password</button>
<br/><br/>

<br/><br/>
<a href="Update.php"><button type="button" class="btn1" style="display: inline-block;" >Edit your birthday</button></a>
<br/><br/>

<form action="modifmdp.php" method="post" class="mdpedit" style="display: none">


    <label for="entry1" >Nouveau mot de passe</label></td>
    <input name="entry1" id="entry1" type="password" style="display: inline-block" required /><br/></td>

    <label for="entry2" >Encore une fois</label>
    <input name="entry2" id="entry2" type="password" style="display: inline-block" required  /><br/>

    <input type="submit" value="Change password" id="submit" class="btn1"/>
    <input type="reset" value="Clear" class="btn1"/>

</form>

<br/><br/>
<button type="button" id="cancel" onclick="edithide()" class="mdpedit" class="btn1" style="display: none">Cancel</button>
<br/><br/><br/>


<?php
echo '<br/>
       <button class="btn1" onclick="location.href=\'Leave.php\'" >Leave</button>
       <br/>
';
pied();
?>

<script>
    function samemdp(){

        var mdp1= document.getElementById("entry1");
        var mdp2= document.getElementById("entry2");

        if( mdp1 != mdp2)
        {

            alert("Mots de passe différents !") ;
            document.getElementById("submit").addEventListener("click", function (event){event.preventDefault()});
        }
        else
        {
            document.getElementById("warning").style.display = "none" ;
        }
    }

    function edithide(){
        var a = document.getElementsByClassName("mdpedit") ;
        var i ;

        for( i=0 ; i< a.length ; i++ )
        {
            a[i].style.display = "none" ;
        }
    }

    function editshow(){
        var a = document.getElementsByClassName("mdpedit") ;
        var i ;

        for( i=0 ; i< a.length ; i++ )
        {
            a[i].style.display = "inline-block" ;
        }
    }
</script>
