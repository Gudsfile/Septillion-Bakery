<?php
class Client
{
	private $_id_client;
	private $_mail;
	private $_password;
	private $_first_name;
	private $_last_name;
	private $_address;
	private $_phone_number;

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

	public function id() { return $this->_id_client; }

	public function mail() { return $this->_mail; }

	public function password() { return $this->_password; }

	public function first_name() { return $this->_first_name; }

	public function last_name() { return $this->_last_name; }

	public function address() { return $this->_address; }

	public function phone_number() { return $this->_phone_number; }

	public function setId_client($id)
	{
		$id = (int) $id;
		if ($id > 0) {
			$this->_id_client = $id;
		}
	}

	public function setMail($mail)
	{
		if (is_string($mail) && filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			$this->_mail = $mail;
		}
	}

	public function setPassword($password)
	{
		if (is_string($password)) {
			$this->_password = $password;
		}
	}

	public function setFirst_name($first_name)
	{
		if (is_string($first_name)) {
			$this->_first_name = $first_name;
		}
	}

	public function setLast_name($last_name)
	{
		if (is_string($last_name)) {
			$this->_last_name = $last_name;
		}
	}

	public function setAddress($address)
	{
		if (is_string($address)) {
			$this->_address = $address;
		}
	}

	public function setPhone_number($phone_number)
	{
		if (is_string($phone_number) && is_numeric($phone_number)) {
			$this->_phone_number = $phone_number;
		}
	}
}
?>
