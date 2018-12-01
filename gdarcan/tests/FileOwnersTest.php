<?php
use PHPUnit\Framework\TestCase;

final class FileOwnersTest extends TestCase {
	public function testIfRandysFirstFileIsCorrect() {
		$this->assertEquals(
			"Input.txt",
			FileOwners::groupByOwners(["Input.txt" => "Randy", "Code.py" => "Stan", "Output.txt" => "Randy"])["Randy"][0]
		);
	}
	public function testIfRandyHasTwoFiles() {
		$this->assertEquals(
			2,
			count(FileOwners::groupByOwners(["Input.txt" => "Randy", "Code.py" => "Stan", "Output.txt" => "Randy"])["Randy"])
		);
	}
	public function testIfRandyHasCorrectTwoFiles() {
		$owners = FileOwners::groupByOwners(["Output.txt" => "Randy", "Code.py" => "Stan", "Input.txt" => "Randy"])["Randy"];
		sort($owners);
		$this->assertEquals(
			["Input.txt","Output.txt"],
			$owners
		);
	}
}