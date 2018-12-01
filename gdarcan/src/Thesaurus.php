<?php

class Thesaurus
{
	private static $thesaurus = array("buy" => array("purchase"), "big" => array("great", "large"));

	/**
	*
	* A thesaurus contains words and synonyms for each word.
	* Below is an example of a data structure that defines a thesaurus:
	* array("buy" => array("purchase"), "big" => array("great", "large"))
	*
	* @param    string $string The string to search
	* @author   gdarcan[at]gmail[dot]com
	* @return   string json_formatted_text
	*
	*/

	public function getSynonyms($word)
	{
		$thesaurus = self::$thesaurus;
		$result["word"] = $word;
		$result["synonyms"] = isset($thesaurus[$word]) ? $thesaurus[$word] : array();

		return json_encode($result);
	}
}

$thesaurus = new Thesaurus;
echo $thesaurus->getSynonyms('agelast');
