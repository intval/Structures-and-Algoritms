<?php

/*********************************************************************/
/* In this algorithm we store for each element the id of it's parent node (the node to which the current one is connected)
/* In the beginning each element is a root on it's own.
/* When connecting nodes, we make one node to be child of another node
/* To compare we check whether the root of P equals to the root of Q (they are under the same tree)
/*
/* To avoid tall trees and long root searching we are going not just set $p as child of $q
/* but determine which tree is smaller and add the smaller tree as a child of the taller tree
/* and thus keeping short tree, instead of adding a long tree as a child of short tree and thus increasing 
/* the size of the tree
/* to do that we gonna count the length of each tree in additional array
/*********************************************************************/

class QuickUnionWeighed
{

	// the key of the array represents the id of the node
	// the value represents the id of the parent node
	private $nodes;

	// the key of the array represents the node id
	// the value represents the size of the tree below it
	private $sizes;

	public function __construct($N)
	{
		for($i = 0; $i < $N; $i++)
		{
			$this->nodes[$i] = $i;
			$this->sizes[$i] = 1;
		}
	}

	public function isConnected($p, $q)
	{
		// check whether both nodes belong to the same root
		return $this->getroot($p) === $this->getroot($q);
	}

	public function getroot($nodeId)
	{
		while($nodeId !== $this->nodes[$nodeId])
		{
			// $this->nodes[$nodeId] = $this->nodes[$this->nodes[$nodeId]]; // path compression
			$nodeId = $this->nodes[$nodeId];
		}
		return $nodeId;
	}

	public function connect($p,$q)
	{
		$pRoot = $this->getroot($p);
		$qRoot = $this->getroot($q);

		$qSize = & $this->sizes[$qRoot];
		$pSize = & $this->sizes[$pRoot];

		// make the bigger tree to be the parent of the smaller tree
		if($qSize < $pSize)
		{
			// p's tree is smaller. make it child of q
			$this->nodes[$pRoot] = $qRoot;

			// increase q's tree size
			$qSize += $pSize;
		}
		else
		{
			// q's tree is smaller, make it child of p
			$this->nodes[$qRoot] = $pRoot;

			// increase p's tree size
			$pSize += $qSize;
		}

	}
}