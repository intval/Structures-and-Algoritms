<?php

class FixedArrayList
{
	
	private $arr;
	private $end = 0;
	private $count = 0;

	public function __construct()
	{
		$this->arr = new SplFixedArray(2);
	}

	public function add($object)
	{
		if($this->end === sizeof($this->arr)) 
			$this->increaseArraySize();

		$this->arr[$this->end++] = $object;	
		$this->count++;
	}


	public function contains($object)
	{
		foreach($this->arr as $o)
			if($o === $object)
				return true;

		return false;
	}


	public function count()
	{
		return $this->count;
	}


	public function remove($object)
	{
		foreach($this->arr as $key => $val)
			if($val === $object)
			{
				$this->arr[$key] = null;
				$this->count--;

				if($this->count * 4 <= sizeof($this->arr))
					$this->decreaseArraySize();

				return true;
			}

		return false;
	}


	private function increaseArraySize()
	{
		$this->createNewArrayOfSize(2 * sizeof($this->arr));
	}

	private function decreaseArraySize()
	{
		$this->createNewArrayOfSize(0.5 * sizeof($this->arr));
	}

	private function createNewArrayOfSize($newSize)
	{
		$newArr = new SplFixedArray($newSize);
		$i = 0;

		foreach ($this->arr as $key => $value) 
			if($value !== null)
				$newArr[$i++] = $value;
			

		$this->arr = $newArr;
		$this->end = $this->count;
	}
}
