<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/13/17
 * Time: 6:53 PM
 */

namespace Felis;


class Users extends Table
{
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site, "user");
    }

    /**
     * Test for a valid login.
     * @param $email User email
     * @param $password Password credential
     * @returns User object if successful, null otherwise.
     */
    public function login($email, $password) {
        $sql =<<<SQL
SELECT * from $this->tableName
WHERE email=? and password=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($email, $password));
        if($statement->rowCount() === 0) {
            return null;
        }

        return new User($statement->fetch(\PDO::FETCH_ASSOC));


    }


    /**
     * Generate a random salt string of characters for password salting
     * @param $len Length to generate, default is 16
     * @returns Salt string
     */
    public static function randomSalt($len = 16) {
        $bytes = openssl_random_pseudo_bytes($len / 2);
        return bin2hex($bytes);
    }

    /**
     * Set the password for a user
     * @param $userid The ID for the user
     * @param $password New password to set
     */
    public function setPassword($userid, $password) {
        $password_salt = $this->randomSalt();
        $hashed_password = hash("sha256",$password . $password_salt);
        $table = $this->getTableName();

        $sql =<<<SQL
UPDATE $table set password = ? , salt = ?
WHERE id = ?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $execute_array = array($hashed_password,$password_salt,$userid);

        $statement->execute($execute_array);
    }




    /**
     * Get a user based on the id
     * @param $id ID of the user
     * @returns User object if successful, null otherwise.
     */
    public function get($id) {

        $sql =<<<SQL
    SELECT * from $this->tableName
    where id=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array($id));
        if($statement->rowCount() === 0) {
            return null;
        }
        return new User($statement->fetch(\PDO::FETCH_ASSOC));


    }



    public function getClients(){
        $sql = <<<SQL
select * from $this->tableName
where role=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array(User::CLIENT));

        return $statement->fetchAll(\PDO::FETCH_ASSOC);

    }



    public function update(User $user) {
        $invalid_user = $this->get($user->getId());

        if ($invalid_user == null){
            return false;
        }

        $sql = <<<SQL
    UPDATE $this->tableName
    SET email=?, name=?, phone=?, address=?, notes=?, role=?
    where id=? 
SQL;

        $email=$user->getEmail();
        $name =$user->getName();
        $phone =$user->getPhone();
        $address=$user->getAddress();
        $notes=$user->getNotes();
        $role=$user->getRole();
        $id=$user->getId();
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        //$return_flag = true;
        try{
            $statement->execute(array($email,$name,$phone,$address,$notes,$role,$id));
        }
        catch (\PDOException $e) {
            return false;
        }

        return true;

    }




    public function getAgents(){
        $sql = <<<SQL
select * from $this->tableName
where role=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        $statement->execute(array(User::CLIENT));

        return $statement->fetchAll(\PDO::FETCH_ASSOC);
    }



    /**
     * Create a new user.
     * @param User $user The new user data
     * @param Email $mailer An Email object to use
     * @return null on success or error message if failure
     */
    public function add(User $user, Email $mailer) {
        // Ensure we have no duplicate email address
        if($this->exists($user->getEmail())) {
            return "Email address already exists.";
        }


        // Add a record to the user table
        $sql = <<<SQL
INSERT INTO $this->tableName(email, name, phone, address, notes, joined, role)
values(?, ?, ?, ?, ?, ?, ?)
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array(
            $user->getEmail(), $user->getName(),
             date("Y-m-d H:i:s")));
        $id = $this->pdo()->lastInsertId();


        // Create a validator and add to the validator table
        $validators = new Validators($this->site);
        $validator = $validators->newValidator($id);

        // Send email with the validator in it
        $link = "http://webdev.cse.msu.edu"  . $this->site->getRoot() .
            '/password-validate.php?v=' . $validator;

        $from = $this->site->getEmail();
        $name = $user->getName();

        $subject = "Confirm your email";
        $message = <<<MSG
<html>
<p>Greetings, $name,</p>

<p>Welcome to Felis. In order to complete your registration,
please verify your email address by visiting the following link:</p>

<p><a href="$link">$link</a></p>
</html>
MSG;
        $headers = "MIME-Version: 1.0\r\nContent-type: text/html; charset=iso=8859-1\r\nFrom: $from\r\n";
        $mailer->mail($user->getEmail(), $subject, $message, $headers);
    }




    /**
     * Determine if a user exists in the system.
     * @param $email An email address.
     * @returns true if $email is an existing email address
     */
    public function exists($email) {

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