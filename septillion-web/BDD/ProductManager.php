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
		$query = $this->_db->prepare("INSERT INTO PRODUCT(NAME, STOCK, DESCRIPTION, PRICE, IMAGE, CREATED_BY, LAST_UPDATED_BY ,ID_CATEGORY) VALUES (:name, :stock, :description, :price, :image, :created_by, :last_updated_by, :id_category)");
		$query->bindValue(':name', $product->name());
		$query->bindValue(':stock', $product->stock(), PDO::PARAM_STR);
		$query->bindValue(':description', $product->description(), PDO::PARAM_STR);
		$query->bindValue(':price', $product->price(), PDO::PARAM_STR);
		$query->bindValue(':image', $product->image(), PDO::PARAM_STR);
		$query->bindValue(':created_by', $product->created_by(), PDO::PARAM_STR);
		$query->bindValue(':last_updated_by', $product->last_updated_by(), PDO::PARAM_STR);
		$query->bindValue(':id_category', $product->id_category(), PDO::PARAM_STR);
		$query->execute();
		return $this->_db->lastInsertId();	
	}
	
	public function delete($id)
	{

		$id = (int) $id;
		$query = $this->_db->prepare("DELETE FROM PRODUCT WHERE ID_PRODUCT=:id");
		$query->bindValue(':id', $id);
		$query->execute();
	}

	public function get($id)
	{
		$id = (int) $id;
		$query = $this->_db->query('SELECT * FROM PRODUCT WHERE ID_PRODUCT = '.$id);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		print_r($donnees);
		return new Product($donnees);

	}

	public function getList()
	{
		$product = [];

		$query = $this->_db->query('SELECT * FROM PRODUCT ORDER BY ID_PRODUCT');
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$product[] = new Product($donnees);
		}
    	return $product;
	}

	public function update($id, Product $newProduct)
	{
    	$query = $this->_db->prepare("UPDATE PRODUCT SET NAME=:name, STOCK=:stock, DESCRIPTION=:description, PRICE=:price, IMAGE=:image, CREATED_BY=:created_by, LAST_UPDATED_BY=:last_updated_by, ID_CATEGORY=:id_category WHERE ID_PRODUCT=:id");
    	$query->bindValue(':id',$id , PDO::PARAM_INT);
		$query->bindValue(':name', $newProduct->name(), PDO::PARAM_STR);
		$query->bindValue(':stock', $newProduct->stock(), PDO::PARAM_STR);
		$query->bindValue(':description', $newProduct->description(), PDO::PARAM_STR);
		$query->bindValue(':price', $newProduct->price(), PDO::PARAM_STR);
		$query->bindValue(':image', $newProduct->image(), PDO::PARAM_STR);
		$query->bindValue(':created_by', $newProduct->created_by(), PDO::PARAM_STR);
		$query->bindValue(':last_updated_by', $newProduct->last_updated_by(), PDO::PARAM_STR);
		$query->bindValue(':id_category', $newProduct->id_category(), PDO::PARAM_STR);

		$query->execute();
	}

	public function setDb($db)
	{
		$this->_db=$db;
	}
}
?>