<?php

require  '../Code/FixedArrayQueue.php';

class FixedArrayQueueTest extends PHPUnit_Framework_TestCase
{
	public function testEnqueue()
	{
		$queue = new FixedArrayQueue();
		$queue->enqueue("yo");
	}

	public function testDequeue()
	{
		$q = new FixedArrayQueue();
		$q->enqueue('yo');

		$this->assertEquals('yo', $q->dequeue());
	}

	/**
	* @expectedException OutOfBoundsException
	*/
	public function testDequeueException()
	{
		$q = new FixedArrayQueue();
		$q->dequeue();
	}

	public function testCount()
	{
		$q = new FixedArrayQueue();
		$this->assertEquals(0, $q->count());

		$q->enqueue('yo');
		$this->assertEquals(1, $q->count());

		$q->enqueue('yo');
		$this->assertEquals(2, $q->count());

		$q->enqueue('yo2');
		$this->assertEquals(3, $q->count());

		$q->dequeue();
		$this->assertEquals(2, $q->count());

		$q->enqueue('yo');
		$this->assertEquals(3, $q->count());
	}


	public function testOrder()
	{
		$q = new FixedArrayQueue();
		$q->enqueue('a');
		$q->enqueue('b');
		$q->enqueue('c');

		$this->assertEquals('a', $q->dequeue());
		$this->assertEquals('b', $q->dequeue());
		$this->assertEquals('c', $q->dequeue());
	}

	public function testBigQueue()
	{
		$q = new FixedArrayQueue();

		for($i = 0; $i < 10000; $i++)
			$q->enqueue($i);

		for($i = 0; $i < 10000; $i++)
			$this->assertEquals($i, $q->dequeue());
	}
}