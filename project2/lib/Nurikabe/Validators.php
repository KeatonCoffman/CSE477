<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/20/17
 * Time: 1:41 PM
 */

namespace Nurikabe;


class Validators extends Table
{



    public function __construct(Site $site) {
        parent::__construct($site, "validator");
    }




    public function newValidator($name, $email) {
        $validator = $this->createValidator();


        $sql = <<<SQL
INSERT INTO {$this->getTableName()}(name, email, validator, date) 
VALUES (?, ?, ?, ?);
SQL;

        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($name, $email, $validator, date('Y-m-d H:i:s')));


        return $validator;
    }




    public function createValidator($len = 32) {
        $bytes = openssl_random_pseudo_bytes($len / 2);
        return bin2hex($bytes);
    }




    public function deleteValidator($validator_id){

        $sql = <<<SQL
DELETE FROM $this->getTableName()
WHERE  $validator_id = id;
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array());
    }



   // Should work
    public function get($validator) {
        $sql = <<<SQL
SELECT *
FROM {$this->getTableName()}
WHERE validator = ?
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($validator));

        if($statement->rowCount() === 0){
            return null;
        }
        else{
            $row = $statement->fetch(\PDO::FETCH_ASSOC);
            return $row;//email & name & id
        }
    }

    /**


    public function add($name,$email, Email $mailer) {

        /*
        if($this->email_exists($user->getEmail())) {
            return "Email address already exists.";
        }

        // Create a validator and add to the validator table
        $validators = new Validators($this->site);
        $validators->newValidator($name,$email);

    }

    **/




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