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
		$query = $this->_db->prepare('INSERT INTO Order_Client(Date, Description, Price, ID_Client) VALUES(:Date, :Description, :Price, :ID_Client');
		$query->bindValue(':Date', $orderClient->date());
		$query->bindValue(':Description', $orderClient->description(), PDO::PARAM_STR);
		$query->bindValue(':Price', $orderClient->firstName(), PDO::PARAM_INT);
		$query->bindValue(':ID_Client', $orderClient->client()->id(), PDO::PARAM_INT);
		$query->execute();
		return $this->_db->lastInsertId();	
	}

	public function delete(OrderClient $orderClient)
	{
		$this->_db->exec('DELETE FROM Order_Client WHERE id = '.$orderClient->id());
	}

	public function get($id)
	{
		$id = (int) $id;
		$query = $this->_db->prepare('SELECT * FROM Order_Client WHERE id = '$id);
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		return new OrderClient($donnees);
	}

	public function getList()
	{
		$orderClient = [];
		$query = $this->_db->query('SELECT * FROM Order_Client ORDER BY id');
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
			$orderClient[] = new OrderClient($donnees);
		}
		return $orderClient;
	}

	public function update(OrderClient $orderClient)
	{
		$query = $this->_db->prepare('UPDATE OrderClient SET Date = :Date, Description = :Description, Price = :Price, ID_Client = :ID_Client WHERE id = :id');
		$query->bindValue(':id', $orderClient->id());
		$query->bindValue(':Date', $orderClient->date());
		$query->bindValue(':Description', $orderClient->description(), PDO::PARAM_STR);
		$query->bindValue(':Price', $orderClient->firstName(), PDO::PARAM_INT);
		$query->bindValue(':ID_Client', $orderClient->client()->id(), PDO::PARAM_INT);
		$query->execute();
	}

	public function setDb($db)
	{
		$this->$_db $db;
	}
}
?>