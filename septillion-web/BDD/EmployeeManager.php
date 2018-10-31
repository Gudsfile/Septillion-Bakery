<?php
class EmployeeManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function add(Employee $employee)
	{
		$query = $this->_db->prepare("INSERT INTO EMPLOYEE(MAIL, PASSWORD, FIRST_NAME, LAST_NAME, ROLE) VALUES (:mail,:password,:first_name,:last_name,:role)");
		$query->bindValue(':mail', $employee->mail(), PDO::PARAM_STR);
		$query->bindValue(':password', $employee->password(), PDO::PARAM_STR);
		$query->bindValue(':first_name', $employee->first_name(), PDO::PARAM_STR);
		$query->bindValue(':last_name', $employee->last_name(), PDO::PARAM_STR);
		$query->bindValue(':role', $employee->role(), PDO::PARAM_STR);
		$query->execute();
		return $this->_db->lastInsertId();
	}

	public function delete($id)
	{
		$id = (int) $id;
		$query = $this->_db->prepare("DELETE FROM EMPLOYEE WHERE ID_EMPLOYEE =:id");
		$query->bindValue(':id', $id);
		$query->execute();
	}

	public function get($id)
	{
		$id = (int) $id;
		$query = $this->_db->query("SELECT * FROM EMPLOYEE WHERE ID_EMPLOYEE =".$id);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new Employee($donnees);
	}

	public function getByMail($mail)
	{
		$mail = "'".$mail."'";
		$query = $this->_db->query("SELECT * FROM EMPLOYEE WHERE MAIL =".$mail);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new Employee($donnees);
	}

	public function getByMailAndPassword($mail, $passwd)
	{
		$mail = "'".$mail."'";
		$passwd = "'".$passwd."'";
		$query = $this->_db->query("SELECT * FROM EMPLOYEE WHERE MAIL =".$mail." AND PASSWORD =".$passwd);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new Employee($donnees);
	}

	public function getByLastName($lastName)
	{
		$lastName = "'".$lastName."'";
		$query = $this->_db->query("SELECT * FROM EMPLOYEE WHERE LAST_NAME =".$lastName);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new Employee($donnees);
	}

	public function getList()
	{
		$employees = [];
		$query = $this->_db->query("SELECT * FROM EMPLOYEE ORDER BY ID_EMPLOYEE");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$employees[] = new Employee($donnees);
		}
    	return $employees;
	}

	public function update($id, Employee $employee)
	{
		$query = $this->_db->prepare("UPDATE EMPLOYEE SET MAIL = :mail, PASSWORD = :password, FIRST_NAME = :first_name, LAST_NAME = :last_name, ROLE = :role WHERE ID_EMPLOYEE = :id");
		$query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->bindValue(':mail', $employee->mail(), PDO::PARAM_STR);
		$query->bindValue(':password', $employee->password(), PDO::PARAM_STR);
		$query->bindValue(':first_name', $employee->first_name(), PDO::PARAM_STR);
		$query->bindValue(':last_name', $employee->last_name(), PDO::PARAM_STR);
		$query->bindValue(':role', $employee->role(), PDO::PARAM_STR);
		$query->execute();
	}

	public function setDb($db)
	{
		$this->_db=$db;
	}
}
?>
