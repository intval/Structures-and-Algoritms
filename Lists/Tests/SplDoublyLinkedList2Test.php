<?php

require '../Code/SplDoublyLinkedList2.php';

class SplDoublyLinkedList2Test extends PHPUnit_Framework_TestCase
{
	public function testPush()
	{
		$list = new SplDoublyLinkedList2();
		$list->push('hi');
	}

	public function testPop()
	{
		$list = new SplDoublyLinkedList2();
		$list->push('hi');
		$this->assertEquals('hi', $list->pop());
	}

	public function testPop2()
	{
		$list = new SplDoublyLinkedList2();
		$list->push('hi');
		$list->push('bye');
		$this->assertEquals('bye', $list->pop());
		$this->assertEquals('hi', $list->pop());
	}

	public function testTop()
	{
		$list = new SplDoublyLinkedList2();
		$list->push('hi');
		$this->assertEquals('hi', $list->Top());
	}

	public function testTopPop()
	{
		$list = new SplDoublyLinkedList2();
		$list->push('hi');
		$this->assertEquals('hi', $list->Top());
		$this->assertEquals('hi', $list->Top());
		$this->assertEquals('hi', $list->pop());
	}


	/**
	* Throws RuntimeException when the data-structure is empty.
	* @expectedException RuntimeException
	*/
	public function testPopException()
	{
		$list = new SplDoublyLinkedList2();
		$list->pop();
	}

	/**
	* Throws RuntimeException when the data-structure is empty.
	* @expectedException RuntimeException
	*/
	public function testPopException2()
	{
		$list = new SplDoublyLinkedList2();
		$list->push(1);
		$this->assertEquals(1, $list->pop());
		$list->pop();
	}

	/**
	* Throws RuntimeException when the data-structure is empty.
	* @expectedException RuntimeException
	*/
	public function testTopException()
	{
		$list = new SplDoublyLinkedList2();
		$list->top();
	}



	public function testShift()
	{
		$list = new SplDoublyLinkedList2();
		$list->push('hi');
		$list->push('bye');
		$this->assertEquals('hi', $list->shift());
		$this->assertEquals('bye', $list->shift());
	}

	public function testBottom()
	{
		$list = new SplDoublyLinkedList2();
		$list->push('hi');
		$list->push('bye');
		$this->assertEquals('hi', $list->bottom());
		$this->assertEquals('hi', $list->bottom());
	}

	public function testBottomShift()
	{
		$list = new SplDoublyLinkedList2();
		$list->push('hi');
		$list->push('bye');
		$this->assertEquals('hi',  $list->bottom());
		$this->assertEquals('hi',  $list->bottom());
		$this->assertEquals('bye', $list->top());
		$this->assertEquals('hi',  $list->shift());
		
		$this->assertEquals($list->top(),  $list->bottom());
		$this->assertEquals('bye',  $list->pop());
	}


	/**
	* Throws RuntimeException when the data-structure is empty.
	* @expectedException RuntimeException
	*/
	public function testBottomException()
	{
		$list = new SplDoublyLinkedList2();
		$list->bottom();
	}

	/**
	* Throws RuntimeException when the data-structure is empty.
	* @expectedException RuntimeException
	*/
	public function testShiftException()
	{
		$list = new SplDoublyLinkedList2();
		$list->shift();
	}


	public function testUnshift()
	{
		$list = new SplDoublyLinkedList2();
		$list->unshift(1);
	}

	public function testUnshiftOrder()
	{
		$list = new SplDoublyLinkedList2();
		
		$list->unshift(2);
		$list->push(3);
		$list->unshift(1);

		$this->assertEquals(3, $list->top());
		$this->assertEquals(1, $list->bottom());

	}


	public function testIsEmpty()
	{
		$list = new SplDoublyLinkedList2();
		$this->assertTrue($list->isEmpty());

		$list->push(1);
		$this->assertFalse($list->isEmpty());

		$list->shift();
		$this->assertTrue($list->isEmpty());

		$list->unshift(1);
		$this->assertFalse($list->isEmpty());
	}

	public function testCount()
	{
		$list = new SplDoublyLinkedList2();
		$this->assertEquals(0, $list->count());

		$list->push(1);
		$this->assertEquals(1, $list->count());

		$list->unshift(0);
		$this->assertEquals(2, $list->count());

		$list->top();
		$list->bottom();
		$this->assertEquals(2, $list->count());

		$list->pop();
		$this->assertEquals(1, $list->count());

		$list->shift();
		$this->assertEquals(0, $list->count());
	}

	public function testSerialize()
	{
		$list = new SplDoublyLinkedList2();
		$list->push('hi');
		$list->unshift(0);

		$t = new stdClass(); $t->test = 'ojb';
		$list->push( $t );
		$list->push(4);

		$this->assertEquals('{"0":0,"1":"hi","2":{"test":"ojb"},"3":4}', $list->serialize());
	}

