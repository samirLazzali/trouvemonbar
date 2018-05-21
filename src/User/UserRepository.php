<?php
namespace User;
class UserRepository
{
    /**
     * @var \PDO
     */
    private $connection;

    /**
     * UserRepository constructor.
     * @param \PDO $connection
     */
    public function __construct(\PDO $connection)
    {
        $this->connection = $connection;
    }

    public function fetchAll()
    {
        $rows = $this->connection->query('SELECT * FROM "user"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setId($row->id)
                ->setFirstname($row->firstname)
                ->setLastname($row->lastname)
                ->setBirthday($row->birthday);

            $users[] = $user;
        }

        return $users;
    }


    public function connect($postpseudo,$postmdp)
    {

	    $pseudo = htmlspecialchars(($postpseudo)) ;
	    $mdp = htmlspecialchars(md5($postmdp)) ;
	    
	    $rows = $this->connection->query('SELECT * FROM "user"')->fetchAll(\PDO::FETCH_OBJ);	
	    $users = [];
	    $flag=0;
	   
	    foreach ($rows as $row) {		 
		    $user = new User();		 
		    $user  
			    ->setId($row->id)
			    ->setFirstname($row->firstname)	
			    ->setLastname($row->lastname)	 
			    ->setBirthday($row->birthday)
			    ->setNickname($row->nickname)
			    ->setDomicile($row->domicile)
			    ->setMdp($row->mdp);
		    
		    $users[] = $user;
	    }
	    foreach ($users as $user) {
		    $nick = $user->getNickname();
		    if ($nick == $pseudo)
		    {
			    $flag=1;
			    $pass = $user->getMdp();
			    if ($pass == $mdp )
			    {
				   $_SESSION['id'] = $user->getId();	      
				   $_SESSION['pseudo'] = $pseudo;
				   $_SESSION['firstname'] = $user->getFirstname();
				   $_SESSION['lastname'] = $user->getLastName();
				   $_SESSION['domicile'] = $user->getDomicile();
				   $_SESSION['birthday'] = $user->getBirthday();
				   header('Location:Accueil.php');
			    }
			    else 
			    {
				    echo "<center><p class=\"alert\">Mauvais mot de passe !</p></center>";
			    }
		    }
	    }
		
	    if ($flag==0){
		    echo "<center><p class=\"alert\">Mauvais pseudo !</p></center>";
	    }
    }

    public function signin($postpseudo,$postmdp,$postmdp_verif)
    {	       
        $pseudo = htmlspecialchars($postpseudo) ;    
        $mdp = htmlspecialchars(md5($postmdp)) ;            
        $mdp_verif = htmlspecialchars(md5($postmdp_verif)) ;
        $userlevel = 1 ;                              
         
	if( $mdp == $mdp_verif )  // Vérification Mdp
	{
		$stmt2 = $this->connection->query('SELECT COUNT(*) FROM "user" WHERE nickname='.$this->connection->quote($pseudo)); // Vérification de l'unicité du pseudo
                        $nb_rows2= $stmt2->fetchColumn();
 
                        if($nb_rows2 != 1)
                        {      
				$req=$this->connection->prepare('INSERT INTO "user"(nickname,mdp,id_groupe) VALUES (:pseudo,:mdp,:id_groupe)');
				
				$req->execute(array(
                                'pseudo' => $pseudo,
                                'mdp' => $mdp,
                                'id_groupe'=> $userlevel )) ;

				echo '<center><h3> Vous êtes maintenant inscrit ! </h3></center> ';
				echo '<center><h4> Vous pouvez dès à présent vous <a href="connexion.php">connecter<a></h4></center>';
			}
			else 
			{ 

				echo " <center><p class=\"alert\">Le pseudo est déja utilisé !</p></center>" ; 
			}
	}
	else 
	{ 
		echo "<center><p class=\"alert\">Les deux mots de passe entrés sont différents !</p></center>" ;
	}
    
    }

    public function modif($postfirstname,$postlastname,$postdomicile,$postbirthday,$postoldmdp,$postnewmdp,$postnewmdpverif){
	    if ($postfirstname != null)
	    {
		    $firstname = htmlspecialchars($postfirstname) ;
		    if ($firstname != $_SESSION['firstname'])
		    {
			    $req=$this->connection->prepare('UPDATE "user" SET firstname = :new WHERE nickname = :old');
			    $req->execute(array(':new' => $firstname,':old' => $_SESSION['pseudo']));


			    $_SESSION['firstname']=$firstname;
				
		    }


	    }
	    if ($postlastname != null)
	    {
		    $lastname = htmlspecialchars($postlastname) ;
		    if ($lastname != $_SESSION['lastname'])
		    {
			    $req=$this->connection->prepare('UPDATE "user" SET lastname = :new WHERE nickname = :old');
			    $req->execute(array(':new' => $lastname,':old' => $_SESSION['pseudo']));


			    $_SESSION['lastname']=$lastname;
				
		    }


	    }
	    if ($postdomicile != null)
	    {
		    $domicile = htmlspecialchars($postdomicile) ;
		    if ($domicile != $_SESSION['domicile'])
		    {
			    $req=$this->connection->prepare('UPDATE "user" SET domicile = :new WHERE nickname = :old');
			    $req->execute(array(':new' => $domicile,':old' => $_SESSION['pseudo']));


			    $_SESSION['domicile']=$domicile;
				
		    }


	    }
	    if ($postbirthday != null)
	    {
		    /* $domicile = htmlspecialchars($postdomicile) ;*/
		    if ($postbirthday != $_SESSION['birthday'])
		    {
			    echo "$postbirthday";
			    $req=$this->connection->prepare('UPDATE "user" SET birthday = :new WHERE nickname = :old');
			    $req->execute(array(':new' => $postbirthday ,':old' => $_SESSION['pseudo']));


			    $_SESSION['birthday']=$postbirthday;
				
		    }


	    }

	    if ($postoldmdp!=null || $postnewmdp!=null || $postnewmdpverif!=null)
	    {
		    if ($postoldmdp!=null && $postnewmdp!=null  && $postnewmdpverif!=null)
		    {
			    //Acquisition des données
			    $oldmdp = htmlspecialchars(md5($postoldmdp)) ; 
			    $newmdp = htmlspecialchars(md5($postnewmdp)) ;  
			    $newmdpverif = htmlspecialchars(md5($postnewmdpverif)) ;  
			    $query=$this->connection->prepare('SELECT mdp FROM "user" WHERE nickname = :pseudo');
			    $query->execute(array(':pseudo'=> $_SESSION['pseudo']));
			    $mdp = $query->fetchColumn();

			    //Vérif Mdp

			    if ($oldmdp == $mdp)
			    {
				    if ($newmdp == $newmdpverif)
				    {
					    $req=$this->connection->prepare('UPDATE "user" SET mdp = :new WHERE nickname = :old');
					    $req->execute(array(':new' => $newmdp,':old' => $_SESSION['pseudo']));
					    echo "<center>Le mot de passe a bien été modifié ! </center>";

				    }
				    else
				    {
					    echo "<center><p class=\"alert\">Le mot de passe n'a pas pu être changé : Les mots de passe entrés sont différents !</p></center>";

				    }
			    }
			    else
			    {
				    echo "<center><p class=\"alert\">Le mot de passe n'a pas pu être changé : Mauvais mot de passe !</p></center>";
			    }
			    

		    }
		    else
		    {
			     echo "<center><p class=\"alert\">Vous n'avez pas rempli tous les champs nécessaire à la modification du mot de passe !</p></center>";

		    }
	    }




    }

}
