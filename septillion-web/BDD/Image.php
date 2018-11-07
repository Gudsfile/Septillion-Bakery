<?php
class Image
{

	private $_id_img;
	private $_name;
	private $_size;
	private $_type;
	private $_image;

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

	public function id_img() { return $this->_id_img; }

	public function name() { return $this->_name; }

	public function size() { return $this->_size; }

	public function type() { return $this->_type; }

  public function image() { return $this->_image; }

	public function setId_img($id)
	{
		$id = (int) $id;
		if ($id > 0) {
			$this->_id_img = $id;
		}
	}

	public function setName($name)
	{
		if (is_string($name)) {
			$this->_name = $name;
		}
	}

  public function setSize($size)
	{
    $size = (int) $size;
		if ($size > 0) {
			$this->_size = $size;
		}
	}

  public function setType($type)
	{
		if (is_string($type)) {
			$this->_type = $type;
		}
	}

	public function setImage($image)
	{
		$this->_image = $image;
	}
}
?>
