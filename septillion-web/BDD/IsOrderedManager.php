<?php
class IsOrderedManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function add(IsOrdered $isOrdered)
	{
		$query = $this->_db->prepare('INSERT INTO Is_Ordered(ID_Order, ID_Product, Quantity) VALUES(:ID_Order, :ID_Product, :Quantity');
		$query->bindValue(':ID_Order', $isOrdered->idOrder(), PDO::PARAM_INT);
		$query->bindValue(':ID_Product', $orderClient->idProduct(), PDO::PARAM_INT);
		$query->bindValue(':Quantity', $orderClient->firstName(), PDO::PARAM_INT);
		$query->execute();
	}

	public function delete(IsOrdered $isOrdered)
	{
		$this->_db->exec('DELETE FROM Is_Ordered WHERE ID_Order = '.$isOrdered->idOrder().' ID_Product = '.$isOrdered->idProduct());
	}

	public function getId($idProduct, $idOrder)
	{
		$idProduct = (int) $idProduct;
		$idOrder = (int) $idOrder;
		$query = $this->_db->prepare('SELECT * FROM Is_Ordered WHERE ID_Order = '.$idOrder.' ID_Product = '.$idProduct);
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		return new IsOrdered($donnees);
	}

	public function getOrder($id)
	{
		$id = (int) $id;
		$IsOrdered = [];
		$query = $this->_db->query('SELECT * FROM Is_Ordered WHERE ID_Order = '.$id.' ORDER BY ID_Product');
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
			$IsOrdered[] = new IsOrdered($donnees);
		}
		return $orderClient;
	}

	public function getProduct($id)
	{
		$id = (int) $id;
		$IsOrdered = [];
		$query = $this->_db->query('SELECT * FROM Is_Ordered WHERE ID_Product = '.$id.' ORDER BY ID_Product');
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
			$IsOrdered[] = new IsOrdered($donnees);
		}
		return $orderClient;
	}

	public function getList()
	{
		$IsOrdered = [];
		$query = $this->_db->query('SELECT * FROM Is_Ordered ORDER BY ID_Product');
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
			$IsOrdered[] = new IsOrdered($donnees);
		}
		return $orderClient;
	}

	public function update(IsOrdered $isOrdered)
	{
		$query = $this->_db->prepare('UPDATE Is_Ordered SET Quantity = :Quantity WHERE ID_Order = :ID_Order AND ID_Product = :ID_Product');
		$query->bindValue(':ID_Order', $isOrdered->idOrder(), PDO::PARAM_INT);
		$query->bindValue(':ID_Product', $orderClient->idProduct(), PDO::PARAM_INT);
		$query->bindValue(':Quantity', $orderClient->firstName(), PDO::PARAM_INT);
		$query->execute();
	}

	public function setDb($db)
	{
		$this->$_db $db;
	}
}
?>