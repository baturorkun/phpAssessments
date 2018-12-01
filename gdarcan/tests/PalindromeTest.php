<?php

use PHPUnit\Framework\TestCase;

final class PalindromeTest extends TestCase {
	public function testOddLengthStringReturnsTrue() {
		$this->assertEquals(
			true,
			Palindrome::isPalindrome("deleveled")
		);
	}
	public function testOddLengthMixedCaseStringReturnsTrue() {
		$this->assertEquals(
			true,
			Palindrome::isPalindrome("deLevEleD")
		);
	}
	public function testEvenLengthStringReturnsTrue() {
		$this->assertEquals(
			true,
			Palindrome::isPalindrome("otto")
		);
	}
	public function testEvenLengthMixedCaseStringReturnsTrue() {
		$this->assertEquals(
			true,
			Palindrome::isPalindrome("oTtO")
		);
	}
	public function testNonPalindromeStringReturnsFalse() {
		$this->assertEquals(
			false,
			Palindrome::isPalindrome("osTtO")
		);
	}
	public function testEyEdipAdanadaPideYeIsAPalindromeSentenceInludingSpaces() {
		$this->assertEquals(
			true,
			Palindrome::isPalindrome("ey edip adanada pide ye")
		);
	}
	public function testSomeTestStringsIncludingTurkishAndRussianUnicodesReturnTrue() {
		$this->assertEquals(
			true,
			Palindrome::isPalindrome("şaş") && Palindrome::isPalindrome("çaç") && Palindrome::isPalindrome("ğağ") && Palindrome::isPalindrome("İaİ") && Palindrome::isPalindrome("ÖaÖ") && Palindrome::isPalindrome("ıaı") && Palindrome::isPalindrome("палиндроморднилап")
		);
	}
}