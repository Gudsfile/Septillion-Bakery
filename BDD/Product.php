<?php
class Product
{
	private $_id_product;
	private $_name_product;
	private $_stock_quantity;
	private $_description;
	private $_price;
	private $_iamge;
	private $_created_by_idEmp;
	private $_last_update_by_idEmp;
	private $_id_category;

	public function hydrate(array $donnees) 
	{
		foreach ($donnees as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function id() { return $this->_id_product; }

	public function name_product() { return $this->_name_product; }

	public function stock_quantity() { return $this->_stock_quantity; }

	public function price() { return $this->_price; }

	public function image { return $this->_iamge; }

	public function created_by_idEmp() { return $this->_created_by_idEmp; }

	public function last_update_by_idEmp() { return $this->_last_update_by_idEmp; }

	public function id_category() { return $this->_id_category; }

	public function setId($id) 
	{
		$id = (int) $id;
		if ($id > 0) {
			$this->_id_product = $id;
		}
	}

	public function setName_product($name) 
	{
		if (is_string($name)) {
			$this->_name_product = $name;
		}
	}

	public function settock_quantity($stock_quantity) 
	{
		if (is_string($stock_quantity)) {
			$this->_stock_quantity= $stock_quantity;
		}
	}
	public function setDescription($description) 
	{
		if (is_string($description)) {
			$this->_description= $_description;
		}
	}

	public function setPrice($price) 
	{
		if (is_string($price)) {
			$this->_price = $price;
		}
	}

	public function setImage($image) 
	{
		if (is_string($image)) {
			$this->_iamge = $image;
		}
	}

	public function SetCreated_by_idEmp($created_by_idEmp) 
	{
		if (is_string($created_by_idEmp)) {
			$this->_created_by_idEmp = $created_by_idEmp;
		}
	}
	public function setLast_update_by_idEmp($last_update_by_idEmp) 
	{
		if (is_string($last_update_by_idEmp)) {
			$this->_last_update_by_idEmp = $last_update_by_idEmp;
		}
	}
	public function setId_category($_id_category) 
	{
		if (is_string($id_category) && is_numeric($phoneNumber)) {
			$this->_id_category = $id_category;
		}
	}
}
?>