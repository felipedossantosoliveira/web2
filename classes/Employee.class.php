<?php

class Employee{
    private $id;
    private $name;
    private $cpf;
    private $salary;
    private $idDepartament;
    
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
    
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }
    
    public function getCpf()
    {
        return $this->cpf;    
    }
    
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }
    
    public function getSalary()
    {
        return $this->salary;    
    }

    public function setIdDepartament($idDepartament)
    {
        $this->idDepartament = $idDepartament;
    }

    public function getIdDepartament()
    {
        return $this->idDepartament;    
    }
}