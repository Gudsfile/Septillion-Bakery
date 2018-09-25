<?php
class OrderClient 
{
	private $_id_order;
	private $_date;
	private $_description
	private $_price;
	private $_client;

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

	public function client() { return $this->_client; }	

	public function setId($id) 
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
		$this->_date = $time;
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

	public function setClient(Client $client) 
	{
		if (!is_null($client) {
			$this->_client = $client;
		}
	}
}
?>