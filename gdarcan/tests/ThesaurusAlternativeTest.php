<?php

use PHPUnit\Framework\TestCase;

final class ThesaurusAlternativeTest extends TestCase {
	public function testWordExists() {
		$this->assertContains(
			"big",
			json_decode(ThesaurusAlternative::getSynonyms("great"))->synonyms
		);
	}
	public function testWordNotExists() {
		$this->assertEmpty(
			json_decode(Thesaurus::getSynonyms("agelast"))->synonyms
		);
	}
}