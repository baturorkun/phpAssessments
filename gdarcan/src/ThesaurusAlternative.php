<?php

class ThesaurusAlternative Extends Thesaurus
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

		if (count($result["synonyms"]) == 0) {
			foreach($thesaurus AS $key=>$val) {
				if (in_array($word,$val)) {
					$val[] = $key;
					$result["synonyms"] = array_merge(array_diff($val,array($word)));
				}
			}
		}

		return json_encode($result);
	}
}

$thesaurus = new Thesaurus;
echo $thesaurus->getSynonyms('great');
