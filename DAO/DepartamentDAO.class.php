<?php

class DepartamentDAO{
    public function insert(Departament $departament)
    {
		global $con;

		$name = $departament->getName();
		$CompanyId = $departament->getIdCompany();

		$sql = $con->prepare("INSERT INTO departaments (name, company_id) VALUES (?, ?)") or die ($con->error);
		$sql->bind_param("si", $name, $CompanyId);
		$sql->execute();

		return $sql->affected_rows > 0;
    }

	public function update(Departament $departament)
	{
		global $con;

		$id = $departament->getId();
		$name = $departament->getName();
		$CompanyId = $departament->getIdCompany();

		$sql = $con->prepare("UPDATE departaments SET name = ?, company_id = ? WHERE id = ?") or die ($con->error);
		$sql->bind_param("sii", $name, $CompanyId, $id);
		$sql->execute();

		return $sql->affected_rows > 0;
	}
	public function delete($id)
	{
		global $con;

		$sql = $con->prepare("DELETE FROM departaments WHERE id = ?") or die ($con->error);
		$sql->bind_param("i", $id);
		$sql->execute();

		return $sql->affected_rows > 0;
	}
	public function select($id)
	{
		global $con;

		$sql = $con->prepare("SELECT * FROM departaments WHERE id = ?") or die ($con->error);
		$sql->bind_param("i", $id);
		$sql->execute();
		$result = $sql->get_result();

		if($result->num_rows > 0){
			$departament = $result->fetch_assoc();
			return $departament;
		}else{
			return false;
		}
	}
	public function show()
	{
		global $con;

		$sql = $con->prepare("SELECT * FROM departaments") or die ($con->error);
		$sql->execute();
		$result = $sql->get_result();

		if($result->num_rows > 0){
			$departaments = $result->fetch_all(MYSQLI_ASSOC);
			return $departaments;
		}else{
			return false;
		}
	}

	public function showByCompany($id)
	{
		global $con;

		$sql = $con->prepare("SELECT * FROM departaments WHERE company_id = ?") or die ($con->error);
		$sql->bind_param("i", $id);
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