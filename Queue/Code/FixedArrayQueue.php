<?php

class FixedArrayQueue
{

	private $arr;
	private $nextEmptyIndex = 0;
	private $firstIndex = 0;

	public function __construct()
	{
		$this->arr = new SplFixedArray(2);
	}

	public function enqueue($value)
	{
		$this->arr[$this->nextEmptyIndex++] = $value;

		if($this->nextEmptyIndex >= sizeof($this->arr))
			$this->extendArray();

		
	}

	public function dequeue()
	{
		if($this->firstIndex >= $this->nextEmptyIndex)
			throw new OutOfBoundsException("Cannod dequeue an empty stack");

		$data = $this->arr[$this->firstIndex++];

		if( $this->count() * 4 <= sizeof($this->arr))
			$this->collapseArray();

		return $data;
	}

	public function count()
	{
		return $this->nextEmptyIndex - $this->firstIndex ;
	}

	private function extendArray()
	{
		$this->changeArraySize(2 * sizeof($this->arr));
	}

	private function collapseArray()
	{
		$this->changeArraySize(0.5 * sizeof($this->arr));
	}

	private function changeArraySize($newSize)
	{
		$newArr = new SplFixedArray($newSize);
		$j = 0;

		for($i = $this->firstIndex; $i < $this->nextEmptyIndex; $i++)
			$newArr[$j++] = $this->arr[$i];

		$this->arr = $newArr;
		$this->firstIndex = 0;
		$this->nextEmptyIndex = $j;

	}
}
