<?php
class FeedbackManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function add(IsOrdered $feedback)
	{
		$query = $this->_db->prepare('INSERT INTO Feedback(ID_Product, ID_Client, Review, Comment, Date_feedback) VALUES(:ID_Product, :ID_Client, :Review, :Comment, :Date_feedback');
		$query->bindValue(':ID_Product', $feedback->idProduct(), PDO::PARAM_INT);
		$query->bindValue(':ID_Client', $feedback->idClient(), PDO::PARAM_INT);
		$query->bindValue(':Review', $feedback->review(), PDO::PARAM_INT);
		$query->bindValue(':Comment', $feedback->comment(), PDO::PARAM_STR);
		$query->bindValue(':Date_feedback', $feedback->dateFeedback(), PDO::PARAM_STR);
		$query->execute();
	}

	public function delete(Feedback $feedback)
	{
		$this->_db->exec('DELETE FROM Feedback WHERE ID_Product = '.$feedback->idOrder().' ID_Client = '.$isOrdered->idClient());
	}

	public function getId($idProduct, $idClient)
	{
		$idProduct = (int) $idProduct;
		$idClient = (int) $idClient;
		$query = $this->_db->prepare('SELECT * FROM Feedback WHERE ID_Product = '.$idProduct.' ID_Product = '.$idClient);
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		return new Feedback($donnees);
	}

	public function getProduct($id)
	{
		$id = (int) $id;
		$feedback = [];
		$query = $this->_db->query('SELECT * FROM Feedback WHERE ID_Product = '.$id.' ORDER BY ID_Product');
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
			$feedback[] = new Feedback($donnees);
		}
		return $feedback;
	}

	public function getClient($id)
	{
		$id = (int) $id;
		$feedback = [];
		$query = $this->_db->query('SELECT * FROM Feedback WHERE ID_Client = '.$id.' ORDER BY ID_Client');
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
			$feedback[] = new Feedback($donnees);
		}
		return $feedback;
	}

	public function getList()
	{
		$feedback = [];
		$query = $this->_db->query('SELECT * FROM Feedback ORDER BY ID_Product');
		while ($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
			$feedback[] = new Feedback($donnees);
		}
		return $feedback;
	}

	public function update(Feedback $feedback)
	{
		$query = $this->_db->prepare('UPDATE Feedback SET Review = :Review, Comment = :Comment, Date_feedback = :Date_feedback WHERE ID_Product = :ID_Product AND ID_Client = :ID_Client');
		$query->bindValue(':ID_Product', $feedback->idProduct(), PDO::PARAM_INT);
		$query->bindValue(':ID_Client', $feedback->idClient(), PDO::PARAM_INT);
		$query->bindValue(':Review', $feedback->review(), PDO::PARAM_INT);
		$query->bindValue(':Comment', $feedback->comment(), PDO::PARAM_STR);
		$query->bindValue(':Date_feedback', $feedback->dateFeedback(), PDO::PARAM_STR);
		$query->execute();
	}

	public function setDb($db)
	{
		$this->$_db $db;
	}
}
?>