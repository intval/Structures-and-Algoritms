<?php

require_once '../Code/QuickFind.php';

class QuickFindTest extends PHPUnit_Framework_TestCase
{
	public function test_quickfind()
	{
		$qu = new QuickFind(5);

		$this->assertFalse($qu->isConnected(1,2), "12");
		$qu->connect(1,2); // connect node 1 and node 2
		$this->assertTrue($qu->isConnected(1,2), "12");

		$this->assertFalse($qu->isConnected(3,4), '34');
		$qu->connect(3,4); 
		$this->assertTrue($qu->isConnected(3,4), '34');


		$this->assertFalse($qu->isConnected(2,3),'23');
		$this->assertFalse($qu->isConnected(1,3), '13');
		$this->assertFalse($qu->isConnected(1,4), '14');
		$this->assertFalse($qu->isConnected(2,4), '24');

		$qu->connect(2,3);

		$this->assertTrue($qu->isConnected(1,3), '13');
		$this->assertTrue($qu->isConnected(1,4), '14');
		$this->assertTrue($qu->isConnected(2,4), '24');
	}
}