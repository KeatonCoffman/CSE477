<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/20/17
 * Time: 1:30 PM
 */

namespace Nurikabe;


class Users extends Table
{
    protected $site;
    //private $validateTable;


    public function __construct(Site $site) {
        parent::__construct($site, "user");
    }


    public function login($email, $password) {

        $sql =<<<SQL
SELECT * from $this->tableName
WHERE email=? 
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($email));
        if($statement->rowCount() === 0) {
            return null;
        }

        $row = ($statement->fetch(\PDO::FETCH_ASSOC));


        $hash = $row['password'];
        $salt = $row['salt'];


        if($hash !== hash("sha256", $password . $salt)) {
            return null;
        }

        return new User($row);


    }



    public static function randomSalt($len = 16) {
        $bytes = openssl_random_pseudo_bytes($len / 2);
        return bin2hex($bytes);
    }


    public function createUser(User $user, $pass) {

        $salt = $this->randomSalt();
        $hashed_password = hash("sha256", $pass . $salt);

        $sql = <<<SQL
INSERT INTO {$this->getTableName()}(name, email, password, salt) 
VALUES (?, ?, ?, ?);
SQL;
        $name = $user->getName();
        $email = $user->getEmail();


        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($name,$email,$hashed_password,$salt));


        // Immediately delete validator from p2_validators table

        $validations = new Validators($this->site);
        $validator = $validations->getTableName();

        $sql = <<<SQL
DELETE FROM $validator
WHERE email=?;
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($email));

    }



    public function save($email, $game){

        $game_str = json_encode($game->grid);

        $game_table = "p2_games";
        $user_table = "p2_user";

        $sql=<<<SQL
SELECT *
FROM $user_table
WHERE email = ?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $row = $statement->execute(array($email));

        $user_id = $row['id'];

        $sql = <<<SQL
INSERT INTO $game_table (game, userid) 
VALUES (?, ?);
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($game_str,$user_id));
    }



    public function load($mode, $email){


    }




    public function email_exists($email) {

        $table = $this->getTableName();

        $sql=<<<SQL
SELECT *
FROM $table
WHERE email = ?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($email));
        if($statement->rowCount() === 0) {
            return false;
        }
        return true;

    }


}