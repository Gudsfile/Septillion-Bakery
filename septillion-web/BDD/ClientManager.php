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
		$query = $this->_db->prepare('INSERT INTO `CLIENT`(`MAIL`, `PASSWORD`, `FIRST_NAME`, `LAST_NAME`, `ADDRESS`, `PHONE_NUMBER`) VALUES (:mail,:password,:first_name,:last_name,:address,:phone_number)');
		$query->bindValue(':mail', $client->mail());
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
		$query = $this->_db->prepare('DELETE FROM CLIENT WHERE ID_CLIENT=:id');
		$query->bindValue(':id', $id);
		$query->execute();
	}

	public function get($id)
	{
		$id = (int) $id;
		$query = $this->_db->query('SELECT * FROM CLIENT WHERE ID_ClIENT ='.$id);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new Client($donnees);
	}

	public function getClient($Mail, $MotDePasse)
	{
		$query = $this->_db->prepare('SELECT * FROM CLIENT WHERE MAIL ='.$Mail.' AND PASSWORD = '.$MotDePasse);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		if (mysql_num_rows($donnees)==0) {
			return 0;
		} else {
			return new Client($donnees);
		}
	}

	public function getClientByMail($mail)
	{
		$mail = (string) $mail;
		$query = $this->_db->prepare('SELECT * FROM CLIENT WHERE MAIL = '.$mail);
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

	public function update(Client $client)
	{
    $query = $this->_db->prepare('UPDATE Client SET Mail = :Mail, Password = :Password, First_Name = :First_Name, Last_Name = :Last_Name, Address = :Address, Phone_Number = :Phone_Number WHERE ID_CLIENT = :id');
    $query->bindValue(':id', $client->id(), PDO::PARAM_INT);
		$query->bindValue(':Mail', $client->mail());
		$query->bindValue(':Password', $client->password(), PDO::PARAM_STR);
		$query->bindValue(':First_Name', $client->firstName(), PDO::PARAM_STR);
		$query->bindValue(':Last_Name', $client->lastName(), PDO::PARAM_STR);
		$query->bindValue(':Address', $client->address(), PDO::PARAM_STR);
		$query->bindValue(':Phone_Number', $client->phoneNumber(), PDO::PARAM_STR);
		$query->execute();
	}

	public function setDb($db)
	{
		$this->_db=$db;
	}
}
?>
