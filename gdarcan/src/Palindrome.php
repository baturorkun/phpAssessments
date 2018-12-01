<?php

class Palindrome
{
	/**
	*
	* A palindrome is a word that reads the same backward or forward.
	* This function checks if given word is a palindrome or not
	* Eg: deleveled
	*
	* @param    string $string The string to check
	* @author   gdarcan
	* @return   boolean
	*
	*/
	public function isPalindrome($word)
	{
		return self::mb_strrev(mb_strtolower(mb_substr($word,0,floor(mb_strlen($word)/2)))) == mb_strtolower(mb_substr($word,-1*floor(mb_strlen($word)/2)));
	}

	/**
	*
	* There's a php function named strrev to reverse strings
	* but no built-in multi byte string reversing function
	* in widely used php-mbstring extension
	*
	* @param    string $string A unicode string to reverse
	* @return   string
	*
	*/
	private function mb_strrev($string, $encoding = null)
	{
		if ($encoding === null) {
			$encoding = mb_detect_encoding($string);
		}

		$length   = mb_strlen($string, $encoding);
		$reversed = '';
		while ($length-- > 0) {
			$reversed .= mb_substr($string, $length, 1, $encoding);
		}

		return $reversed;
	}
}

$palindrome = new Palindrome;
echo $palindrome->isPalindrome('deleveled');