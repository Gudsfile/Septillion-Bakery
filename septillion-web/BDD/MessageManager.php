<?php
class MessageManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

  public function add(Message $message)
	{
		$query = $this->_db->prepare("INSERT INTO MESSAGE(OBJECT, BODY, ID_SENDER, ID_RECEIVER) VALUES (:object, :body, :id_sender, :id_receiver)");
		$query->bindValue(':object', $message->object(), PDO::PARAM_STR);
		$query->bindValue(':body', $message->body(), PDO::PARAM_INT);
		$query->bindValue(':id_sender', $message->id_sender(), PDO::PARAM_INT);
		$query->bindValue(':id_receiver', $message->id_receiver(), PDO::PARAM_INT);
		$query->execute();
		return $this->_db->lastInsertId();
	}

  public function delete($id)
	{
		$id = (int) $id;
		$query = $this->_db->prepare("DELETE FROM MESSAGE WHERE ID_MESSAGE=:id");
		$query->bindValue(':id', $id);
		$query->execute();
	}

  public function get($id)
  {
    $id = (int) $id;
    $query = $this->_db->query("SELECT * FROM MESSAGE WHERE ID_MESSAGE = ".$id);
    $donnees = $query->fetch(PDO::FETCH_ASSOC);
    print_r($donnees);
    return new Message($donnees);
  }

  public function getBySender($id)
  {
    $message = [];
    $query = $this->_db->query("SELECT * FROM MESSAGE WHERE ID_SENDER =".$id);
    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
      $message[] = new Message($donnees);
    }
    return $message;
  }

  public function getByReceiver($id)
  {
    $message = [];
    $query = $this->_db->query("SELECT * FROM MESSAGE WHERE ID_RECEIVER =".$id);
    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
      $message[] = new Message($donnees);
    }
    return $message;
  }

  public function getList()
  {
    $message = [];
    $query = $this->_db->query("SELECT * FROM MESSAGE ORDER BY ID_MESSAGE");
    while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
      $message[] = new Message($donnees);
    }
    return $message;
  }

  public function setDb($db)
  {
    $this->_db = $db;
  }
}
?>
