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
		$query = $this->_db->prepare('INSERT INTO `category`(`Name_Category`, `Description`, `Icon_Category`, `Created_By_IDEmp`) VALUES (:ID_Category,:Name_Category,:Description,:Icon_Category,:Created_By_IDEmp)');

		$query->bindValue(':Name_Category', $category->nameCategory());
		$query->bindValue(':Description', $category->Description(), PDO::PARAM_STR);
		$query->bindValue(':Icon_Category', $category->iconCategory(), PDO::PARAM_STR);
		$query->bindValue(':Created_By_IDEmp', $category->createdByIdEmp(), PDO::PARAM_STR);

		$query->execute();
		return $this->_db->lastInsertId();	
	}

	public function delete(Category $category)
	{
		$this->_db->exec('DELETE FROM category WHERE ID_Category= '.$category->id());
	}

	public function get($id)
	{
		$id = (int) $id;
		$query = $this->_db->prepare('SELECT * FROM category WHERE ID_Category = '.$id);
		$donnees = $query->fetch(PDO::FETCH_ASSOC);
		return new Category($donnees);
	}

	public function getList()
	{
		$category = [];
		$query = $this->_db->query('SELECT * FROM category ORDER BY ID_Category');
		while ($donnees = $query->fetch(PDO::FETCH_ASSOC)) {
			$category[] = new Category($donnees);
		}
    	return $category;
	}

	public function update(Category $category)
	{
    $query = $this->_db->prepare('UPDATE `category` SET `ID_Category`=:ID_Category,`Name_Category`=:Name_Category,`Description`=:Name_Category,`Icon_Category`=:Icon_Category,`Created_By_IDEmp`=:Created_By_IDEmp WHERE ID_Category = :id');

    $query->bindValue(':id', $category->id(), PDO::PARAM_INT);
		$query->bindValue(':Name_Category', $category->nameCategory());
		$query->bindValue(':Description', $category->Description(), PDO::PARAM_STR);
		$query->bindValue(':Icon_Category', $category->iconCategory(), PDO::PARAM_STR);
		$query->bindValue(':Created_By_IDEmp', $category->createdByIdEmp(), PDO::PARAM_STR);

		$query->execute();
	}

	public function setDb($db)
	{
		$this->_db=$db;
	}
}
?>
