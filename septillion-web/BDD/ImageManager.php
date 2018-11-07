<?php
class ImageManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function add(Image $image)
	{
		$query = $this->_db->prepare("INSERT INTO IMAGE(NAME, SIZE, TYPE, IMAGE) VALUES (:name, :size, :type, :image)");

		$query->bindValue(':name', $image->name());
		$query->bindValue(':size', $image->size(), PDO::PARAM_INT);
		$query->bindValue(':type', $image->type(), PDO::PARAM_STR);
		$query->bindValue(':image', $image->image(), PDO::PARAM_STR);
		$query->execute();
		return $this->_db->lastInsertId();
	}

	public function delete($id)
	{
		$id = (int) $id;
		$query = $this->_db->prepare("DELETE FROM IMAGE WHERE ID_IMG=:id");
		$query->bindValue(':id', $id);
		$query->execute();
	}

	public function get($id)
	{
		$id = (int) $id;
		$query = $this->_db->query("SELECT * FROM IMAGE WHERE ID_IMG =".$id);
		$donnees = $query;//->fetch(PDO::FETCH_ASSOC);
		return new IMAGE($donnees);
	}

	public function getList()
	{
		$images = [];
		$query = $this->_db->query("SELECT * FROM IMAGE ORDER BY ID_IMG");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$images[] = new Image($donnees);
		}
    return $images;
	}

	public function setDb($db)
	{
		$this->_db=$db;
	}
}
?>
