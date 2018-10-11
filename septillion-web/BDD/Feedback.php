<?php
class Feedback
{
	private $_id_product;
	private $_id_client;
	private $_grade;
	private $_comment;
	private $_submit_date;

	public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function id_product() { return $this->$_id_product; }

	public function id_client() { return $this->_id_client; }

	public function grade() { return $this->_grade; }

	public function comment() { return $this->_comment; }

	public function submit_date() { return $this->_submit_date; }

	public function setId_order(Order $order) {
		$this->_id_order = $order->id();
	}

	public function setId_client(Client $client) {
		$this->_id_client = $client->id();
	}

	public function setGrade($grade)
	{
		$grade = (int) $grade;
		if ($grade >= 1 && $grade <= 5) {
			$this->_grade = $grade;
		}
	}

	public function setComment($comment)
	{
		if (is_string($comment)) {
			$this->_comment = $comment;
		}
	}

	public function setSubmit_date($submit_date)
	{
		$time = strtotime($submit_date);
		$newformat = date('Y-m-d',$time);
		$this->_submit_date = $time;
	}
}
?>
