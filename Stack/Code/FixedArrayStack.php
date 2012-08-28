<?php

class FixedArrayStack
{

	private $arr;
	private $indexOfLastItem = -1;

	public function __construct()
	{
		 $this->arr = new SplFixedArray(2);
	}

	public function push($val)
	{
		if($this->indexOfLastItem + 1 >= sizeof($this->arr))
			$this->expandArray();

		$this->arr[++$this->indexOfLastItem] = $val;
	}

	public function pop()
	{
		if($this->indexOfLastItem < 0)
			throw new OutOfBoundsException("Cannot pop an empty stack");

		$data = $this->arr[$this->indexOfLastItem];
		$this->arr[$this->indexOfLastItem--] = null;

		if($this->indexOfLastItem * 4 < sizeof($this->arr))
			$this->collapseArray();

		return $data;
	}

	public function count()
	{
		return $this->indexOfLastItem + 1;
	}

	private function expandArray()
	{
		$this->changeArraySize(2 * sizeof($this->arr));
	}

	private function collapseArray()
	{
		$this->changeArraySize(.5 * sizeof($this->arr));
	}

	private function changeArraySize($newSize)
	{
		$newArray = new SplFixedArray($newSize);
		for($i = 0, $c = $this->count(); $i < $c; $i++)
			$newArray[$i] = $this->arr[$i];

		$this->arr = $newArray;
	}
}
