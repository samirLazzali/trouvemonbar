<?php

require __DIR__ . '/database.php';


class Library
{

    /*
     * Register New User
     *
     * @param $name, $email, $username, $password
     * @return ID
     * */
    public function Register($name, $email, $username, $password, $member)
    {
        try {
            $db = DB();
            $query = $db->prepare("INSERT INTO users(name, email, username, password, role) VALUES (:name,:email,:username,:password,:member)");
            $query->bindParam("name", $name, PDO::PARAM_STR);
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->bindParam("username", $username, PDO::PARAM_STR);

            $enc_password = hash('sha256', $password); // voir function login

            $query->bindParam("password", $password, PDO::PARAM_STR);
            $query->bindParam("member", $member, PDO::PARAM_STR);
            $query->execute();
            return $db->lastInsertId();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    /*
     * Change the specified field of a user with value
     *
     * @param $field, $value, $user_id
     * */
    public function changeField($field, $value, $user_id){
        try {
            $db = DB();
            if($field == "username"){
                $query = $db->prepare("UPDATE users SET username = :value WHERE user_id=:user_id");
            }
            elseif ($field == "email") {
                $query = $db->prepare("UPDATE users SET email = :value WHERE user_id=:user_id");
            }
            elseif ($field == "name") {
                $query = $db->prepare("UPDATE users SET name = :value WHERE user_id=:user_id");
            }
            elseif ($field == "password") {
                //$value = hash('sha256', $value);
                $query = $db->prepare("UPDATE users SET password = :value WHERE user_id=:user_id");
            }
            elseif($field == "address"){
                $query = $db->prepare("UPDATE users SET address = :value WHERE user_id=:user_id");
            }
            elseif($field == "city"){
                $query = $db->prepare("UPDATE users SET city = :value WHERE user_id=:user_id");
            }
            elseif($field == "country"){
                $query = $db->prepare("UPDATE users SET country = :value WHERE user_id=:user_id");
            }
            elseif($field == "zip"){
                $query = $db->prepare("UPDATE users SET zip = :value WHERE user_id=:user_id");
            }
            elseif($field == "bio"){
                $query = $db->prepare("UPDATE users SET bio = :value WHERE user_id=:user_id");
            }



            else{
                exit();
            }
            $query->bindParam("user_id", $user_id, PDO::PARAM_INT);
            $query->bindParam("value", $value, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    /*
     * Check Username
     *
     * @param $username
     * @return boolean
     * */
    public function isUsername($username)
    {
        try {
            $db = DB();
            $query = $db->prepare("SELECT user_id FROM users WHERE username=:username");
            $query->bindParam("username", $username, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    /*
     * Check Email
     *
     * @param $email
     * @return boolean
     * */
    public function isEmail($email)
    {
        try {
            $db = DB();
            $query = $db->prepare("SELECT user_id FROM users WHERE email=:email");
            $query->bindParam("email", $email, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    /*
     * Login
     *
     * @param $username, $password
     * @return $mixed
     * */
    public function Login($username, $password)
    {
        try {
            $db = DB();
            $query = $db->prepare("SELECT user_id FROM users WHERE (username=:username OR email=:username) AND password=:password");

            $query->bindParam("username", $username, PDO::PARAM_STR);

            $enc_password = hash('sha256', $password);   //utilisation en revoir pour l'import des données admin

            $query->bindParam("password", $password, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_OBJ);
                return $result->user_id;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    /*
     * Check if user is logged
     *
     */
    public function logged(){
        if(isset($_SESSION['user_id'])){
            return $_SESSION['user_id'];
        }else{
            return false;
        }
    }


    public function getRole($user_id)
    {
        try {
            $db = DB();
            $query = $db->prepare("SELECT role FROM users WHERE user_id=:user_id");
            $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                $result = $query->fetch(PDO::FETCH_OBJ);
                return $result->role;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    /*
     * get User Details
     *
     * @param $user_id
     * @return $mixed
     * */
    public function UserDetails($user_id)
    {
        try {
            $db = DB();
            $query = $db->prepare("SELECT user_id, name, username, email, address, city, country, zip, bio FROM users WHERE user_id=:user_id");
            $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
            $query->execute();
            if ($query->rowCount() > 0) {
                return $query->fetch(PDO::FETCH_OBJ);
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    /*
     * delete a user from the database
     *
     *@param $user_id
     * */
    public function deleteUser($user_id){
        try{
            $db = DB();
            $query = $db->prepare("DELETE FROM users WHERE user_id=:user_id");
            $query->bindParam("user_id", $user_id, PDO::PARAM_STR);
            $query->execute();
        }
        catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function alertMessage($changed, $change_error, $change_object){
        if($changed == true){
            echo "<div class='alert alert-success'>$change_object changé avec succès" . "</div>";
        }
        else if($change_error!= ""){
            echo "<div class='alert alert-danger'>Erreur : " . $change_error . "</div>";
        }
    }

    public function getNutrimentList($Q){
        try{
            $db = DB();
            $nutrimentList = $db->query('SELECT n_name FROM "Nutriments"');
            $T=[];
            while($nutriment = $nutrimentList->fetch()){
                if(!in_array($nutriment['n_name'], $Q)){
                    $T[] = $nutriment['n_name'];
                }
            }
            return $T;
        }
        catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getCountAliments(){
        try{
            $db = DB();
            $query = $db->query('SELECT count(*) FROM "Aliments"');
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result->count;
        }
        catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getCountNutriments(){
        try{
            $db = DB();
            $query = $db->query('SELECT count(*) FROM "Nutriments"');
            $result = $query->fetch(PDO::FETCH_OBJ);
            return $result->count;
        }
        catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getNutriMaxList($db){
        $Nutri_Max = $db->query('
        SELECT nutri_id, MAX(quantity) AS max
        FROM "Aliments_Nutriments"
        GROUP BY nutri_id
        ORDER BY nutri_id
        ');

        for($i=1; $i<=$this->getCountNutriments(); $i++){
            $result = $Nutri_Max->fetch(PDO::FETCH_OBJ);
            $T[] = $result->max;
        }

        return $T;
    }

    public function getNutriQtyList($db){
        $Nutri_Max = $db->query('
        SELECT nutri_id, quantity
        FROM "Aliments_Nutriments"
        GROUP BY nutri_id
        ORDER BY nutri_id
        ');

        for($i = 1; $i<=getCountNutriments(); $i++){
            $result = $query->fetch(PDO::FETCH_OBJ);
            $T[] = $result->quantity;
        }

        return $T;
    }

    public function getNutri_id($n_name){
        try{
            $db = DB();
            $n_name = "'".$n_name."'";
            $query = $db->query('SELECT nutri_id FROM "Nutriments" WHERE n_name='."$n_name");
            if ($query->rowCount() > 0) {
                return $query->fetch(PDO::FETCH_OBJ)->nutri_id;
            }
        }
        catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function doShit(){
        echo shit;
    }

    public function getAlim_name($id){
        try{
            $db = DB();
            $query = $db->query('SELECT a_name FROM "Aliments" WHERE alim_id='."$id");
            if ($query->rowCount() > 0) {
                return $query->fetch(PDO::FETCH_OBJ)->a_name;
            }
        }
        catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getNutriScore($coeff){
        try{
            $db = DB();

            $Alim_Nutri = $db->query('
            SELECT alim_id, nutri_id, a_name,  n_name, quantity
            FROM "Aliments_Nutriments" an NATURAL JOIN "Aliments" a 
                                          NATURAL JOIN "Nutriments" n 
            ORDER BY (alim_id, nutri_id)
            ');

            $Nutri_Max = $this->getNutriMaxList($db);
            $nbAlim = $this->getCountAliments();
            $nbNutri = $this->getCountNutriments();
            $T=[];

            for($i=0; $i<$nbAlim; $i++){
                $score = 0.0;
                for($j=0; $j<$nbNutri; $j++){
                    $score = $score + $coeff[$j]*($Alim_Nutri->fetch(PDO::FETCH_OBJ)->quantity/$Nutri_Max[$j]) / $nbAlim;
                }
                $T[$this->getAlim_name($i+1)] = $score;
            }

            return $T;
        }
        catch (PDOException $e) {
            exit($e->getMessage());
        }

    }

    public function isAliment($alim)
    {
        try {
            $db = DB();
            $query = $db->query('SELECT a_name FROM "Aliments" WHERE a_name='."'".$alim."'");
            if ($query->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function addAlim($name, $proteine, $glucide, $lipide, $energie, $fibre){
        try {
            $db = DB();
            $queryAddAlim = $db->query('INSERT INTO "Aliments"(a_name) VALUES ('."'".$name."')");
            $id = $db->lastInsertId();
            $queryAddAlimNutri1 = $db->query('INSERT INTO "Aliments_Nutriments" VALUES ('.$id.', 1, '.$proteine." )");
            $queryAddAlimNutri2 = $db->query('INSERT INTO "Aliments_Nutriments" VALUES ('.$id.', 2, '.$glucide." )");
            $queryAddAlimNutri3 = $db->query('INSERT INTO "Aliments_Nutriments" VALUES ('.$id.', 3, '.$lipide." )");
            $queryAddAlimNutri4 = $db->query('INSERT INTO "Aliments_Nutriments" VALUES ('.$id.', 4, '.$energie." )");
            $queryAddAlimNutri5 = $db->query('INSERT INTO "Aliments_Nutriments" VALUES ('.$id.', 5, '.$fibre." )");
            } 
        catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

}