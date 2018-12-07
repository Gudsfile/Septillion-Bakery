<?php
class ClientManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function add(Client $client)
	{
		$query = $this->_db->prepare("INSERT INTO CLIENT(MAIL, PASSWORD, FIRST_NAME, LAST_NAME, ADDRESS, PHONE_NUMBER) VALUES (:mail,:password,:first_name,:last_name,:address,:phone_number)");
		$query->bindValue(':mail', $client->mail(), PDO::PARAM_STR);
		$query->bindValue(':password', $client->password(), PDO::PARAM_STR);
		$query->bindValue(':first_name', $client->first_name(), PDO::PARAM_STR);
		$query->bindValue(':last_name', $client->last_name(), PDO::PARAM_STR);
		$query->bindValue(':address', $client->address(), PDO::PARAM_STR);
		$query->bindValue(':phone_number', $client->phone_number(), PDO::PARAM_STR);
		$query->execute();
		return $this->_db->lastInsertId();
	}

	public function delete($id)
	{
		$id = (int) $id;
		$query = $this->_db->prepare("DELETE FROM CLIENT WHERE ID_CLIENT=:id");
		$query->bindValue(':id', $id);
		$query->execute();
	}

	public function get($id)
	{
		$id = (int) $id;
		$query = $this->_db->query("SELECT * FROM CLIENT WHERE ID_ClIENT =".$id);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new Client($donnees);
	}

	public function getByMail($mail)
	{
		$mail = "'".$mail."'";
		$query = $this->_db->query("SELECT * FROM CLIENT WHERE MAIL =".$mail);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		if ($donnees == null) {
			return 0;
		}
		else
		return new Client($donnees);
	}

		public function getMail($mail)
	{
		$mail = "'".$mail."'";
		$query = $this->_db->query("SELECT * FROM CLIENT WHERE MAIL =".$mail);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		if ($donnees!=null)
			return true;
			return false;
	}


	public function getByMailAndPassword($mail, $passwd)
	{
		$mail = "'".$mail."'";
		$passwd = "'".$passwd."'";
		$query = $this->_db->query("SELECT * FROM CLIENT WHERE MAIL =".$mail." AND PASSWORD =".$passwd);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		if ($donnees == null) {
			return 0;
		}
		else
		return new Client($donnees);
	}

	public function getByLastName($lastName)
	{
		$lastName = "'".$lastName."'";
		$query = $this->_db->query("SELECT * FROM CLIENT WHERE LAST_NAME =".$lastName);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new Client($donnees);
	}

	public function getList()
	{
		$client = [];
		$query = $this->_db->query('SELECT * FROM CLIENT ORDER BY ID_CLIENT');
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$client[] = new Client($donnees);
		}
    	return $client;
	}

	public function update($id, Client $client)
	{
    $query = $this->_db->prepare('UPDATE CLIENT SET MAIL = :mail, PASSWORD = :password, FIRST_NAME = :first_name, LAST_NAME = :last_name, ADDRESS = :address, PHONE_NUMBER = :phone_number WHERE ID_CLIENT = :id');
    $query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->bindValue(':mail', $client->mail(), PDO::PARAM_STR);
		$query->bindValue(':password', $client->password(), PDO::PARAM_STR);
		$query->bindValue(':first_name', $client->first_name(), PDO::PARAM_STR);
		$query->bindValue(':last_name', $client->last_name(), PDO::PARAM_STR);
		$query->bindValue(':address', $client->address(), PDO::PARAM_STR);
		$query->bindValue(':phone_number', $client->phone_number(), PDO::PARAM_STR);
		$query->execute();
	}

	public function setDb($db)
	{
		$this->_db=$db;
	}
}
?>
