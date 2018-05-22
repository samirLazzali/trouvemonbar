<?php
if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}
require_once "fonctions.php";
require_once "db.php";
logged_only();

if (($pdo->query("SELECT admin FROM users WHERE username = '".$_SESSION['auth']['username']."';")->fetch())['admin'] != 1)
{
    header('Location: account.php');
}
page_top("Filigrane | Compte");

$result = $pdo->query("SELECT table_name FROM information_schema.tables WHERE
                                     table_name LIKE '".$_SESSION['auth']['username']."§%';");
$str = "";
while ($row = $result->fetch())
{
    $parts = explode("§", $row['table_name']);
    $str .= "<a href = 'view_collection.php?author=" . $parts[0] . "&name=" . $parts[1] . "'>" . $parts[1] . "</a><br/>";
}
?>

<div class="row">
    <div class="column side" id="left_col" style="background-color:#000000;"><img src="Pictures/Sidebar_1.png"></div>
    <div class="column middle" style="background-color:#bbb;">
        <form name="edit_user" method="post">
            Changer d'email : <input type="text" name="newmail"/><br/>
            Changer de mot de passe :<br/>
            Ancien mot de passe : <input type="password" name="oldpass"><br/>
            Nouveau mot de passe : <input type="password" name="newpass1"><br/>
            Confirmation du nouveau mot de passe : <input type="password" name="newpass2"/><br/>
            <select name="admin">
                <option value="give">Rendre admin</option>
                <option value="take">Retirer admin</option>
                <option value="ban">Bannir un membre</option>
                <option value="del">Supprimer un membre</option>
            </select>
            <input type="text" name="username"/><br/>
            <input type="submit" value="OK"/>
        </form>
        <?php echo '<div class="search" id="result_collec">Mes collections<br/>' . $str . '</div>'?>

<?php
if(!empty($_POST)) {

    $errors = array();

    if(!empty($_POST['newmail']))
    {
        if (!filter_var($_POST['newmail'],FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Email non valide";
            echo $errors['email'];
        }
        else{
            $req=$pdo->prepare("SELECT email FROM users WHERE email = '".$_POST['newmail']."';");
            $req->execute();
            $user=$req->fetch();
            if($user){
                $errors['email']='Ce mail est déjà pris';
                echo $errors['email'];
            }
        }
    }

    if(!empty($_POST['newpass1']) or !empty($_POST['newpass2']))
    {
        if (empty($_POST['oldpass']))
        {
            $errors['password'] = "Vous devez entrer votre ancien mot de passe";
            echo $errors['password'];
        }
        else
        {
            $req = $pdo->prepare("SELECT password FROM users WHERE id = '".$_SESSION['auth']['id']."';");
            $oldpass = $req->fetch()['password'];

            if (password_verify($_POST['oldpass'], $oldpass))
            {
                $errors['password'] = "Ancien mot de passe incorrect";
                echo $errors['password'];
            }
            else
            {
                if (empty($_POST['newpass1']) or empty($_POST['newpass2']))
                {
                    $errors['password'] = "Vous devez confirmer votre nouveau mot de passe";
                    echo $errors['password'];
                }
                else
                {
                    if ($_POST['newpass1'] != $_POST['newpass2'])
                    {
                        $errors['password'] = "Validation du nouveau mot de passe invalide";
                        echo $errors['password'];
                    }
                }
            }
        }
    }

    if (empty($errors) and (!empty($_POST['newname']) or !empty($_POST['newpass2']) or !empty(['newmail'])))
    {
        if (!empty($_POST['newpass2']))
        {
            echo "Votre mot de passe a été changé.";
            $newpass = password_hash($_POST['newpass2'], PASSWORD_BCRYPT);
            $_SESSION['auth']['password'] = $newpass;
        }
        else $newpass =  $_SESSION['auth']['password'];

        if (!empty($_POST['newmail']))
        {
            echo "Votre email a été changé de ".$_SESSION['auth']['email']." à ".$_POST['newmail'].".";
            $newmail = $_POST['newmail'];
            $_SESSION['auth']['email'] = $newmail;
        }
        else $newmail =  $_SESSION['auth']['email'];

        $req = $pdo->query("UPDATE users SET email = '".$newmail."',
                            password = '".$newpass."' WHERE id = '".$_SESSION['auth']['id']."';");
    }
    if (!empty($_POST['username'])) {
        if ($_POST['admin'] == "give") {
            $pdo->query("UPDATE users SET admin = 1 WHERE username = '" . $_POST['username'] . "';");
        } elseif ($_POST['admin'] == "take") {
            $pdo->query("UPDATE users SET admin = 0 WHERE username = '" . $_POST['username'] . "';");
        } elseif ($_POST['admin'] == "ban") {
            $pdo->query("UPDATE users SET ban = 1 WHERE username = '" . $_POST['username'] . "';");
        } elseif ($_POST['admin'] == "del") {
            $pdo->query("DELETE FROM users WHERE username = '" . $_POST['username'] . "';");
        }
    }
}
?>

    </div>
    <div class="column side" id="right_col" style="background-color:#000000;"><img src="Pictures/Sidebar_2.png"></div>
</div>

<div class="footer">
    <p>"Les decks contrôle ne sont qu'une illusion" - Karn, 2018</p>
</div>

</body>
</html>
