<?php

class Departament{
    private $id;
    private $name;
    private $idCompany;
    
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
    
    public function setIdCompany($idCompany)
    {
        $this->idCompany = $idCompany;
    }
    
    public function getIdCompany()
    {
        return $this->idCompany;    
    }
}