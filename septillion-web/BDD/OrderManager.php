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
		$query = $this->_db->prepare("INSERT INTO CLIENT_ORDER(DESCRIPTION, VALIDATED, READY, COLLECTED, ID_CLIENT ,ID_EMPLOYEE) VALUES (:description, :validated, :ready, :collected, :id_client, :id_employee)");
		$query->bindValue(':description', $order->description(), PDO::PARAM_STR);
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
		$query = $this->_db->prepare("DELETE FROM CLIENT_ORDER WHERE ID_ORDER=:id");
		$query->bindValue(':id', $id);
		$query->execute();
	}

	public function get($id)
	{
		$id = (int) $id;
		$query = $this->_db->query("SELECT * FROM CLIENT_ORDER WHERE ID_ORDER = ".$id);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new Order($donnees);
	}

	public function getByClient($id)
	{
		$orders = [];
		$query = $this->_db->query("SELECT * FROM CLIENT_ORDER WHERE ID_CLIENT = ".$id);
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$orders[] = new Order($donnees);
		}
		return $orders;
	}

	public function getByEmployee($id)
	{
		$orders = [];
		$query = $this->_db->query("SELECT * FROM CLIENT_ORDER WHERE ID_EMPLOYEE = ".$id);
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$orders[] = new Order($donnees);
		}
		return $orders;
	}

	public function getDateOrders($date)
	{
		$lowerDate = date( 'Y-m-d', strtotime($date));
		$lowerDate = "'".$lowerDate." 00:00:00'";
		$upperDate = date('Y-m-d', strtotime($date. ' + 1 days'));
		$upperDate = "'".$upperDate." 00:00:00'";
		echo '<pre>';
	      print_r($lowerDate);
	      print_r("	".$upperDate);
	  echo '</pre>';
		$orders = [];
		$query = $this->_db->query("SELECT * FROM CLIENT_ORDER WHERE ORDER_DATE >= ".$lowerDate." AND ORDER_DATE < ".$upperDate);
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$orders[] = new Order($donnees);
		}
		return $orders;
	}

	public function getValidatedOrders()
	{
		$orders = [];
		$query = $this->_db->query("SELECT * FROM CLIENT_ORDER WHERE VALIDATED = 1");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$orders[] = new Order($donnees);
		}
		return $orders;
	}

	public function getReadyOrders()
	{
		$orders = [];
		$query = $this->_db->query("SELECT * FROM CLIENT_ORDER WHERE READY = 1");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$orders[] = new Order($donnees);
		}
		return $orders;
	}

	public function getCollectedOrders()
	{
		$orders = [];
		$query = $this->_db->query("SELECT * FROM CLIENT_ORDER WHERE COLLECTED = 1");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$orders[] = new Order($donnees);
		}
		return $orders;
	}

	public function getNonCollectedOrders()
	{
		$orders = [];
		$query = $this->_db->query("SELECT * FROM CLIENT_ORDER WHERE COLLECTED = 0");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$orders[] = new Order($donnees);
		}
		return $orders;
	}

	public function getList()
	{
		$orders = [];
		$query = $this->_db->query("SELECT * FROM CLIENT_ORDER ORDER BY ID_ORDER");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$orders[] = new Order($donnees);
		}
		return $orders;
	}

	public function update($id, Order $order)
	{
		$query = $this->_db->prepare("UPDATE CLIENT_ORDER SET DESCRIPTION =:description, VALIDATED =:validated, READY =: ready, COLLECTED =:collected, ID_EMPLOYEE =: id_employee WHERE ID_ORDER = :id");
		$query->bindValue(':id', $id());
		$query->bindValue(':description', $order->description(), PDO::PARAM_STR);
		$query->bindValue(':validated', $order->validated(), PDO::PARAM_INT);
		$query->bindValue(':ready', $order->ready(), PDO::PARAM_INT);
		$query->bindValue(':collected', $order->collected(), PDO::PARAM_INT);
		$query->bindValue(':id_client', $order->client(), PDO::PARAM_INT);
		$query->bindValue(':id_employee', $order->employee(), PDO::PARAM_INT);
		$query->execute();
	}

	public function setDb($db)
	{
		$this->_db = $db;
	}
}
?>
