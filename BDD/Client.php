<?php
class Client 
{
	private $_id_client;
	private $_mail;
	private $_password;
	private $_first_Name;
	private $_last_name;
	private $_adress;
	private $_phone_number;

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

	public function firstName() { return $this->_first_Name; }

	public function lastName() { return $this->_last_name; }

	public function adress() { return $this->_adress; }

	public function phoneNumber() { return $this->_phone_number; }

	public function setId($id) 
	{
		$id = (int) $id;
		if ($id > 0) {
			$this->_id_Client = $id;
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

	public function setFirstName($firstName) 
	{
		if (is_string($firstName)) {
			$this->_first_Name = $firstName;
		}
	}

	public function setLastName($lastName) 
	{
		if (is_string($lastName)) {
			$this->_last_name = $lastName;
		}
	}

	public function setAdress($adress) 
	{
		if (is_string($adress)) {
			$this->_adress = $adress;
		}
	}

	public function setPhoneNumber($phoneNumber) 
	{
		if (is_string($phoneNumber) && is_numeric($phoneNumber)) {
			$this->_phone_number = $phoneNumber;
		}
	}
}
?>