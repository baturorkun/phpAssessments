<?php

//asdfasdfasdf: No such file or directory.

class Path
{
	public $currentPath;

	/**
	*
	* A path change directory simulator, to construct enter blank or some path starting with /
	*
	* @param    string $string The string to change directory
	* @author   gdarcan
	* @return   boolean
	*
	*/
	function __construct($path="")
	{
		$path = $path == "" ? "/" : $path;
		if (substr($path,0,1)!='/') {
			throw new InvalidArgumentException(
				sprintf(
					'%s: invalid path entry point.',
					$path
				)
			);
		}
		if (preg_replace("/[^a-zA-Z\/]/", "", $path) != $path) {
			throw new InvalidArgumentException(
				sprintf(
					'%s: No such file or directory.',
					$path
				)
			);
		}
		$this->currentPath = trim(rtrim($path,"/"));
		$this->pathArray = explode("/",$this->currentPath);
		if (count($this->pathArray) == 1) {
			$this->currentPath = "/";
		}
	}

	/**
	*
	* A path change directory simulator
	*
	* @param    string $string The string to change directory
	* @author   gdarcan
	* @return   boolean
	*
	*/
	public function cd($newPath=null)
	{
		if (!$newPath) {
			throw new InvalidArgumentException('Path cannot be empty.');
		}
		if ($newPath == '' || preg_replace("/[^a-zA-Z.\/]/", "", $newPath) != $newPath) {
			throw new InvalidArgumentException(
				sprintf(
					'%s: No such file or directory.',
					$newPath
				)
			);
		}
		if (substr($newPath,0,1)=='/') {
			$this->pathArray = array();
		}

		$directories = explode("/",$newPath);
		foreach($directories AS $dir) {
			switch($dir) {
				case ".":
					break;
				case "..":
					if (count($this->pathArray) > 1) {
						array_pop($this->pathArray);
						$this->currentPath = implode("/",$this->pathArray);
					}
					break;
				default:
					if (stristr($dir,".")!==FALSE) {
						throw new InvalidArgumentException(
							sprintf(
								'%s: No such file or directory.',
								$newPath
							)
						);
					}
					$this->pathArray[] = $dir;
					$this->currentPath = implode("/",$this->pathArray);
					break;
			}
		}
		$this->currentPath = rtrim($this->currentPath,"/");
		if (count($this->pathArray) == 1) {
			$this->currentPath = "/";
		}
	}
}

$path = new Path('/a/b/c/d');
$path->cd('../x');
echo $path->currentPath;