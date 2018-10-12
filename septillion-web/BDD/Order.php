<?php
class Order
{
	private $_id_order;
	private $_order_date;
	private $_description;
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

	public function order_date() { return $this->_order_date; }

	public function description() { return $this->_description; }

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

	public function setOrder_date($order_date)
	{
		$phpdate = strtotime( $order_date);
		$mysqldate = date( 'Y-m-d H:i:s', $phpdate );
		$this->_order_date = $mysqldate;
	}

	public function setDescription($description)
	{
		if (is_string($description)) {
			$this->_description = $description;
		}
	}

	public function setValidated($isValid)
	{
		if ($isValid == 0 || $isValid == 1)
			$this->_validated = $isValid;
	}

	public function setReady($isReady)
	{
		if ($isReady == 0 || $isReady == 1)
			$this->_ready = $isReady;
	}

	public function setCollected($isCollected)
	{
		if ($isCollected == 0 || $isCollected == 1)
			$this->_collected = $isCollected;
	}

	public function setId_client($idClient)
	{
		if (is_numeric($idClient)) {
			$this->_id_client = $idClient;
		}
	}

	public function setId_employee($idEmployee)
	{
		if (is_numeric($idEmployee)) {
			$this->_id_employee = $idEmployee;
		}
	}
}
?>
