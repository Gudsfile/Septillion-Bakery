<?php
class FeedbackManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function add(Feedback $feedback)
	{
		$query = $this->_db->prepare("INSERT INTO FEEDBACK(ID_PRODUCT, ID_CLIENT, GRADE, COMMENT) VALUES(:id_product, :id_client, :grade, :comment)");
		$query->bindValue(':id_product', $feedback->id_product(), PDO::PARAM_INT);
		$query->bindValue(':id_client', $feedback->id_client(), PDO::PARAM_INT);
		$query->bindValue(':grade', $feedback->grade(), PDO::PARAM_INT);
		$query->bindValue(':comment', $feedback->comment(), PDO::PARAM_STR);
		$query->execute();
	}

	public function delete($id_product, $id_client)
	{
		$id_product = (int) $id_product;
		$id_client = (int) $id_client;
		$query = $this->_db->prepare("DELETE FROM FEEBACK WHERE ID_PRODUCT =:id_product AND ID_CLIENT = :id_client");
		$query->bindValue(':id_product', $id_product);
		$query->bindValue(':id_client', $id_client);
		$query->execute();
	}

	public function getId($id_product, $id_client)
	{
		$id_product = (int) $id_product;
		$id_client = (int) $id_client;
		$query = $this->_db->query("SELECT * FROM FEEDBACK WHERE ID_PRODUCT =".$id_product." AND ID_CLIENT =".$id_client);
		$donnees = $q->fetch(PDO::FETCH_ASSOC);
		return new Feedback($donnees);
	}

	public function getProduct($id)
	{
		$id = (int) $id;
		$feedback = [];
		$query = $this->_db->query("SELECT * FROM FEEDBACK WHERE ID_PRODUCT = ".$id);
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$feedback[] = new Feedback($donnees);
		}
		return $feedback;
	}

	public function getClient($id)
	{
		$id = (int) $id;
		$feedback = [];
		$query = $this->_db->query("SELECT * FROM FEEDBACK WHERE ID_CLIENT = ".$id);
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$feedback[] = new Feedback($donnees);
		}
		return $feedback;
	}

	public function getList()
	{
		$feedback = [];
		$query = $this->_db->query("SELECT * FROM FEEDBACK");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$feedback[] = new Feedback($donnees);
		}
		return $feedback;
	}

	public function update($id_product, $id_client, Feedback $feedback)
	{
		$query = $this->_db->prepare("UPDATE FEEDBACK SET GRADE =:grade, COMMENT =:comment WHERE ID_PRODUCT =:id_product AND ID_CLIENT =:id_client");
		$query->bindValue(':id_product', $id_product, PDO::PARAM_INT);
		$query->bindValue(':id_client', $id_client, PDO::PARAM_INT);
		$query->bindValue(':grade', $feedback->grade(), PDO::PARAM_INT);
		$query->bindValue(':comment', $feedback->comment(), PDO::PARAM_STR);
		$query->execute();
	}

	public function setDb($db)
	{
		$this->_db = $db;
	}
}
?>
