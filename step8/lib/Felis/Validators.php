<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/17/17
 * Time: 1:42 PM
 */

namespace Felis;


class Validators extends Table
{
    public function __construct(Site $site)
    {
        parent::__construct($site,"validator");
    }

    /**
     * Generate a random validator string of characters
     * @param $len Length to generate, default is 32
     * @returns Validator string
     */
    public function createValidator($len = 32) {
        $bytes = openssl_random_pseudo_bytes($len / 2);
        return bin2hex($bytes);
    }

    /**
     * Create a new validator and add it to the table.
     * @param $userid User this validator is for.
     * @return The new validator.
     */
    public function newValidator($userid) {
        $validator = $this->createValidator();

        // Write to the table
        $table = $this->getTableName();

        $sql=<<<SQL
INSERT INTO $table(userid,validator,`date`)
VALUES (?,?,?)
SQL;
        $date = date('Y-m-d H:i:s');
        //$execute_array = array($userid,$validator,$date);

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($userid, $validator, date('Y-m-d H:i:s')));

        return $validator;
    }

    /**
     * Determine if a validator is valid. If it is,
     * return the user ID for that validator.
     * @param $validator Validator to look up
     * @return User ID or null if not found.
     */
    public function get($validator) {

        $sql=<<<SQL

SQL;



    }

    /**
     * Remove any validators for this user ID.
     * @param $userid The USER ID we are clearing validators for.
     */
    public function remove($userid) {

    }
}