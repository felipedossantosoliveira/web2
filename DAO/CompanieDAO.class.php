<?php

class CompanieDAO{
    public function insert(Companie $companie)
    {
        global $con;

        $name = $companie->getName();
        $cnpj = $companie->getCnpj();

        $sql = $con->prepare("INSERT INTO companies (name, cnpj) VALUES (?, ?)") or die ($con->error);
        $sql->bind_param("ss", $name, $cnpj);
        $sql->execute();

        return $sql->affected_rows > 0;
    }
    public function update(Companie $companie)
    {
        global $con;

        $id = $companie->getId();
        $name = $companie->getName();
        $cnpj = $companie->getCnpj();

        $sql = $con->prepare("UPDATE companies SET name = ?, cnpj = ? WHERE id = ?") or die ($con->error);
        $sql->bind_param("sdis", $name, $cnpj, $id);
        $sql->execute();

        if($sql->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    }
    public function delete($id)
    {
        global $con;

        $sql = $con->prepare("DELETE FROM companies WHERE id = ?") or die ($con->error);
        $sql->bind_param("i", $id);
        $sql->execute();

        if($sql->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    }
    public function select($id)
    {
        global $con;

        $sql = $con->prepare("SELECT * FROM companies WHERE id = ?") or die ($con->error);
        $sql->bind_param("i", $id);
        $sql->execute();
        $result = $sql->get_result();

        if($result->num_rows > 0){
            $companie = $result->fetch_assoc();
            return $companie;
        }else{
            return false;
        }
    }
    public function show()
    {
        global $con;

        $sql = $con->query("SELECT * FROM companies") or die ($con->error);

        while($row = $sql->fetch_assoc()){

            $result[] = $row;
        }
        return $result;
    }
}