<?php
class OrderClient 
{
	private $_id_order;
	private $_date;
	private $_description;
	private $_price;
	private $_validated;
	private $_ready;
	private $_collected;
	private $_id_client;
	private $_id_employee;

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

	public function id() { return $this->_id_order; }

	public function date() { return $this->_date; }

	public function description() { return $this->_description; }

	public function price() { return $this->_price; }

	public function validated() { return $this->_validated; }

	public function ready() { return $this->_ready; }

	public function collected() { return $this->_collected; }

	public function client() { return $this->_id_client; }	

	public function employee() { return $this->_id_employee; }

	public function setId_order($id) 
	{
		$id = (int) $id;
		if ($id > 0) {
			$this->_id_order = $id;
		}
	}

	public function setDate($date) 
	{
		$time = strtotime($date);
		$newformat = date('Y-m-d',$time);
		$this->_date = $date;
	}

	public function setDescription($description) 
	{
		if (is_string($description)) {
			$this->_description = $description;
		}
	}

	public function setPrice($price) 
	{
		$price = (int) $price;
		if ($price > 0) {
			$this->_price = $price;
		}
	}

	public function setValidated($isValid) 
	{
		$this->_validated = $isValid;
	}

	public function setReady($isReady) 
	{
		$this->_ready = $isReady;
	}

	public function setCollected($isCollected) 
	{
		$this->_collected = $isCollected;
	}

	public function setId_Client($idClient) 
	{
		if (is_numeric($idClient)) {
			$this->_id_client = $idClient;
		}
	}

	public function setId_Employee($idEmployee) 
	{
		if (is_numeric($idEmployee)) {
			$this->_id_employee = $idEmployee;
		}
	}

}
?>