<?php

class EmployeeDAO{
    public function insert(Employee $employee)
    {
        global $con;

		$departamentId = $employee->getIdDepartament();
		$name = $employee->getName();
		$salary = $employee->getSalary();
		$cpf = $employee->getCpf();

        $sql = $con->prepare("INSERT INTO employees (departament_id,name,salary,cpf) VALUES (?,?,?,?)") or die ($con->error);
        $sql->bind_param("isis", $departamentId,$name,$salary,$cpf);
        $sql->execute();

        return $sql->affected_rows > 0;
    }

    public function update(Employee $employee)
    {
		global $con;

		$id = $employee->getId();
		$name = $employee->getName();
		$cpf = $employee->getCpf();
		$salary = $employee->getSalary();
		$idDepartament = $employee->getIdDepartament();

		$sql = $con->prepare("UPDATE employees SET name = ?, cpf = ?, salary = ?, departament_id = ? WHERE id = ?") or die ($con->error);
		$sql->bind_param("ssiii", $name, $cpf, $salary, $idDepartament, $id);
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

        $sql = $con->prepare("DELETE FROM employees WHERE id = ?") or die ($con->error);
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

        $sql = $con->prepare("SELECT * FROM employees WHERE id = ?") or die ($con->error);
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

        $sql = $con->query("SELECT * FROM employees") or die ($con->error);

        while($row = $sql->fetch_assoc()){

            $result[] = $row;
        }
        return $result;
    }
}