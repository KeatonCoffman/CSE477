<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/15/17
 * Time: 5:03 PM
 */

namespace Felis;


class Cases extends Table
{
    /**
     * Constructor
     * @param $site The Site object
     */
    public function __construct(Site $site) {
        parent::__construct($site,"case");

    }

    /**
     * Get a case by id
     * @param $id The case by ID
     * @returns Object that represents the case if successful,
     *  null otherwise.
     */
    public function get($id) {
        $users = new Users($this->site);
        $usersTable = $users->getTableName();

        $sql = <<<SQL
SELECT c.id, c.client, client.name as clientName,
       c.agent, agent.name as agentName,
       number, summary, status
from $this->tableName c,
     $usersTable client,
     $usersTable agent
where c.client = client.id and
      c.agent=agent.id and
      c.id=?
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($id));


        if($statement->rowCount() === 0) {
            return null;
        }
        return new ClientCase($statement->fetch(\PDO::FETCH_ASSOC));
    }


    public function insert($client, $agent, $number) {
        $sql = <<<SQL
insert into $this->tableName(client, agent, `number`, summary, status)
values(?, ?, ?, "", ?)
SQL;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);

        try {
            if($statement->execute(array($client,
                        $agent,
                        $number,
                        ClientCase::STATUS_OPEN)
                ) === false) {
                return null;
            }
        } catch(\PDOException $e) {
            return null;
        }

        return $pdo->lastInsertId();
    }


    public function getCases(){
        $users = new Users($this->site);
        $usersTable = $users->getTableName();
        $sql = <<<SQL
SELECT distinct c.id, c.client, client.name as clientName,
       c.agent, agent.name as agentName,
       number, summary, status
FROM $usersTable as client, $usersTable as agent
INNER JOIN $this->tableName AS c
ON c.agent=agent.id
WHERE c.client = client.id
ORDER BY status desc, number asc
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute();
        if($statement->rowCount() === 0) {
            return array();
        }
        $cases = $statement->fetchAll(\PDO::FETCH_ASSOC);

        $casesArray = array();
        foreach($cases as $case){
            $client_case = new ClientCase($case);
            array_push($casesArray,$client_case);
        }
        return $casesArray;
    }


    public function fetchID($caseNum){
        $sql = <<<SQL
SELECT id
FROM  s8_case
WHERE number=?
SQL;
        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        $statement->execute(array($caseNum));
        if($statement->rowCount() === 0) {
            return null;
        }
        $stuff = $statement->fetch(\PDO::FETCH_ASSOC);
        return $stuff['id'];
    }



    public function update($post){

        $sql = <<<sql
UPDATE $this->tableName 
SET agent = ?, number = ?, summary = ?, status = ? 
WHERE id = ?;
sql;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        try {
            $statement->execute(array($post['agent'], $post['number'],$post['summary'],$post['status'],$post['id']));
        } catch(\PDOException $e) {
            return null;
        }
        return 0;
    }

    public function deleteCase($id){
        $sql = <<<sql
DELETE FROM $this->tableName
WHERE id = ?;
sql;

        $pdo = $this->pdo();
        $statement = $pdo->prepare($sql);
        try {
            $statement->execute(array($id));
        } catch(\PDOException $e) {
            return null;
        }
        return 0;
    }

}