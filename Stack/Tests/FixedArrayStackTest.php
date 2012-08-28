<?php

require '../Code/FixedArrayStack.php';

class FixedArrayStackTest extends PHPUnit_Framework_TestCase
{
	public function testPush()
	{
		$stack = new FixedArrayStack();
		$stack->push('yo');
	}

	public function testPop()
	{
		$stack = new FixedArrayStack();
		$stack->push('yo');
		$this->assertEquals('yo', $stack->pop());
	}

	/**
	* @expectedException OutOfBoundsException
	*/
	public function testEmptyPopException()
	{
		$stack = new FixedArrayStack();
		$stack->pop();
	}

	public function testOrder()
	{
		$stack = new FixedArrayStack();
		$stack->push('yo1');
		$stack->push('hi2');
		$this->assertEquals('hi2', $stack->pop());
		$this->assertEquals('yo1', $stack->pop());
	}


	public function testCount()
	{
		$stack = new FixedArrayStack();
		
		$this->assertEquals(0, $stack->count());

		$stack->push('yo1');
		$this->assertEquals(1, $stack->count());

		$stack->push('hi2');
		$this->assertEquals(2, $stack->count());

		$stack->pop();
		$this->assertEquals(1, $stack->count());

		$stack->pop();
		$this->assertEquals(0, $stack->count());
	}

	public function testBigStack()
	{
		$stack = new FixedArrayStack();
		$i = 0;

		for(; $i < 10000; $i++)
			$stack->push($i);

		$this->assertEquals(10000, $stack->count());

		for(; $i > 0; $i-- )
			$this->assertEquals($i-1, $stack->pop());

		$this->assertEquals(0, $stack->count());
	}
}