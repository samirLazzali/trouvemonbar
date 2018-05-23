<?php
/**
 * Connexion
 *
 * PHP Version 7.0
 *
 * @category Connexion
 * @package  Base_Connexion
 * @author   Eric COLONIA <ercol@outlook.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     localhost:8080/index.php
 */
$dbName = getenv('DB_NAME');
$dbUser = getenv('DB_USER');
$dbPassword = getenv('DB_PASSWORD');
$connection = new PDO("pgsql:host=postgres; user=$dbUser ;dbname=$dbName; password=$dbPassword");
$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/*$mysql_link=new PDO("mysql=mysql.iiens.net;dbname=assoce_manga","assoce_cmiie","arumih");
mysql_select_db("assoce_manga",$mysql_link);*/

class Execute
{
    
    private $_connection;

    /**
     * UserRepository constructor.
     *
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }
    /**
     * Execution d'une requete
     *
     * @param string $req La requete
     *
     * @return stdObject 
     */
    public function exec_sql($req)
    {
        $rows=$this->connection->query($req)->fetchAll(\PDO::FETCH_OBJ);        
        return $rows;
    }
    /**
     * Execution d'un insert into dans bakabar_logins
     *
     * @param string $login le login
     * @param string $pass  le mot de passe
     * @param int    $id    l'id
     *
     * @return void
     */
    public function insert_bakabar($login,$pass,$id)
    {
        try{
            $req=$this->connection->prepare(
                "INSERT INTO bakabar_logins 
	VALUES ($id,:login,:password) "
            );
            $req->execute(
                array(
                 "login" => $login,
                 "password" => $pass)
            );
        }
        catch(PDOException $e){
            echo"Error Insert";
        }
    }
    /**
     * Execution d'un insert into dans membre_emprunt
     *
     * @param int    $id        l'id
     * @param string $prenom    Le prenom du membre
     * @param string $nom       le nom du membre
     * @param string $pseudo    le pseudo
     * @param int    $promotion La promotion du membre
     * @param string $pass      le mot de passe
     *
     * @return void
     */
    public function insert_membre($id,$prenom,$nom,$pseudo,$promotion,$pass)
    {
        try{
            $req=$this->connection->prepare(
                "INSERT INTO membre_emprunt 
	VALUES ($id,:prenom,:nom,:pseudo,:promotion,'oui','oui',10,:password) "
            );
            $req->execute(
                array(
                "prenom" => $prenom,
                "nom" => $nom,
                "pseudo" => $pseudo,
                "promotion" => $promotion,
                "password" => $pass)
            );
        }
        catch(PDOException $e){
            echo"Error Insert";
        }

    }


}
?>


