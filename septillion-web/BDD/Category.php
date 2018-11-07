<?php
class Category
{

	private $_id_category;
	private $_name;
	private $_description;
	private $_created_by;

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

	public function id() { return $this->_id_category; }

	public function name() { return $this->_name; }

	public function description() { return $this->_description; }

	public function created_by() { return $this->_created_by; }

	public function setId_category($id)
	{
		$id = (int) $id;
		if ($id > 0) {
			$this->_id_category = $id;
		}
	}

	public function setName($name)
	{
		if (is_string($name)) {
			$this->_name = $name;
		}
	}

	public function setDescription($desc)
	{
		if (is_string($desc)) {
			$this->_description = $desc;
		}
	}

	public function SetCreated_by($created_by)
	{
		if (is_numeric($created_by)) {
			$this->_created_by = $created_by;
		}
	}
}
?>
