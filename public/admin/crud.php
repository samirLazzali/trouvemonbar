<?php
session_start();
header('Content-type: text/html; charset = utf-8');
include('../includes/config.php');

include('../includes/functions.php');
actualiser_session();

$titre = '';
include('../includes/top.php');
?>
    

<br />

<center>                
<a href="add.php">Ajouter un utilisateur</a>
                
<br/>
<p></p>


<table cellspacing="0" cellpadding="0" style="border:solid 1px black; font-family:verdana; font-size:12px;">
  <thead>
    <tr style="background-color:purple;">
      <th style="width:50px;">id_user</th>
      <th style="width:150px;">login</th>
      <th style="width:250px;">mail</th>
      <th style="width:150px;">telephone</th>
      <th style="width:100px;">edition</th>
      <th style="width:100px;">suppression</th>
      <th style="width:18px;"></th>
    </tr>
  </head>

  <tbody>

    <?php
    $dbName = getenv('DB_NAME');
    $dbUser = getenv('DB_USER');
    $dbPassword = getenv('DB_PASSWORD');
    $connexion = new PDO("pgsql:host=postgres user=$dbUser dbname=$dbName password=$dbPassword");
    ?>


    <tr>
      <td colspan="7">
        <div style="height:300px; overflow:auto; border-top:solid 1px black; border-bottom:solid 1px black;">
          <table cellspacing="0" cellpadding="0" style="color:midnightblue; font-family:verdana; font-size:12px; text-align:center;">

                <?php
                $requete='SELECT id_user, login, mail,password,phone_number FROM Utilisateur ORDER BY id_user DESC';
                foreach ($connexion->query($requete) as $data) { 
    
                    echo '<tr><td style="width:50px;">' . $data['id_user'] . '</td>';
                    echo '<td style="width:150px;">' . $data['login'] . '</td>';
                    echo '<td style="width:250px;">' . $data['mail'] . '</td>';
                    echo '<td style="width:150px;">' . $data['phone_number'] . '</td>';


                    echo '<td style="width:100px;">'.'<a href="edit.php?id_modif=' . $data['id_user'] . '">Modifier</a>'.'</td>';
                    echo'<td style="width:100px;">'.'<a class="btn btn-danger" href="delete.php?id_suppr=' . $data['id_user'] . ' ">Supprimer</a>'.'</td></tr>';}
                 ?>          </table>
        </div>
      </td>
    </tr>
  </tbody>
</table> 
</center>
<?php
include('../includes/bottom.php');
?>