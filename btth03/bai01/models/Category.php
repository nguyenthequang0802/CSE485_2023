<?php
require_once 'config.php';

class Category
{
    private $id;
    private $name;

    /**
      * @param $id
      * @param $name
    */

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    /**
      * @return mixed
      */
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function setName($name)
    {
        $this->name = $name;
    }
}
