<?php


function checkpseudo($pseudo,$connection)
{
    if($pseudo == '') return 'empty';
    else if(strlen($pseudo) < 3) return 'tooshort';
    else if(strlen($pseudo) > 40) return 'toolong';

    else
    {
        $result = $connection->prepare('SELECT COUNT(membre_id) AS nbr  FROM membres WHERE membre_pseudo = ?');
        $result->execute(array($pseudo));
        $res=$result->fetch();
        global $queries;
        $queries++;

        if($res['nbr'] > 0) return 'exists';
        else return 'ok';
    }
}

function checkmdp($mdp)
{
    if($mdp == '') return 'empty';
    else if(strlen($mdp) < 4) return 'tooshort';
    else if(strlen($mdp) > 50) return 'toolong';

    else
    {
        if(!preg_match('#[0-9]{1,}#', $mdp)) return 'nofigure';
        else if(!preg_match('#[A-Z]{1,}#', $mdp)) return 'noupcap';
        else return 'ok';
    }
}

function checkmdpS($mdp, $mdp2)
{
    if($mdp != $mdp2 && $mdp != '' && $mdp2 != '') return 'different';
    else return checkmdp($mdp);
}



function checkmail($email,$connection)

{

    if($email == '') return 'empty';

    else if(!preg_match('#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#is', $email)) return 'isnt';



    else

    {

        $result = $connection->prepare('SELECT COUNT(membre_id) AS nbr FROM membres WHERE membre_mail = ?');
        $result->execute(array($email));
        $res=$result->fetch();

        global $queries;

        $queries++;


        if($res['nbr'] > 0) return 'exists';

        else return 'ok';

    }

}

function checkmailS($email, $email2)

{

    if($email != $email2 && $email != '' && $email2 != '') return 'different';

    else return 'ok';

}

function vidersession()

{

    foreach($_SESSION as $cle => $element)

    {

        unset($_SESSION[$cle]);

    }

}


?>
