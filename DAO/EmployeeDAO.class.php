<?php

class EmployeeDAO{
    public function insert(Employee $employee)
    {
		global $con;

		$name = $employee->getName();
        $cpf = $employee->getCpf();
        $salary = $employee->getSalary();
		$DepartamentId = $employee->getIdDepartament();

		$sql = $con->prepare("INSERT INTO employees (name,cpf,salary,departament_id) VALUES (?,?,?,?)") or die ($con->error);
		$sql->bind_param("ssdi", $name, $cpf, $salary, $DepartamentId);
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

        $sql = $con->prepare("UPDATE employees SET name = ?, cpf = ?, salary = ? WHERE id = ?") or die ($con->error);
        $sql->bind_param("ssdi", $name, $cpf, $salary, $id);
        $sql->execute();

        return $sql->affected_rows > 0;
	}

    public function delete($id)
    {
        global $con;

        $sql = $con->prepare("DELETE FROM employees WHERE id = ?") or die ($con->error);
        $sql->bind_param("i", $id);
        $sql->execute();

        return $sql->affected_rows > 0;
    }

    public function select($id)
    {
        global $con;

        $sql = $con->prepare("SELECT * FROM employees WHERE id = ?") or die ($con->error);
        $sql->bind_param("i", $id);
        $sql->execute();
        $result = $sql->get_result();

        if($result->num_rows > 0){
            $employee = $result->fetch_assoc();
            return $employee;
        }else{
            return false;
        }
    }

    public function show()
    {
        global $con;

        $sql = $con->prepare("SELECT * FROM employees") or die ($con->error);
        $sql->execute();
        $result = $sql->get_result();

        if($result->num_rows > 0){
            $employees = $result->fetch_all(MYSQLI_ASSOC);
            return $employees;
        }else{
            return false;
        }
    }

    public function showByDepartament($id)
    {
        global $con;

        $sql = $con->prepare("SELECT * FROM employees WHERE departament_id = ?") or die ($con->error);
        $sql->bind_param("i", $id);
        $sql->execute();
        $result = $sql->get_result();

        if($result->num_rows > 0){
            $employees = $result->fetch_all(MYSQLI_ASSOC);
            return $employees;
        }else{
            return false;
        }
    }
}