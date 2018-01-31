<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/28/17
 * Time: 8:28 PM
 */

namespace Noir;


class Cookies extends Table
{
    public function __construct(Site $site)
    {
        parent::__construct($site, 'cookie');
    }

    /**
     * Create a new cookie token
     * @param $user User to create token for
     * @return New 32 character random string
     */
    public function create($user) {

        $sql=<<<SQL
INSERT INTO $this->tableName (user,salt,hash,date)
VALUES (?,?,?,?)
SQL;

        $stmt =  $this->pdo()->prepare($sql);
        $salt = openssl_random_pseudo_bytes(16);
        $token = $this->randomSalt(32);
        $hash = hash("sha256", $salt . $token);
        $stmt->execute(array($user, $salt, $hash, date("Y-m-d H:i:s")));


        return $token;


    }

    /**
     * Validate a cookie token
     * @param $user User ID
     * @param $token Token
     * @return null|string If successful, return the actual
     *   hash as stored in the database.
     */
    public function validate($user, $token) {
        $sql = <<<SQL
SELECT * FROM $this->tableName
WHERE user=? 
SQL;
        $statement = $this->pdo()->prepare($sql);
        $statement->execute(array($user));
        $rows = $statement->fetchAll();


        foreach ($rows as $row){
            $hash = hash("sha256", $row['salt'] . $token);

            if($hash === $row['hash']){
                return $row['hash'];
            }
        }

        return null;

    }

    /**
     * Delete a hash from the database
     * @param $hash Hash to delete
     * @return bool True if successful
     */
    public function delete($hash) {
        $sql = <<<SQL
DELETE FROM $this->tableName
WHERE hash=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($hash));
        return true;

    }

    public static function randomSalt($len = 16) {
        $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789`~!@#$%^&*()-=_+';
        $l = strlen($chars) - 1;
        $str = '';
        for ($i = 0; $i < $len; ++$i) {
            $str .= $chars[rand(0, $l)];
        }
        return $str;
    }

}