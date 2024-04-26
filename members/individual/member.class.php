<?php
/**
 * Member class that represents the members of GamesCrafters.
 * Simple methods related to marshalling and unmarshalling are provided.
 * This class relies on the SimpleXML library that is included in PHP >= 5.
 * No error handling is performed; all expected XML nodes must be present.
 * @author  James Ide
 * @version 1.0
 */
class Member
{
    // all instance variables are declared public for easy access
	public $number;
	public $name;
	public $year;
	public $major;
	
	public $semesterJoined;
	public $gcSemesters;
	public $projects;
	public $biography;
	public $quote;
	public $cited;
	public $favoriteGame;
	public $favoriteIceCream;
	
	public $normalPhoto;
	public $crazyPhoto;
    
	/**
	 * Constructs a Member object that represents a member of GamesCrafters.
	 * To load a Member from an XML file, a pathname pointing to the data file 
	 * may be specified.
	 */
    public function __construct($csvRow = null, $photoPrefix = '')
    {
		$this->number = $csvRow[0];
		$this->name = $csvRow[1];
		$this->semesterJoined = $csvRow[2];
		$this->year = $csvRow[3];
		$this->gcSemesters = $csvRow[4];
		$this->major = $csvRow[5];
		$this->favoriteGame = $csvRow[6];
		$this->favoriteIceCream = $csvRow[7];
		$this->projects = $csvRow[8];
		$this->biography = $csvRow[9];
		$this->quote = $csvRow[10];
		if ($this->quote) {
			$this->cited = $csvRow[11];
		}

		if ($csvRow[12]) {
			$this->normalPhoto = $csvRow[12];
		} else {
			$this->normalPhoto = 'default.png';
		}

		if ($csvRow[13]) {
			$this->crazyPhoto = $csvRow[13];
		} else {
			$this->crazyPhoto = 'default.png';
		}
    }
}
?>