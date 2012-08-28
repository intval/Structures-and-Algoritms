<?php

class SplDoublyLinkedList2 implements Iterator , ArrayAccess , Countable 
{

	private $firstNode = null;
	private $lastNode = null;
	private $count = 0;

	private $iteratorCurrentNode;
	private $iteratorCurrentNodeCount;
	private $iterationMode;

	const IT_MODE_FIFO = 1;
	const IT_MODE_LIFO = 2;
	const IT_MODE_KEEP = 4;
	const IT_MODE_DELETE = 8;

	public function __construct()
	{
		$this->iterationMode = static::IT_MODE_FIFO | static::IT_MODE_KEEP;
	}


	//void push ( mixed $value )
	public function push($value)
	{
		$newNode = new SplDoublyLinkedList2Node($value);
		
		if(null === $this->firstNode) 
			$this->firstNode = $newNode;

		if(null !== $this->lastNode)
			$this->lastNode->next = $newNode;

		$newNode->prev = $this->lastNode;
		$this->lastNode = $newNode;
		$this->count ++;
	}



	//mixed top ( void )
	public function top()
	{
		$last = $this->lastNode;

		if(null === $last)
			throw new OutOfBoundsException("Can't pop/top an empty list");

		return $last->object;
	}

	//mixed pop ( void )
	public function pop()
	{
		$lastNodeValue = $this->top();
		$this->lastNode = $this->lastNode ->prev;
		
		if(null !== $this->lastNode)
			$this->lastNode->next = null;

		$this->count--;
		return $lastNodeValue;
	}




	// mixed bottom ( void )
	public function bottom() 
	{ 
		if(null === $this->firstNode)
			throw new OutOfBoundsException("Can't bottom/shift an empty list");

		return $this->firstNode->object;
	}


	//mixed shift ( void )
	public function shift() 
	{
		$firstNodeValue = $this->bottom();
		$this->firstNode = $this->firstNode->next;
		
		if(null !== $this->firstNode)
			$this->firstNode->prev = null;

		$this->count--;
		return $firstNodeValue;
	}


	//void unshift ( mixed $value )
	public function unshift($value)
	{
		$newNode = new SplDoublyLinkedList2Node($value);
		$newNode->next = $this->firstNode;
		$this->firstNode = $newNode;

		if(null === $this->lastNode)
			$this->lastNode = $newNode;

		$this->count++;
	}



	// bool isEmpty ( void )
	/** Checks whether the doubly linked list is empty. */
	public function isEmpty()
	{
		return null === $this->firstNode;
	}


	

	





	//public string serialize ( void )
	public function serialize() 
	{
		$arr = new SplFixedArray($this->count());
		$node = $this->firstNode;
		$i = 0;

		while(null !== $node)
		{
			$arr[$i++] = $node->object;
			$node = $node->next;
		}

		return json_encode($arr);
	}


	//public void unserialize ( string $serialized )
	public function unserialize($serialized)
	{
		$decoded = json_decode($serialized);
		
		if(null === $decoded) 
			throw new InvalidArgumentException('provided string is not a valid json');

		foreach ($decoded as  $value) 
			$this->push($value);
	}






	/****************************************************/
	/****************************************************/


	/************* COUNTABLE interface *******************/

	//int count ( void )
	public function count()
	{
		return $this->count;
	}


	/************ ARRAYACCESS interface ******************/

	//bool offsetExists ( mixed $index )
	public function offsetExists($index)
	{
		$index = $this->validateNumericIndex($index);
		return $index >= 0 && $index < $this->count();
	}


	//mixed offsetGet ( mixed $index )
	public function offsetGet($index)
	{
		if(!$this->offsetExists($index))
			throw new OutOfRangeException("Offset invalid or out of range");

		$index = $this->validateNumericIndex($index);

		$item = $this->findItemByIndex($index);
		if(null !== $item) return $item->object;
		return null;
	}

