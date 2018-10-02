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
		$query = $this->_db->prepare('INSERT INTO employee(Mail, Password, First_name, Last_name, Adress, Phone_number) VALUES(:Mail, :Password, :First_name, :Last_name, :Adress, :Phone_number)');
		$query->bindValue(':Mail', $employee->mail());
		$query->bindValue(':Password', $employee->password(), PDO::PARAM_STR);
		$query->bindValue(':First_name', $employee->firstName(), PDO::PARAM_STR);
		$query->bindValue(':Last_name', $employee->lastName(), PDO::PARAM_STR);
		$query->bindValue(':Adress', $employee->adress(), PDO::PARAM_STR);
		$query->bindValue(':Phone_number', $employee->phoneNumber(), PDO::PARAM_STR);
		$query->execute();
		return $this->_db->lastInsertId();
	}

	public function delete(Employee $employee)
	{
		$this->_db->exec('DELETE FROM Employee WHERE id = '.$employee->id());
	}

	public function get($id)
	{
		$id = (int) $id;
		$query = $this->_db->prepare('SELECT * FROM Employee WHERE id = '$id);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new Employee($donnees);
	}

	public function getList()
	{
		$employees = [];
		$query = $this->_db->query('SELECT * FROM Employee ORDER BY id');
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$employees[] = new Employee($donnees);
		}
    	return $employees;
	}

	public function update(Employee $employee)
	{
    	$query = $this->_db->prepare('UPDATE Employee SET Mail = :Mail, Password = :Password, First_name = :First_name, Last_name = :Last_name, Adress = :Adress, Phone_number = :Phone_number WHERE id = :id');
    	$query->bindValue(':id', $employee->id(), PDO::PARAM_INT);
		$query->bindValue(':Mail', $employee->mail(), PDO::PARAM_STR);
		$query->bindValue(':Password', $employee->password(), PDO::PARAM_STR);
		$query->bindValue(':First_name', $employee->firstName(), PDO::PARAM_STR);
		$query->bindValue(':Last_name', $employee->lastName(), PDO::PARAM_STR);
		$query->bindValue(':Adress', $employee->adress(), PDO::PARAM_STR);
		$query->bindValue(':Phone_number', $employee->phoneNumber(), PDO::PARAM_STR);
		$query->execute();
	}

	public function setDb($db)
	{
		$this->_db=$db;
	}
}
?>