<?php

/*********************************************************************/
/* In this algorithm we store for each element the id of it's parent node (the node to which the current one is connected)
/* In the beginning each element is a root on it's own.
/* When connecting nodes, we make one node to be child of another node
/* To compare we check whether the root of P equals to the root of Q (they are under the same tree)
/*********************************************************************/

class QuickUnion
{

	// the key of the array represents the id of the node
	// the value represents the id of the parent node
	private $nodes;

	public function __construct($N)
	{
		for($i = 0; $i < $N; $i++)
			$this->nodes[$i] = $i;
	}

	public function isConnected($p, $q)
	{
		// check whether both nodes belong to the same root
		return $this->getroot($p) === $this->getroot($q);
	}

	private function getroot($nodeId)
	{
		while($nodeId !== ($parent = $this->nodes[$nodeId]))
			$nodeId = $parent;
		return $parent;
	}

	public function connect($p,$q)
	{
		// make $q the parent of $p
		$this->nodes[$p] = $q;

	}
}