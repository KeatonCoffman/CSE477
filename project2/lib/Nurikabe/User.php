<?php
/**
 * Created by PhpStorm.
 * User: keatoncoffman
 * Date: 6/20/17
 * Time: 1:30 PM
 */

namespace Nurikabe;


class User
{
    //private $id;		///< The internal ID for the user
    private $email;		///< Email address
    private $name; 		///< Name as last, first
    //private $validator;	///< When user was added



    const SESSION_NAME = 'user';


    /**
     * Constructor
     * @param $row Row from the user table in the database
     */
    public function __construct($row) {
        //$this->id = $row['id'];
        $this->email = $row['email'];
        $this->name = $row['name'];
        //$this->validator = $row['validator'];


    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function setName($value)
    {
        $this->name= $value;
    }

    /**
     * @return mixed
     */
    public function setId($value)
    {
       $this->id = $value;
    }

    /**
     * @return mixed
     */
    public function setEmail($value)
    {
        $this->email= $value;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
    public function getValidator()
    {
        return $this->validator;
    }
     **/



}