<?php
class Message
{
	private $_id_message;
	private $_message_object;
	private $_body;
  private $_sent_date;
	private $_id_sender;
	private $_id_receiver;

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

	public function id() { return $this->_id_message; }

	public function message_object() { return $this->_message_object; }

	public function body() { return $this->_body; }

  public function sent_date() { return $this->_sent_date; }

	public function id_sender() { return $this->_id_sender; }

	public function id_receiver() { return $this->_id_receiver; }

	public function setId_message($id)
	{
		$id = (int) $id;
		if ($id > 0) {
			$this->_id_message = $id;
		}
	}

  public function setMessage_object($message_object)
	{
		if (is_string($message_object)) {
			$this->_message_object = $message_object;
		}
	}

  public function setBody($body)
	{
		if (is_string($body)) {
			$this->_body = $body;
		}
	}

	public function setSent_date($sent_date)
	{
		$phpdate = strtotime( $sent_date);
		$mysqldate = date( 'Y-m-d H:i:s', $phpdate );
		$this->_sent_date = $mysqldate;
	}

  public function setId_sender($id)
  {
  	if (is_numeric($id)) {
  	  $this->_id_sender = $id;
  	}
  }

	public function setId_receiver($id)
	{
		if (is_numeric($id)) {
			$this->_id_receiver = $id;
		}
	}
}
?>
