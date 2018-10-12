<?php
class Feedback
{
	private $_id_product;
	private $_id_client;
	private $_grade;
	private $_comment;
	private $_submit_date;

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

	public function id_product() { return $this->_id_product; }

	public function id_client() { return $this->_id_client; }

	public function grade() { return $this->_grade; }

	public function comment() { return $this->_comment; }

	public function submit_date() { return $this->_submit_date; }

	public function setId_product($id) {
		$this->_id_product = $id;
	}

	public function setId_client($id) {
		$this->_id_client = $id;
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
		$mysqldate = date( 'Y-m-d H:i:s', strtotime( $submit_date));
		$this->_submit_date = $mysqldate;
	}
}
?>
