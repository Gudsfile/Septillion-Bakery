<?php
class newsletterManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function add($mail)
	{
		$query = $this->_db->prepare("INSERT INTO NEWSLETTER(MAIL) VALUES (:mail)");
		$query->bindValue(':mail', $mail, PDO::PARAM_STR);
		$query->execute();
		return $this->_db->lastInsertId();
	}

	public function delete($id)
	{
		$id = (int) $id;
		$query = $this->_db->prepare("DELETE FROM NEWSLETTER WHERE ID_MAIL=:id");
		$query->bindValue(':id', $id);
		$query->execute();
	}

	public function get($id)
	{
		$id = (int) $id;
		$query = $this->_db->query("SELECT * FROM NEWSLETTER WHERE ID_MAIL =".$id);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new NEWSLETTER($donnees);
	}

	public function getList()
	{
		$newsletter = [];
		$query = $this->_db->query('SELECT * FROM NEWSLETTER ORDER BY ID_MAIL');
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$newsletter[] = new Newsletter($donnees);
		}
    	return $newsletter;
	}

	public function setDb($db)
	{
		$this->_db=$db;
	}
}
?>