	//void offsetSet ( mixed $index , mixed $newval )
	public function offsetSet($index, $newval)
	{
		if(!$this->offsetExists($index))
			throw new OutOfRangeException("Offset invalid or out of range");

		$index = $this->validateNumericIndex($index);
		$node = $this->findItemByIndex($index);

		if(null === $node) return false;
		$node->object = $newval;
		return true;
	}


	//void offsetUnset ( mixed $index )
	public function offsetUnset ($index)
	{
		if(!$this->offsetExists($index))
			throw new OutOfRangeException("Offset invalid or out of range");

		$index = $this->validateNumericIndex($index);
		$item = $this->findItemByIndex($index);

		if(null !== $item->prev)
			$item->prev->next = $item->next;

		if(null !== $item->next)
			$item->next->prev = $item->prev;

		$this->count--;
	}


	private function validateNumericIndex($index)
	{
		if( !filter_var($index, FILTER_VALIDATE_INT)  && $index !== 0)
			throw new OutOfRangeException("Offset invalid or out of range");

		return (int) $index;
	}

	private function findItemByIndex($index)
	{
		$node = $this->firstNode;
		$i = 0;

		while($i < $index && $node !== $this->lastNode)
		{
			$node = $node->next;
			$i++;
		}

		if($i === $index)
			return $node;
		return null;
	}

	/******************* ITERATOR interface *******************/

	// mixed current ( void )
	public function current()
	{
		if($this->iterationMode & static::IT_MODE_DELETE)
		{
			if($this->iterationMode & static::IT_MODE_FIFO)
				return $this->shift();
			else
				return $this->pop();
		}
		else
		{
			if(null == $this->iteratorCurrentNode) return null;
			return $this->iteratorCurrentNode->object;
		}
	}
	
	//mixed key ( void )
	public function key()
	{
		if($this->iterationMode & static::IT_MODE_DELETE)
		{
			if($this->iterationMode & static::IT_MODE_FIFO)
				return 0;
			else return $this->count()-1;
		}
		return $this->iteratorCurrentNodeCount;
	}


	//void next ( void )
	public function next()
	{
		if($this->iterationMode & static::IT_MODE_FIFO)
			$this->iterationMoveForward();
		else
			$this->iterationMoveBackward();
	}

	//void prev ( void )
	/** Move the iterator to the previous node. */
	public function prev()
	{
		if($this->iterationMode & static::IT_MODE_FIFO)
			$this->iterationMoveBackward();
		else
			$this->iterationMoveForward();
	}

	//void rewind ( void )
	public function rewind()
	{
		if($this->iterationMode & static::IT_MODE_FIFO)
		{
			$this->iteratorCurrentNode = $this->firstNode;
			$this->iteratorCurrentNodeCount = 0;
		}
		else
		{
			$this->iteratorCurrentNode = $this->lastNode;
			$this->iteratorCurrentNodeCount = $this->count()-1;
		}
	}

	//bool valid ( void )
	public function valid()
	{
		return null !== $this->iteratorCurrentNode;
	}


	/* This dont strictily belong to the iterator interface, 
	/* but are iterator related */


	//void setIteratorMode ( int $mode )
	public function setIteratorMode($mode) 
	{
		$this->iterationMode = $mode;
	}

	// int getIteratorMode ( void )
	public function getIteratorMode()
	{
		return $this->iterationMode;
	}

	

	private function iterationMoveForward()
	{
		if(null !== $this->iteratorCurrentNode)
		{
			$this->iteratorCurrentNode = $this->iteratorCurrentNode->next;
			$this->iteratorCurrentNodeCount++;
		}
	}

	private function iterationMoveBackward()
	{
		if(null !== $this->iteratorCurrentNode)
		{
			$this->iteratorCurrentNode = $this->iteratorCurrentNode->prev;
			$this->iteratorCurrentNodeCount--;
		}
	}
}



class SplDoublyLinkedList2Node
{
	public $prev;
	public $next;
	public $object;

	public function __construct($object)
	{
		$this->object = $object;
	}
}
