<?php

class CompanyDAO{
    public function insert(Company $company)
    {
        global $con;

        $name = $company->getName();
        $cnpj = $company->getCnpj();

        $sql = $con->prepare("INSERT INTO companies (name, cnpj) VALUES (?, ?)") or die ($con->error);
        $sql->bind_param("ss", $name, $cnpj);
        $sql->execute();

        return $sql->affected_rows > 0;
    }

    public function update(Company $company)
    {
        global $con;

        $id = $company->getId();
        $name = $company->getName();
        $cnpj = $company->getCnpj();

        $sql = $con->prepare("UPDATE companies SET name = ?, cnpj = ? WHERE id = ?") or die ($con->error);
        $sql->bind_param("ssi", $name, $cnpj, $id);
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
            $company = $result->fetch_assoc();
            return $company;
        }else{
            return false;
        }
    }
    public function show()
    {
        global $con;

        $sql = $con->prepare("SELECT * FROM companies") or die ($con->error);
		$sql->execute();
		$result = $sql->get_result();

		if($result->num_rows > 0){
			$departaments = $result->fetch_all(MYSQLI_ASSOC);
			return $departaments;
		}else{
			return false;
		}
    }
}