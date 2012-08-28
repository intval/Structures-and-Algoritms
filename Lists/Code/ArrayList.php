<?php
// this is cheaty, since arrays in php are actually hashsets with unlimited size
class ArrayList
{
	private $data = [];

	public function add($object)
	{
		$this->data[] = $object;
	}


	public function contains($object)
	{
		return in_array($object, $this->data, true);
	}


	public function count()
	{
		return sizeof($this->data);
	}


	public function remove($object)
	{
		$key = array_search($object, $this->data, true);
		if(false !== $key)
			unset($this->data[$key]);
	}
}
