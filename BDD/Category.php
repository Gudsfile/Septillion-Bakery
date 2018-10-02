<?php
class Category
{
	private $_id_category;
	private $_name_category;
	private $_description;
	private $_icon_category;
	private $_created_by_idEmp;
	
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

	public function nameCategory() { return $this->_name_category; }

	public function description() { return $this->_description; }

	public function iconCategory() { return $this->_icon_category; }

	public function createdByIdEmp() { return $this->_created_by_idEmp; }


	public function setId($id) 
	{
		$id = (int) $id;
		if ($id > 0) {
			$this->_id_category = $id;
		}
	}

	public function setNameCategory($name) 
	{
		if (is_string($name)) {
			$this->_name_category = $name;
		}
	}

	public function setIcon($icon) 
	{
		if (is_string($icon)) {
			$this->_icon_category= $icon;
		}
	}

	public function SetCreatedByIdEmp($created_by_idEmp) 
	{
		if (is_string($created_by_idEmp)) {
			$this->_created_by_idEmp = $created_by_idEmp;
		}
	}
}
?>