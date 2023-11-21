<?php

class Departament{
    private $id;
    private $name;
    private $idCompanie;
    
    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getId()
    {
        return $this->id;    
    }
    
    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;    
    }
    
    public function setIdCompanie($idCompanie)
    {
        $this->idCompanie = $idCompanie;
    }
    
    public function getIdCompanie()
    {
        return $this->idCompanie;    
    }
}