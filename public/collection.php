<?php
if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}
require_once "db.php";
require_once 'fonctions.php';

$str = '';

if ($_POST != NULL && $_POST['action'] != NULL)
{
    if ($_POST['action'] == "create")
    {
        logged_only();

        if (!preg_match('/^[a-z0-9_]+$/',$_POST['name'])) $str = "Merci d'entrer un nom sans caractères spéciaux";
        else
        {
            $tablename = $_SESSION['auth']['username'] . "§" . $_POST['name'];
            $result = $pdo->query("SELECT EXISTS (SELECT * FROM information_schema.tables WHERE
                                     table_name = '" . $tablename . "');")->fetch();

            if ($result['exists'] == 1) $str = "Cette collection existe déjà !";
            else {
                $result = $pdo->query('CREATE TABLE "' . $tablename . '"
                        (
                          id VARCHAR REFERENCES cartes(id),
                          quantity INTEGER,
                          id_owner VARCHAR REFERENCES users(id),
                          id_user VARCHAR REFERENCES users(id)
                        );');
                if ($result) $str = "La collection " . $_POST['name'] . " a été créée !";
                else $str = "Il y a eu un erreur lors de la création de la collection " . $_POST['name'] . " :(";
            }
        }
    }
    elseif ($_POST['action'] == "search")
    {
        $tablename = $_POST['name'];
        $result = $pdo->query("SELECT table_name FROM information_schema.tables WHERE
                                     table_name LIKE '%§%".$tablename."%'
                                     OR table_name LIKE '%".$tablename."%§%';");

        $str = "<table><tr><td class='table_collec'>Auteur</td><td class='table_collec'>Collection</td></tr>";
        while ($row = $result->fetch())
        {
            if ($row['table_name'] == "cartes" or $row['table_name'] == "users")
            {
                $str = "access_denied";
                break;
            }
            else
            {
                $parts = explode("§", $row['table_name']);
                $str .= "<tr><td class='table_collec'>" . $parts[0] . "</td><td class='table_collec'><a href = 'view_collection.php?author=" . $parts[0] . "&name=" . $parts[1] . "'>" . $parts[1] . "</a></td></tr>";
            }
        }
        if ($str != "access_denied") $str .= "</table>";
        else $str = "Vous n'avez pas accès à cette collection !";
    }
    elseif ($_POST['action'] == "delete")
    {
        $tablename = $_SESSION['auth']['username']."§".$_POST['name'];
        if ($tablename == "users" or $tablename == "cartes")
        {
            $str = "access denied";
        }
        else
        {
            $result = $pdo->query("SELECT table_name FROM information_schema.tables WHERE
                                     table_name = '".$tablename."';");
            $row = $result->fetch();

            if ($row) $pdo->query('DROP TABLE "'.$tablename.'";');
            else $str = "nothing";
        }
        if ($str == "access denied") $str = "Vous n'avez pas accès à cette collection !";
        elseif ($str == "nothing") $str = "Vous ne possédez aucune collection de ce nom...";
        else $str = "La collection ".$_POST['name']." a été supprimée !";
    }
}
page_top("Filigrane | Collections");
?>

<div class="row">
    <div class="column side" id="left_col" style="background-color:#000000;"><img src="Pictures/Sidebar_1.png"></div>

    <div class="column middle" style="background-color:#bbb;">
        <h1>Collections</h1>
        <form method="post">
            <div class="search" id="search_left">
                <select name="action">
                    <option value="search" selected="selected">Chercher une collection</option>
                    <option value="create">Créer une collection</option>
                    <option value="delete">Supprimer une collection</option>
                </select>
                <input type="text" name="name"/><br/>
                <input type="submit" value="OK" id="collec_button"/><br/>
            </div>
    </form>
        <br/>
        <div class ="search" id="result_collec">
    <?php echo $str ?>
        </div>
    </div>


<div class="column side" id="right_col" style="background-color:#000000;"><img src="Pictures/Sidebar_2.png"></div>
</div>

<div class="footer">
    <p>"Les decks contrôle ne sont qu'une illusion" - Karn, 2018</p>
</div>

</body>
</html>