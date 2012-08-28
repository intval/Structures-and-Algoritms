<?php

require_once '../code/FixedArrayList.php';

class FixedArrayListTest extends PHPUnit_Framework_TestCase
{
	public function testAdd()
	{
		$list = new FixedArrayList();
		
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
		$list = new FixedArrayList();
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
		$list = new FixedArrayList();

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


	public function testGrowthAndCollapse()
	{
		$list = new FixedArrayList();

		$list->add(1);
		$list->add(2);
		$list->add(3);
		$list->add(4);
		$list->add(5);
		$list->add(6);
		$list->add(7);
		$list->add(8);
		$list->add(9);
		$list->add(10);
		$list->add(11);
		$list->add(12);
		$list->add(13);
		$list->add(14);
		$list->add(15);
		$list->add(16);
		$list->add(17);

		$this->assertEquals(17, $list->count());

		$list->remove(3); $list->remove(4); $list->remove(5); $list->remove(6);
		$list->remove(7); $list->remove(8); $list->remove(9); $list->remove(10);
		$list->remove(11); 
		$list->remove(12); 
		$list->remove(13); 
		$list->remove(14); 
		$list->remove(15); 

		$this->assertTrue($list->contains(1));
		$this->assertTrue($list->contains(2));
		$this->assertTrue($list->contains(16));
		$this->assertTrue($list->contains(17));

		$this->assertEquals(4, $list->count());
	}
}


