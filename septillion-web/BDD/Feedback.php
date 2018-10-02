<?php
class Feedback 
{
	private $_id_order;
	private $_id_client;
	private $_review;
	private $_comment;
	private $_date_feedback;

	public function hydrate(array $donnees) 
	{
		foreach ($donnees as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function idOrder() { return $this->_id_order; }

	public function idClient() { return $this->_id_client; }

	public function review() { return $this->_review; }

	public function comment() { return $this->_comment; }

	public function dateFeedback() { return $this->_date_feedback; }

	public function setIdOrder(Order $order) {
		$this->_id_order = $order->id();
	}

	public function setIdClient(Client $client) {
		$this->_id_client = $client->id();
	}

	public function setReview($review) 
	{
		$review = (int) $review;
		if ($review >= 1 && $review <= 5) {
			$this->_review = $sreview;
		}
	}

	public function setComment($comment) 
	{
		if (is_string($comment)) {
			$this->_comment = $comment;
		}
	}

	public function setDateFeedback($dateFeedback) 
	{
		$time = strtotime($dateFeedback);
		$newformat = date('Y-m-d',$time);
		$this->_date_feedback = $time;
	}
}
?>