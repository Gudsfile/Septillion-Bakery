<?php
class CategoryManager
{
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function add(Category $category)
	{
		$query = $this->_db->prepare("INSERT INTO CATEGORY(NAME, DESCRIPTION, ICON, CREATED_BY) VALUES (:name, :description, :icon, :created_by)");

		$query->bindValue(':name', $category->name());
		$query->bindValue(':description', $category->description(), PDO::PARAM_STR);
		$query->bindValue(':icon', $category->icon(), PDO::PARAM_STR);
		$query->bindValue(':created_by', $category->created_by(), PDO::PARAM_STR);
		$query->execute();
		return $this->_db->lastInsertId();
	}

	public function delete($id)
	{
		$id = (int) $id;
		$query = $this->_db->prepare("DELETE FROM CATEGORY WHERE ID_CATEGORY=:id");
		$query->bindValue(':id', $id);
		$query->execute();
	}

	public function get($id)
	{
		$id = (int) $id;
		$query = $this->_db->query("SELECT * FROM CATEGORY WHERE ID_CATEGORY =".$id);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new Category($donnees);
	}

	public function getCreatedBy($id)
	{
		$id = (int) $id;
		$category = [];
		$query = $this->_db->query("SELECT * FROM CATEGORY WHERE CREATED_BY =".$id);
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$category[] = new Category($donnees);
		}
    return $category;
	}

	public function getList()
	{
		$category = [];
		$query = $this->_db->query("SELECT * FROM CATEGORY ORDER BY ID_CATEGORY");
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$category[] = new Category($donnees);
		}
    return $category;
	}

	public function update($id, Category $newCategory)
	{
    $query = $this->_db->prepare("UPDATE CATEGORY SET NAME=:name,DESCRIPTION=:description,ICON=:icon,CREATED_BY=:created_by WHERE ID_CATEGORY = :id");
    $query->bindValue(':id', $id, PDO::PARAM_INT);
		$query->bindValue(':name', $newCategory->name());
		$query->bindValue(':description', $newCategory->description(), PDO::PARAM_STR);
		$query->bindValue(':icon', $newCategory->icon(), PDO::PARAM_STR);
		$query->bindValue(':created_by', $newCategory->created_by(), PDO::PARAM_STR);

		$query->execute();
	}

	public function setDb($db)
	{
		$this->_db=$db;
	}
}
?>
