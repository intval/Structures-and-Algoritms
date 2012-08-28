<?php

require '../Code/LinkedListStack.php';

class LinkedListStackTest extends PHPUnit_Framework_TestCase
{
	public function testPush()
	{
		$stack = new LinkedListStack();
		$stack->push('yo');
	}

	public function testPop()
	{
		$stack = new LinkedListStack();
		$stack->push('yo');
		$this->assertEquals('yo', $stack->pop());
	}

	/**
	* @expectedException OutOfBoundsException
	*/
	public function testEmptyPopException()
	{
		$stack = new LinkedListStack();
		$stack->pop();
	}

	public function testOrder()
	{
		$stack = new LinkedListStack();
		$stack->push('yo1');
		$stack->push('hi2');
		$this->assertEquals('hi2', $stack->pop());
		$this->assertEquals('yo1', $stack->pop());
	}


	public function testCount()
	{
		$stack = new LinkedListStack();
		
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
}