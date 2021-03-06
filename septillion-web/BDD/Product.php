<?php
class Product
{
	private $_id_product;
	private $_name;
	private $_stock;
	private $_description;
	private $_price;
	private $_created_by;
	private $_last_updated_by;
	private $_id_category;
	private $_id_img;

	public function __construct($value = array())
  {
    if(!empty($value))
      $this->hydrate($value);
  }

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

	public function name() { return $this->_name; }

	public function stock() { return $this->_stock; }

	public function description() { return $this->_description; }

	public function price() { return $this->_price; }

	public function created_by() { return $this->_created_by; }

	public function last_updated_by() { return $this->_last_updated_by; }

	public function id_category() { return $this->_id_category; }

	public function id_img() { return $this->_id_img; }

	public function setId_product($id)
	{
		$id = (int) $id;
		if ($id > 0) {
			$this->_id_product = $id;
		}
	}

	public function setName($name)
	{
		if (is_string($name)) {
			$this->_name = $name;
		}
	}

	public function setStock($stock)
	{
		if (is_numeric($stock)) {
			$this->_stock= $stock;
		}
	}

	public function setDescription($description)
	{
		if (is_string($description)) {
			$this->_description= $description;
		}
	}

	public function setPrice($price)
	{
		if (is_string($price)) {
			$this->_price = $price;
		}
	}

	public function setCreated_by($created_by)
	{
		if (is_numeric($created_by)) {
			$this->_created_by = $created_by;
		}
	}

	public function setLast_updated_by($last_updated_by)
	{
		if (is_numeric($last_updated_by)) {
			$this->_last_updated_by = $last_updated_by;
		}
	}

	public function setId_category($id_category)
	{
		if (is_numeric($id_category)) {
			$this->_id_category = $id_category;
		}
	}

	public function setId_img($image)
	{
		if (is_numeric($image)) {
			$this->_id_img = $image;
		}
	}
}
?>
