<?php

require_once '../Code/QuickUnion.php';

class QuickUnionTest extends PHPUnit_Framework_TestCase
{
	public function test_quickunion()
	{
		$qu = new QuickUnion(5);

		$this->assertFalse($qu->isConnected(1,2), "a12");
		$qu->connect(1,2); // connect node 1 and node 2
		$this->assertTrue($qu->isConnected(1,2), "b12");

		$this->assertFalse($qu->isConnected(3,4), 'a34');
		$qu->connect(3,4); 
		$this->assertTrue($qu->isConnected(3,4), 'b34');


		$this->assertFalse($qu->isConnected(2,3),'a23');
		$this->assertFalse($qu->isConnected(1,3), 'a13');
		$this->assertFalse($qu->isConnected(1,4), 'a14');
		$this->assertFalse($qu->isConnected(2,4), 'a24');

		$qu->connect(2,3);

		$this->assertTrue($qu->isConnected(1,3), 'b13');
		$this->assertTrue($qu->isConnected(1,4), 'b14');
		$this->assertTrue($qu->isConnected(2,4), 'b24');
	}
}