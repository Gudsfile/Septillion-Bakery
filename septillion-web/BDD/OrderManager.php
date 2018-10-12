<?php
class OrderManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function add(Order $order)
	{
		$query = $this->_db->prepare("INSERT INTO ORDER(ORDER_DATE, DESCRIPTION, PRICE, VALIDATED, READY, COLLECTED, ID_CLIENT ,ID_EMPLOYEE) VALUES (:order_date, :description, :price, :validated, :ready, :collected, :id_client, :id_employee)");
		$query->bindValue(':order_date', $order->order_date());
		$query->bindValue(':description', $order->description(), PDO::PARAM_STR);
		$query->bindValue(':price', $order->firstName(), PDO::PARAM_INT);
		$query->bindValue(':validated', $order->validated(), PDO::PARAM_INT);
		$query->bindValue(':ready', $order->ready(), PDO::PARAM_INT);
		$query->bindValue(':collected', $order->collected(), PDO::PARAM_INT);
		$query->bindValue(':id_client', $order->client(), PDO::PARAM_INT);
		$query->bindValue(':id_employee', $order->employee(), PDO::PARAM_INT);
		$query->execute();
		return $this->_db->lastInsertId();
	}

	public function delete($id)
	{
		$id = (int) $id;
		$query = $this->_db->prepare("DELETE FROM ORDER WHERE ID_ORDER=:id");
		$query->bindValue(':id', $id);
		$query->execute();
	}

	public function get($id)
	{
		$id = (int) $id;
		$query = $this->_db->query("SELECT * FROM ORDER WHERE ID_ORDER = ".$id);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		print_r($donnees);
		return new Order($donnees);
	}

	public function getList()
	{
		$orders = [];
		$query = $this->_db->query("SELECT * FROM ORDER ORDER BY ID_ORDER");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$orders[] = new Order($donnees);
		}
		return $orders;
	}

	public function update($id, Order $order)
	{
		$query = $this->_db->prepare("UPDATE ORDER SET ORDER_DATE =:order_date, DESCRIPTION =:description, PRICE =:price, VALIDATED =:validated, READY =: ready, COLLECTED =:collected, ID_EMPLOYEE =: id_employee WHERE ID_ORDER = :id");
		$query->bindValue(':id', $id());
		$query->bindValue(':order_date', $order->order_date());
		$query->bindValue(':description', $order->description(), PDO::PARAM_STR);
		$query->bindValue(':price', $order->firstName(), PDO::PARAM_INT);
		$query->bindValue(':validated', $order->validated(), PDO::PARAM_INT);
		$query->bindValue(':ready', $order->ready(), PDO::PARAM_INT);
		$query->bindValue(':collected', $order->collected(), PDO::PARAM_INT);
		$query->bindValue(':id_client', $order->client(), PDO::PARAM_INT);
		$query->bindValue(':id_employee', $order->employee(), PDO::PARAM_INT);
		$query->execute();
	}

	public function setDb($db)
	{
		$this->$_db $db;
	}
}
?>
