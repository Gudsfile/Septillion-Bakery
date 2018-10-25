<?php
class Newsletter
{
	private $_id_mail;
	private $_mail;

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

	public function id() { return $this->_id_mail; }

	public function mail() { return $this->_mail; }


	public function setId_mail($id)
	{
		$id = (int) $id;
		if ($id > 0) {
			$this->_id_mail = $id;
		}
	}

	public function setMail($mail)
	{
		if (is_string($mail) && filter_var($mail, FILTER_VALIDATE_EMAIL)) {
			$this->_mail = $mail;
		}
	}
}
?>
