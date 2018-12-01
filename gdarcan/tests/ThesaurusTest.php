<?php

use PHPUnit\Framework\TestCase;

final class ThesaurusTest extends TestCase {
	public function testWordExists() {
		$this->assertContains(
			"great",
			json_decode(Thesaurus::getSynonyms("big"))->synonyms
		);
	}
	public function testWordNotExists() {
		$this->assertEmpty(
			json_decode(Thesaurus::getSynonyms("agelast"))->synonyms
		);
	}
}