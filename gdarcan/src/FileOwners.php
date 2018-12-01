<?php

class FileOwners
{
	public function groupByOwners($files)
	{
		$owners = array();
		foreach($files AS $file=>$owner) {
			$owners[$owner][] = $file;
		}
		return $owners;
	}
}

$files = [
	"Input.txt" => "Randy",
	"Code.py" => "Stan",
	"Output.txt" => "Randy"
];
$fileOwners = new FileOwners;
var_dump($fileOwners->groupByOwners($files));
