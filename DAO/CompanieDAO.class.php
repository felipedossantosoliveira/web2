<?php

class CompanieDAO{
    public function insert(Companie $companie)
    {
        global $con;

        $name = $companie->getName();
        $cnpj = $companie->getCnpj();

        $sql = $con->prepare("INSERT INTO companie (name, cnpj) VALUES (?, ?)") or die ($con->error);
        $sql->bind_param("sdiss", $name, $cnpj);
        $sql->execute();

        if($sql->affected_rows > 0){
            return true;
        }else{
            return false;
        }
    }
    public function update(Companie $companie)
    {
        global $con;

        $id = $companie->getId();
        $name = $companie->getName();
        $cnpj = $companie->getCnpj();

        $sql = $con->prepare("UPDATE companie SET name = ?, cnpj = ? WHERE id = ?") or die ($con->error);
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

        $sql = $con->prepare("DELETE FROM companie WHERE id = ?") or die ($con->error);
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

        $sql = $con->prepare("SELECT * FROM companie WHERE id = ?") or die ($con->error);
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

        $sql = $con->query("SELECT * FROM companie") or die ($con->error);
        $sql->fetch_array();

        if($sql->num_rows > 0){
            $companie = $sql->fetch_all(MYSQLI_ASSOC);
            return $companie;
        }else{
            return false;
        }
    }
}