<?php
/**
 * Created by PhpStorm.
 * User: EdwinMauillon
 * Date: 21/05/2018
 * Time: 16:30
 */

namespace User;
//require '../vendor/autoload.php';


class UserManager
{
    private $db;

    public function __construct(\PDO $connection)
    {
        $this->db = $connection;
    }

    public function setDb(PDO $db)
    {
        $this->db = $db;
    }

    public function add(User $user)
    {
        $req = $this->db->prepare('INSERT INTO "user"(login, firstname, lastname, birthday, password, administrateur) VALUES (:login,:firstname,:lastname,:birthday,:password,:administrateur)');

        $req->bindValue(':login', $user->getLogin());
        $req->bindValue(':firstname', $user->getFirstname());
        $req->bindValue(':lasttname', $user->getLastname());
        $req->bindValue(':birthday', date_format($user->getBirthday(),"Y-m-d"));
        $req->bindValue(':password', $user->getPassword());
        $req->bindValue(':administrateur', $user->getAdministrateur());

        $req->execute();
    }

    public function delete(User $user){
        $this->db->exec('DELETE FROM "user" WHERE id = '.$user->getId());
    }

    public function update(User $user){
         $req = $this->db->prepare('UPDATE "user" SET firstname = :firstname, lastname = :lastname, birthday = :birthday, password =:password WHERE id = :id');

        $req->bindValue(':firstname', $user->getFirstname());
        $req->bindValue(':lastname', $user->getFirstname());
        $req->bindValue(':birthday', date_format($user->getBirthday(),"Y-m-d"));
        $req->bindValue(':password', $user->getPassword());
        $req->bindValue(':id', $user->getId());

        $req->execute();

    }

    public function get($id){
        $id = (int) $id;

        $req = $this->db->query('SELECT login, firstname,lastname, birthday, password, administrateur FROM "user" WHERE id = '.$id);

        $res = $req->fetch(\PDO::FETCH_ASSOC);
        $user = new User();
        $user
                ->setId($id)
                ->setLogin($res['login'])
                ->setFirsname($res['firstname'])
                ->setLastname($res['lastname'])
                ->setBirthday(new \DateTime($res['birthday'])) 
                ->setPassword($res['password']);
                ->setAdministrateur($res['administrateur']);

        return $user;

    }

}