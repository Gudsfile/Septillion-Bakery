<?php
class IsOrdered
{
	private $_id_order;
	private $_id_product;
	private $_quantity

	public function hydrate(array $donnees)
	{
		foreach ($donnees as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	public function id_order() { return $this->_id_order; }

	public function id_product() { return $this->_id_product; }

	public function quantity() { return $this->_quantity; }

	public function setId_order(Order $order) {
		$this->_id_order = $order->id();
	}

	public function setId_product(Product $product) {
		$this->_id_product = $product->id();
	}

	public function setQuantity($quantity)
	{
		$quantity = (int) $quantity;
		if ($quantity > 0) {
			$this->_quantity = $quantity;
		}
	}
}
?>
