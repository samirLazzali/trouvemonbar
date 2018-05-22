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
        $rows = $this->connection->query('SELECT * FROM "users"')->fetchAll(\PDO::FETCH_OBJ);
        $users = [];
        foreach ($rows as $row) {
            $user = new User();
            $user
                ->setPseudo($row->pseudo)
                ->setMail($row->mail)
                ->setMDP($row->mdp)
                ->setAvatar($row->avatar)
                ->setDate_naissance($row->date_naissance)
                ->setNom($row->nom)
                ->setPrenom($row->prenom)
                ->setRang($row->rang);


            $users[] = $user;
        }

        return $users;
    }

    public function fetch($id_user) {
        $row = $this->connection->prepare('SELECT * FROM "users" WHERE pseudo=?;');
        $row->execute(array($id_user));
        return $row;
    }

    public function insert($identifiant,$Adresse_mail,$Mot_de_passe,$Nom,$Prenom,$Date_naissance)
    {
        $req=$this->connection->prepare('INSERT INTO users(pseudo, mail, mdp, date_naissance, nom, prenom,rang) VALUES (?,?,?,?,?,?,?);');
        $req->execute(array($identifiant,$Adresse_mail,$Mot_de_passe,$Date_naissance,$Nom,$Prenom,"0"));
    }

    public function modif($identifiant, $Adresse_mail, $Nom, $Prenom, $Date_naissance)
    {
        if ($Adresse_mail != "") {
            $req = $this->connection->prepare('UPDATE users SET mail=? WHERE pseudo=?;');
            $req->execute(array($Adresse_mail, $identifiant));
        }
        if ($Nom != "") {
            $req = $this->connection->prepare('UPDATE users SET nom=? WHERE pseudo=?;');
            $req->execute(array($Nom, $identifiant));
        }
        if ($Prenom != "") {
            $req = $this->connection->prepare('UPDATE users SET prenom=? WHERE pseudo=?;');
            $req->execute(array($Prenom, $identifiant));
        }
        if ($Date_naissance != "") {
            $req = $this->connection->prepare('UPDATE users SET date_naissance=? WHERE pseudo=?;');
            $req->execute(array($Date_naissance, $identifiant));

        }
    }

    public function modif_mdp($identifiant, $new_mdp)
    {
            $req=$this->connection->prepare('UPDATE users SET mdp=? WHERE pseudo=?;');
            $req->execute(array($new_mdp, $identifiant));
    }












}
