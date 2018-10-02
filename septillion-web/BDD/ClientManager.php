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
		$query = $this->_db->prepare('INSERT INTO Client(Mail, Password, First_name, Last_name, Adress, Phone_number) VALUES(:Mail, :Password, :First_name, :Last_name, :Adress, :Phone_number)');
		$query->bindValue(':Mail', $client->mail());
		$query->bindValue(':Password', $client->password(), PDO::PARAM_STR);
		$query->bindValue(':First_name', $client->firstName(), PDO::PARAM_STR);
		$query->bindValue(':Last_name', $client->lastName(), PDO::PARAM_STR);
		$query->bindValue(':Adress', $client->adress(), PDO::PARAM_STR);
		$query->bindValue(':Phone_number', $client->phoneNumber(), PDO::PARAM_STR);
		$query->execute();
		return $this->_db->lastInsertId();	
	}

	public function delete(Client $client)
	{
		$this->_db->exec('DELETE FROM Client WHERE id = '.$client->id());
	}

	public function getID($id)
	{
		$id = (int) $id;
		$query = $this->_db->prepare('SELECT * FROM Client WHERE ID_ClIENT ='.$id);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new Client($donnees);
	}
		public function getClient($Mail, $MotDePasse)
	{

		$query = $this->_db->prepare('SELECT * FROM Client WHERE Mail = '.$Mail.' AND password = '.$MotDePasse.';');
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		if (count($donnees)==0) {
			return 0;
		} else return new Client($donnees);
	}

	public function getList()
	{
		$client = [];
		$query = $this->_db->query('SELECT * FROM Client ORDER BY id');
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$client[] = new Client($donnees);
		}
    	return $client;
	}

	public function update(Client $client)
	{
    	$query = $this->_db->prepare('UPDATE Client SET Mail = :Mail, Password = :Password, First_name = :First_name, Last_name = :Last_name, Adress = :Adress, Phone_number = :Phone_number WHERE id = :id');
    	$query->bindValue(':id', $client->id(), PDO::PARAM_INT);
		$query->bindValue(':Mail', $client->mail(), PDO::PARAM_STR);
		$query->bindValue(':Password', $client->password(), PDO::PARAM_STR);
		$query->bindValue(':First_name', $client->firstName(), PDO::PARAM_STR);
		$query->bindValue(':Last_name', $client->lastName(), PDO::PARAM_STR);
		$query->bindValue(':Adress', $client->adress(), PDO::PARAM_STR);
		$query->bindValue(':Phone_number', $client->phoneNumber(), PDO::PARAM_STR);
		$query->execute();
	}

	public function setDb($db)
	{
		$this->_db=$db;
	}
}
?>