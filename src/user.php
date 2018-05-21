<?php
class User {
    public $id;
    public $username;
    public $email;
    public $admin;
    public $password;

    public static function getUsers($requete = "SELECT * FROM users ORDER BY id") {
        if ($requete == null || $requete == "")
            return array();

        $connection = dbConnect();
        $rows = dbQuery($connection, $requete);
        $users = [];

        foreach($rows as $row) {
            $user = new User();

	    $user->id = $row->id;
	    $user->email = $row->email;
	    $user->username = $row->username;
	    $user->admin = $row->admin;

            $users[] = $user;
        }

        return $users;
    }

    public static function getUserById($id) {
	$res = User::getUsers("SELECT * FROM users WHERE id=$id");
	if (sizeof($res) != 0)
	    return $res[0];
	return null;
    }

    public static function isAdmin($id) {
	$res = User::getUsers("SELECT * FROM users WHERE id=$id");
	if (sizeof($res) != 0)
	    return $res[0]->admin;
	return False;
    }

    public static function displayUserForm($user, $adminView) {
	include("modules/userForm.php");
    }
}
?>
