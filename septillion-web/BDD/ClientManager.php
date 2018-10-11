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

	public function getClient($mail, $password)
	{
		$mail = "'".$mail."'";
		$password = "'".$password."'";
		$query = $this->_db->query("SELECT * FROM CLIENT WHERE MAIL =".$mail." AND PASSWORD = ".$password);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new Client($donnees);
	}

	public function getClientByMail($mail)
	{
		$mail = "'".$mail."'";
		$query = $this->_db->query("SELECT * FROM CLIENT WHERE MAIL =".$mail);
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
    $query = $this->_db->prepare('UPDATE CLIENT SET MAIL = :mail, PASSWORD = :Password, FIRST_NAME = :first_name, LAST_NAME = :last_name, ADDRESS = :address, PHONE_NUMBER = :phone_number WHERE ID_CLIENT = :id');
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
