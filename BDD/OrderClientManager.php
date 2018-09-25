<?php
class OrderClientManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function add(OrderClient $orderClient)
	{
		$query = $this->_db->prepare('INSERT INTO Order_Client(Date, Description, Price, Client) VALUES(:Date, :Description, :Price, :Client');
		$query->bindValue(':Date', $client->mail());
		$query->bindValue(':Description', $client->password(), PDO::PARAM_STR);
		$query->bindValue(':First_name', $client->firstName(), PDO::PARAM_STR);
		$query->bindValue(':Last_name', $client->lastName(), PDO::PARAM_STR);
		$query->bindValue(':Adress', $client->adress(), PDO::PARAM_STR);
		$query->bindValue(':Phone_number', $client->phoneNumber(), PDO::PARAM_STR);
		$query->execute();
	}
}
?>