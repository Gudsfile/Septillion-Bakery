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
		$query = $this->_db->prepare("INSERT INTO IS_ORDERED(ID_ORDER, ID_PRODUCT, QUANTITY) VALUES(:id_order, :id_product, :quantity)");
		$query->bindValue(':id_order', $isOrdered->id_order(), PDO::PARAM_INT);
		$query->bindValue(':id_product', $isOrdered->id_product(), PDO::PARAM_INT);
		$query->bindValue(':quantity', $isOrdered->quantity(), PDO::PARAM_INT);
		$query->execute();
	}

	public function delete($id_order, $id_product)
	{
		$id_order = (int) $id_order;
		$id_product = (int) $id_product;
		$query = $this->_db->prepare("DELETE FROM IS_ORDERED WHERE ID_ORDER =:id_order AND ID_PRODUCT =:id_product");
		$query->bindValue(':id_order', $id_order);
		$query->bindValue(':id_product', $id_product);
		$query->execute();
	}

	public function getId($id_order, $id_product)
	{
		$id_order = (int) $id_order;
		$id_product = (int) $id_product;
		$query = $this->_db->query("SELECT * FROM IS_ORDERED WHERE ID_ORDER =".$id_order." AND ID_PRODUCT =".$id_product);
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		return new IsOrdered($donnees);
	}

	public function getByOrder($id)
	{
		$id = (int) $id;
		$isOrder = [];
		$query = $this->_db->query("SELECT * FROM IS_ORDERED WHERE ID_ORDER = ".$id);
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$isOrder[] = new IsOrdered($donnees);
		}
    return $isOrder;
	}

	public function getByProduct($id)
	{
		$id = (int) $id;
		$isOrder = [];
		$query = $this->_db->query("SELECT * FROM IS_ORDERED WHERE ID_PRODUCT = ".$id);
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$isOrder[] = new IsOrdered($donnees);
		}
    return $isOrder;
	}

	public function getList()
	{
		$IsOrdered = [];
		$query = $this->_db->query("SELECT * FROM IS_ORDERED");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$IsOrdered[] = new IsOrdered($donnees);
		}
		return $IsOrdered;
	}

	public function update($id_order, $id_product, $quantity)
	{
		$query = $this->_db->prepare("UPDATE IS_ORDERED SET QUANTITY =:quantity WHERE ID_ORDER =:id_order AND ID_PRODUCT =:id_product");
		$query->bindValue(':id_order', $id_order, PDO::PARAM_INT);
		$query->bindValue(':id_product', $id_product, PDO::PARAM_INT);
		$query->bindValue(':quantity', $quantity, PDO::PARAM_INT);
		$query->execute();
	}

	public function setDb($db)
	{
		$this->_db = $db;
	}
}
?>
