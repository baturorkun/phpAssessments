<?php

use PHPUnit\Framework\TestCase;

final class PathTest extends TestCase {

	/**
	* @testdox Path can be constructed without parameter
	*/
	public function testPathConstructNoParam() {
		new Path();
	}

	/**
	* @testdox Path can be constructed with one slash
	*/
	public function testPathConstructOneSlash() {
		new Path("/");
	}

	/**
	* @testdox Path can be constructed empty
	*/
	public function testPathConstructEmpty() {
		new Path("");
	}

	/**
	* @testdox Path construct should fail without leading slash when not empty
	*/
	public function testFailPathConstructWithoutLeadingSlash() {
		$this->expectException(InvalidArgumentException::class);
		new Path("asd");
	}

	/**
	* @testdox Path construct should fail when non-English characters exist
	*/
	public function testFailNonEnglishInside() {
		$this->expectException(InvalidArgumentException::class);
		new Path("/ç");
	}

	/**
	* @testdox Path construct should fail when numbers exist
	*/
	public function testFailNumberInside() {
		$this->expectException(InvalidArgumentException::class);
		new Path("/a/b/c/d2");
	}

	/**
	* @testdox CD command can include multiple .. and directory locks at root
	*/
	public function testOverflowParent() {
		$path = new Path("/a/b");
		$path->cd('../../../../../../../../../../..');
		$this->assertEquals(
			'/',
			$path->currentPath
		);
	}

	/**
	* @testdox CD command can start with ./ and directory goes from relative current
	*/
	public function testLeadingDot() {
		$path = new Path("/a/b/c/d");
		$path->cd('./x');
		$this->assertEquals(
			'/a/b/c/d/x',
			$path->currentPath
		);
	}

	/**
	* @testdox CD command can start with .. and directory goes up
	*/
	public function testLeadingDoubleDot() {
		$path = new Path("/a/b/c/d");
		$path->cd('..');
		$this->assertEquals(
			'/a/b/c',
			$path->currentPath
		);
	}

	/**
	* @testdox CD command can include parent directive in the middle which causes go up down up
	*/
	public function testCdCanIncludeManyParents() {
		$path = new Path("/a/b/c/d");
		$path->cd('../x/../y');
		$this->assertEquals(
			'/a/b/c/y',
			$path->currentPath
		);
	}

	/**
	* @testdox CD command can be one word
	*/
	public function testCdCanIncludeAnyWordWithoutSlash() {
		$path = new Path("/a/b/c/d");
		$path->cd('x');
		$this->assertEquals(
			'/a/b/c/d/x',
			$path->currentPath
		);
	}

	/**
	* @testdox CD command can be absolute path
	*/
	public function testCdCanStartWithAbsolutePath() {
		$path = new Path("/a/b/c/d");
		$path->cd('/x/y/z');
		$this->assertEquals(
			'/x/y/z',
			$path->currentPath
		);
	}

	/**
	* @testdox CD command ignores trailing slash
	*/
	public function testCdIgnoreTrailingSlash() {
		$path = new Path("/a/b/c/d");
		$path->cd('../x/');
		$this->assertEquals(
			'/a/b/c/x',
			$path->currentPath
		);
	}

	/**
	* @testdox CD command cannot be empty
	*/
	public function testCdFailEmpty() {
		$path = new Path("/a/b/c/d");
		$this->expectException(InvalidArgumentException::class);
		$path->cd();
	}

	/**
	* @testdox CD command should fail when non-English characters exist
	*/
	public function testCdCannotIncludeNonEnglishCharacters() {
		$this->expectException(InvalidArgumentException::class);
		$path = new Path("/a/b/c/d");
		$path->cd('ç');
	}

	/**
	* @testdox CD command should fail when numbers exist
	*/
	public function testCdCannotIncludeNumbers() {
		$this->expectException(InvalidArgumentException::class);
		$path = new Path("/a/b/c/d");
		$path->cd('/x/y2');
	}
}