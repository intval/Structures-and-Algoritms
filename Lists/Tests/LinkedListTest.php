<?php

require_once '../code/LinkedList.php';

class ListTest extends PHPUnit_Framework_TestCase
{
	public function testAdd()
	{
		$list = new LinkedList();
		
		$this->assertFalse($list->contains(1));
		$this->assertFalse($list->contains(2));
		$this->assertFalse($list->contains(3));

		$list->add(1);
		$list->add(3);
		$list->add(2);

		$this->assertTrue($list->contains(1));
		$this->assertTrue($list->contains(2));
		$this->assertTrue($list->contains(3));

		$this->assertEquals($list->count(), 3);
	}

	public function testCount()
	{
		$list = new LinkedList();
		$this->assertEquals($list->count(), 0);

		$list->add(1);
		$list->add(2);

		$this->assertEquals($list->count(), 2);

		$list->remove(2);
		$this->assertEquals($list->count(), 1);

		$list->remove(2);
		$this->assertEquals($list->count(), 1);

		$list->remove(1);
		$this->assertEquals($list->count(), 0);
	}

	public function testRemove()
	{
		$list = new LinkedList();

		$this->assertFalse($list->contains(1));
		$this->assertFalse($list->contains(2));
		$this->assertFalse($list->contains(3));

		$list->add(1);
		$list->add(3);
		$list->add(2);
		$list->add(2);

		$this->assertTrue($list->contains(1));
		$this->assertTrue($list->contains(2));
		$this->assertTrue($list->contains(3));
		$this->assertEquals(4, $list->count());

		$list->remove(1);
		$this->assertFalse($list->contains(1));
		$this->assertTrue($list->contains(2));
		$this->assertTrue($list->contains(3));
		$this->assertEquals(3, $list->count());

		$list->remove(2);
		$this->assertFalse($list->contains(1));
		$this->assertTrue($list->contains(2));
		$this->assertTrue($list->contains(3));
		$this->assertEquals(2, $list->count());

		$list->remove(2);
		$this->assertFalse($list->contains(1));
		$this->assertFalse($list->contains(2));
		$this->assertTrue($list->contains(3));
		$this->assertEquals(1, $list->count());
	}
}


