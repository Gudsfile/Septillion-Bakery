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
		$query = $this->_db->prepare("INSERT INTO ORDER_CLIENT (DATE, DESCRIPTION, PRICE, VALIDATED, READY, COLLECTED, ID_CLIENT, ID_EMPLOYEE) VALUES(:date, :description, :price, :validated, :ready, :collected, :id_client, :id_employee)");

		$query->bindValue(':date', $orderClient->date());
		$query->bindValue(':description', $orderClient->description(), PDO::PARAM_STR);
		$query->bindValue(':price', $orderClient->price(), PDO::PARAM_INT);
		$query->bindValue(':validated', $orderClient->validated(), PDO::PARAM_INT);
		$query->bindValue(':ready', $orderClient->ready(), PDO::PARAM_INT);
		$query->bindValue(':collected', $orderClient->collected(), PDO::PARAM_INT);
		$query->bindValue(':id_client', $orderClient->client(), PDO::PARAM_INT);
		$query->bindValue(':id_employee', $orderClient->employee(), PDO::PARAM_INT);
		
		$query->execute();
		return $this->_db->lastInsertId();
	}

	public function delete(OrderClient $orderClient)
	{
		$id = (int) $id;
		$query = $this->_db->prepare("DELETE FROM ORDER_CLIENT WHERE ID_ORDER=:id");
		$query->bindValue(':id', $id);
		$query->execute();
	}

	public function get($id)
	{
		$id = (int) $id;
		$query = $this->_db->query('SELECT * FROM ORDER_CLIENT WHERE ID_ORDER = '.$id);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new OrderClient($donnees);
	}

	public function getList()
	{
		$orderClient = [];
		$query = $this->_db->query('SELECT * FROM ORDER_CLIENT ORDER BY ID_ORDER');
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$orderClient[] = new OrderClient($donnees);
		}
		return $orderClient;
	}

		public function update($id, OrderClient $newOrder)
	{
    	$query = $this->_db->prepare("UPDATE ORDER_CLIENT SET Date = :date, DESCRIPTION = :description, PRICE = :price, VALIDATED= :validated, READY= :ready, COLLECTED= :collected, ID_CLIENT = :id_client, ID_EMPLOYEE= :id_employee WHERE ID_ORDER = :id");

		$query->bindValue(':id', $id, PDO::PARAM_STR);;
		$query->bindValue(':date', $newOrder->date(), PDO::PARAM_STR);
		$query->bindValue(':description', $newOrder->description(), PDO::PARAM_STR);
		$query->bindValue(':price', $newOrder->price(), PDO::PARAM_INT);
		$query->bindValue(':validated', $newOrder->validated(), PDO::PARAM_INT);
		$query->bindValue(':ready', $newOrder->ready(), PDO::PARAM_INT);
		$query->bindValue(':collected', $newOrder->collected(), PDO::PARAM_INT);
		$query->bindValue(':id_client', $newOrder->client(), PDO::PARAM_INT);
		$query->bindValue(':id_employee', $newOrder->employee(), PDO::PARAM_INT);

		$query->execute();
	}

	public function setDb($db)
	{
		$this->_db=$db;
	}
}
?>