	public function testUnserialize()
	{
		$data = '{"0":0,"1":"hi","2":{"test":"ojb"},"3":4}';
		$t = new stdClass(); $t->test = 'ojb';

		$list = new SplDoublyLinkedList2();
		$list->unserialize($data);

		$this->assertEquals(4, $list->count());
		$this->assertFalse($list->isEmpty());

		$this->assertEquals(0, $list->shift());
		$this->assertEquals('hi', $list->bottom());

		$this->assertEquals(4, $list->pop());
		$this->assertEquals($t, $list->top());
	}



	public function testOffsetExists()
	{
		$list = new SplDoublyLinkedList2();
		$this->assertFalse($list->offsetExists(0));

		$list->push(1);
		$this->assertTrue($list->offsetExists(0));		
		$this->assertFalse($list->offsetExists(1));

		$list->pop();
		$this->assertFalse($list->offsetExists(0));
	}

	/** @expectedException OutOfRangeException 
	*/
	public function testOffsetExistsException()
	{
		$list = new SplDoublyLinkedList2();
		$list->offsetExists("aww");
	}

	public function testOffsetGet()
	{
		$list = new SplDoublyLinkedList2();

		$list->push('b');
		$this->assertEquals('b', $list[0]);

		$list->unshift('a');
		$this->assertEquals('a', $list[0]);
		$this->assertEquals('b', $list[1]);
	}

	public function testOffsetSet()
	{
		$list = new SplDoublyLinkedList2();

		$list->push(1);
		$list->push(2);
		$list->push(3);
		$list->push(4);

		$list[0] = 'hi';
		$list[1] = 'yo';
		$list[3] = 'b';

		$this->assertEquals('hi', $list[0]);
		$this->assertEquals('yo', $list[1]);
		$this->assertEquals(3, $list[2]);
		$this->assertEquals('b', $list[3]);

		$this->assertEquals('hi', $list->bottom());
		$this->assertEquals('b', $list->top());

		$this->assertEquals(4, $list->count());
	}

	/**
	* @expectedException OutOfRangeException
	*/
	public function testUndefinedOffsetSet()
	{
		$list = new SplDoublyLinkedList2();
		$list[0] = 'hi';
	}


	public function testOffsetUnset()
	{
		$list = new SplDoublyLinkedList2();

		$list->push(0);
		$list->push(1);
		$list->push(2);

		unset($list[1]);
		$this->assertEquals(2, $list->count());
		$this->assertEquals(0, $list->bottom());
		$this->assertEquals(2, $list->top());
	}

	public function testIterator()
	{
		$list = new SplDoublyLinkedList2();

		$list->push('a1');
		$list->push('a2');
		$list->push('a3');
		$list->push('a4');

		$i = 0;
		foreach($list as $k => $v)
		{
			$this->assertEquals($i++, $k);
			$this->assertEquals('a'.$i, $v);
		}

		$i = 0;
		foreach($list as $k => $v)
		{
			$this->assertEquals($i++, $k);
			$this->assertEquals('a'.$i, $v);
		}
	}


	public function testIterationModeLifoFifo()
	{
		$list = new SplDoublyLinkedList2();

		$list->push(1); $list->push(2); $list->push(3);
		$list->push(4); $list->push(5); $list->push(6);

		$list->setIteratorMode(SplDoublyLinkedList2::IT_MODE_FIFO | SplDoublyLinkedList2::IT_MODE_KEEP );

		$i = 0;
		foreach($list as $k => $v)
		{
			$this->assertEquals($i++, $k);
			$this->assertEquals($i, $v);
		}

		$list->setIteratorMode(SplDoublyLinkedList2::IT_MODE_LIFO | SplDoublyLinkedList2::IT_MODE_KEEP );

		$i = 5;
		foreach($list as $k => $v)
		{
			$this->assertEquals($i, $k);
			$this->assertEquals($i+1, $v);
			$i--;
		}

	}


	public function testFifoIterationDelete()
	{
		$list = new SplDoublyLinkedList2();

		$list->push(1); $list->push(2); $list->push(3);
		$list->push(4); $list->push(5); $list->push(6);

		$list->setIteratorMode(SplDoublyLinkedList2::IT_MODE_FIFO | SplDoublyLinkedList2::IT_MODE_DELETE );

		$expectedCount = $list->count()-1;
		$i = 1;
		foreach($list as $k => $v)
		{
			$this->assertEquals(0, $k);
			$this->assertEquals($i++, $v);
			$this->assertEquals($expectedCount--, $list->count());
		}

		$this->assertEquals(0, $list->count());
	}

	public function testLifoIterationDelete()
	{
		$list = new SplDoublyLinkedList2();

		$list->push(1); $list->push(2); $list->push(3);
		$list->push(4); $list->push(5); $list->push(6);

		$list->setIteratorMode(SplDoublyLinkedList2::IT_MODE_LIFO | SplDoublyLinkedList2::IT_MODE_DELETE );

		$expectedCount = $list->count()-1;
		$i = 6;
		foreach($list as $k => $v)
		{
			$this->assertEquals($list->count()-1, $k);
			$this->assertEquals($i--, $v);
			$this->assertEquals($expectedCount--, $list->count());
		}

		$this->assertEquals(0, $list->count());
	}
}