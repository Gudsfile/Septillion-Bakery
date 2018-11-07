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
		$query = $this->_db->prepare("INSERT INTO PRODUCT(NAME, STOCK, DESCRIPTION, PRICE, CREATED_BY, LAST_UPDATED_BY ,ID_CATEGORY, ID_IMG) VALUES (:name, :stock, :description, :price, :created_by, :last_updated_by, :id_category, :id_img)");
		$query->bindValue(':name', $product->name(), PDO::PARAM_STR);
		$query->bindValue(':stock', $product->stock(), PDO::PARAM_INT);
		$query->bindValue(':description', $product->description(), PDO::PARAM_STR);
		$query->bindValue(':price', $product->price(), PDO::PARAM_STR);
		$query->bindValue(':created_by', $product->created_by(), PDO::PARAM_INT);
		$query->bindValue(':last_updated_by', $product->last_updated_by(), PDO::PARAM_INT);
		$query->bindValue(':id_category', $product->id_category(), PDO::PARAM_INT);
		$query->bindValue(':id_img', $product->id_img(), PDO::PARAM_INT);
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
		$query = $this->_db->query("SELECT * FROM PRODUCT WHERE ID_PRODUCT = ".$id);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new Product($donnees);
	}

	public function getCreatedBy($id)
	{
		$id = (int) $id;
		$product = [];
		$query = $this->_db->query("SELECT * FROM PRODUCT WHERE CREATED_BY = ".$id." ORDER BY ID_PRODUCT");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$product[] = new Product($donnees);
		}
		return $product;
	}

	public function getLastUpdatedBy($id)
	{
		$id = (int) $id;
		$product = [];
		$query = $this->_db->query("SELECT * FROM PRODUCT WHERE LAST_UPDATED_BY = ".$id." ORDER BY ID_PRODUCT");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$product[] = new Product($donnees);
		}
		return $product;
	}

	public function getCategory($id)
	{
		$id = (int) $id;
		$product = [];
		$query = $this->_db->query("SELECT * FROM PRODUCT WHERE ID_CATEGORY = ".$id." ORDER BY ID_PRODUCT");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$product[] = new Product($donnees);
		}
    return $product;
	}

	public function getList()
	{
		$product = [];
		$query = $this->_db->query("SELECT * FROM PRODUCT ORDER BY ID_PRODUCT");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$product[] = new Product($donnees);
		}
    return $product;
	}

	public function getListByName()
	{
		$product = [];
		$query = $this->_db->query("SELECT * FROM PRODUCT ORDER BY NAME");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$product[] = new Product($donnees);
		}
    return $product;
	}

	public function getListByPrice()
	{
		$product = [];
		$query = $this->_db->query("SELECT * FROM PRODUCT ORDER BY PRICE");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$product[] = new Product($donnees);
		}
		return $product;
	}

	public function getCategoryOrderByName($id)
	{
		$product = [];
		$query = $this->_db->query("SELECT * FROM PRODUCT WHERE ID_CATEGORY = ".$id." ORDER BY NAME");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$product[] = new Product($donnees);
		}
		return $product;
	}

	public function getCategoryOrderByPrice($id)
	{
		$product = [];
		$query = $this->_db->query("SELECT * FROM PRODUCT WHERE ID_CATEGORY = ".$id." ORDER BY PRICE");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$product[] = new Product($donnees);
		}
		return $product;
	}

	public function update($id, Product $newProduct)
	{
    $query = $this->_db->prepare("UPDATE PRODUCT SET NAME=:name, STOCK=:stock, DESCRIPTION=:description, PRICE=:price, CREATED_BY=:created_by, LAST_UPDATED_BY=:last_updated_by, ID_CATEGORY=:id_category, ID_IMG=:id_img WHERE ID_PRODUCT=:id");
    $query->bindValue(':id',$id , PDO::PARAM_INT);
		$query->bindValue(':name', $product->name(), PDO::PARAM_STR);
		$query->bindValue(':stock', $product->stock(), PDO::PARAM_INT);
		$query->bindValue(':description', $product->description(), PDO::PARAM_STR);
		$query->bindValue(':price', $product->price(), PDO::PARAM_STR);
		$query->bindValue(':created_by', $product->created_by(), PDO::PARAM_INT);
		$query->bindValue(':last_updated_by', $product->last_updated_by(), PDO::PARAM_INT);
		$query->bindValue(':id_category', $product->id_category(), PDO::PARAM_INT);
		$query->bindValue(':id_img', $product->image(), PDO::PARAM_INT);
		$query->execute();
	}

	public function setDb($db)
	{
		$this->_db = $db;
	}
}
?>
