<?php

/*********************************************************************/
/* In this algorithm we store for each element the id of the group it belongs to.
/* In the beginning each element belongs to it's own gourp.
/* When connecting nodes, we set the node's group ID to be identical to the group id of the other node
/*********************************************************************/

class QuickFind
{

	// the key of the array represents the number of the node
	// the value represents the group id to which the node belongs
	private $nodes;

	public function __construct($N)
	{
		for($i = 0; $i < $N; $i++)
			$this->nodes[$i] = $i;
	}

	public function isConnected($p, $q)
	{
		// check whether both nodes belong to the same group
		return $this->nodes[$p] === $this->nodes[$q];
	}

	public function connect($p,$q)
	{
		// set the groupid of p to be the same as the group q
		// and all other nodes that belonged to P's group, now to belong to Q's group

		$oldgroup = $this->nodes[$p];
		$newGroup = $this->nodes[$q];

		for($i = 0, $L = sizeof($this->nodes); $i < $L; $i++)
			if($this->nodes[$i] == $oldgroup)
				$this->nodes[$i] = $newGroup;
	}
}