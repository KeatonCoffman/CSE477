<?php
require __DIR__ . "/../../vendor/autoload.php";

/** @file
 * Empty unit testing template/database version
 * @cond 
 * Unit tests for the class
 */

class UsersTest extends \PHPUnit_Extensions_Database_TestCase
{
    public function getConnection()
    {
        return $this->createDefaultDBConnection(self::$site->pdo(), 'coffma30');
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    public function getDataSet()
    {
        return $this->createFlatXMLDataSet(dirname(__FILE__) . '/db/user.xml');
    }

    private static $site;

    public static function setUpBeforeClass() {
        self::$site = new Felis\Site();
        $localize  = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize(self::$site);
        }
    }

    public function test_construct() {
        $users = new Felis\Users(self::$site);
        $this->assertInstanceOf('Felis\Users', $users);
    }


    public function test_login() {
        $users = new Felis\Users(self::$site);

        // Test a valid login based on email address
        $user = $users->login("dudess@dude.com", "87654321");
        $this->assertInstanceOf('Felis\User', $user);

        // Test a valid login based on email address
        $user = $users->login("cbowen@cse.msu.edu", "super477");
        $this->assertInstanceOf('Felis\User', $user);
        $this->assertContains("999-999-9999",$user->getPhone());
        $this->assertContains("Owen, Charles",$user->getName());

        // Test a failed login
        $user = $users->login("dudess@dude.com", "wrongpw");
        $this->assertNull($user);


        $user = $users->login("cbowen@cse.msu.edu", "super477");
        $this->assertEquals(1420174226,$user->getJoined());
        $this->assertContains("A",$user->getRole());

    }


    public function test_get() {
        $users = new Felis\Users(self::$site);

        // Valid
        $user = $users->get("2");
        $this->assertInstanceOf('Felis\User', $user);

        // Invalid
        $user = $users->get("1");
        $this->assertInstanceOf('Felis\User', $user);

        // Test a failed login
        $user = $users->get("1");
        $this->assertEquals('Coffman, Keaton', $user->getName());


        //$user = $users->login("cbowen@cse.msu.edu", "");

    }
}

/// @endcond
