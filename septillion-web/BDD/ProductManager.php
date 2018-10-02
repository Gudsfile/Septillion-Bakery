<?php
class ProductManager 
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function add(Product $product)
	{
		$query = $this->_db->prepare('INSERT INTO `product`(`Name_PRODUCT`, `STOCK_Quantity`, `Description`, `Price`, `Image`, `Created_By_IDEmp`, `Last_update_By_IDEmp`, `ID_Category`) VALUES (:Name_product,:STOCK_Quantity,:Description,:Price,:Image,:Created_By_IDEmp,:Last_update_By_IDEmp,:ID_Category)');
		$query->bindValue(':Name_product', $product->name_product());
		$query->bindValue(':STOCK_Quantity', $product->stock_quantity(), PDO::PARAM_STR);
		$query->bindValue(':Description', $product->Description(), PDO::PARAM_STR);
		$query->bindValue(':Price', $product->price(), PDO::PARAM_STR);
		$query->bindValue(':Image', $product->image(), PDO::PARAM_STR);
		$query->bindValue(':Created_By_IDEmp', $product->created_by_idEmp(), PDO::PARAM_STR);
		$query->bindValue(':Last_update_By_IDEmp', $product->last_update_by_idEmp(), PDO::PARAM_STR);
		$query->bindValue(':ID_Category', $product->id_category(), PDO::PARAM_STR);
		$query->execute();
		return $this->_db->lastInsertId();	
	}
	
	public function delete(Product $product)
	{
		$this->_db->exec('DELETE FROM product WHERE ID_PRODUCT = '.$product->id());
	}

	public function get($id)
	{
		$id = (int) $id;
		$query = $this->_db->prepare('SELECT * FROM Product WHERE ID_PRODUCT = '.$id);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new Product($donnees);
	}

	public function getList()
	{
		$product = [];

		$query = $this->_db->query('SELECT * FROM Product ORDER BY ID_PRODUCT');
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$product[] = new Product($donnees);
		}
    	return $product;
	}

	public function update(Product $product)
	{
    	$query = $this->_db->prepare('UPDATE `product` SET `ID_PRODUCT`=:ID_PRODUCT,`Name_PRODUCT`=:Name_PRODUCT,`STOCK_Quantity`=:Name_PRODUCT,`Description`=:Description,`Price`=:Price,`Image`=:Image,`Created_By_IDEmp`=:Created_By_IDEmp,`Last_update_By_IDEmp`=:Last_update_By_IDEmp,`ID_Category`=:ID_Category WHERE ID_PRODUCT = :id');
    	$query->bindValue(':id', $product->id(), PDO::PARAM_INT);
		$query->bindValue(':Name_PRODUCT', $product->name_product(), PDO::PARAM_STR);
		$query->bindValue(':STOCK_Quantity', $product->stock_quantity(), PDO::PARAM_STR);
		$query->bindValue(':Description', $product->description(), PDO::PARAM_STR);
		$query->bindValue(':Price', $product->price(), PDO::PARAM_STR);
		$query->bindValue(':Image', $product->image(), PDO::PARAM_STR);
		$query->bindValue(':Created_By_IDEmp', $product->created_by_idEmp(), PDO::PARAM_STR);
		$query->bindValue(':Last_update_By_IDEmp', $product->last_update_by_idEmp(), PDO::PARAM_STR);
		$query->bindValue(':ID_Category', $product->id_category(), PDO::PARAM_STR);

		$query->execute();
	}

	public function setDb($db)
	{
		$this->_db=$db;
	}
}
?>