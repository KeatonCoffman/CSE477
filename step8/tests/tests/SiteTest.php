<?php
require __DIR__ . "/../../vendor/autoload.php";

/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/13/17
 * Time: 5:35 PM
 */
class SiteTest extends \PHPUnit_Framework_TestCase
{
    public function test_emailSet(){
        $item = new Felis\Site();
        $item->dbConfigure("MSU CSE", "User", "password", "prefix");
        $item->setEmail("EMAIL");
        $this->assertEquals("EMAIL",$item->getEmail());
    }

    public function test_emailGet(){
        $item = new Felis\Site();
        $item->dbConfigure("MSU CSE", "User", "password", "prefix");
        $item->setEmail("EMAIL");
        $this->assertEquals("EMAIL",$item->getEmail());
    }

    public function test_rootSet(){
        $item = new Felis\Site();
        $item->dbConfigure("MSU CSE", "User", "password", "prefix");
        $item->setRoot("ROOT");
        $this->assertEquals("ROOT",$item->getRoot());
    }

    public function test_rootGet(){
        $item = new Felis\Site();
        $item->dbConfigure("MSU CSE", "User", "password", "prefix");
        $this->assertEquals("",$item->getRoot());
    }

    public function test_getTable_prefix() {
        $item = new Felis\Site();
        $item->dbConfigure("MSU CSE", "User", "password", "prefix");
        $this->assertEquals("prefix",$item->getTablePrefix());
    }

    public function test_localize() {
        $site = new Felis\Site();
        $localize = require 'localize.inc.php';
        if(is_callable($localize)) {
            $localize($site);
        }
        $this->assertEquals('test8_', $site->getTablePrefix());
    }

}