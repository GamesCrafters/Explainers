<?php
define("ERROR_FILE_EXISTS", 1);
define("ERROR_INVALID_EXTENSION", 2);
define("ERROR_FILE_SIZE", 3);
define("ERROR_INVALID_GAME", 4);
require_once '../site-legacy-archive-sp20/gcgame.php';
require_once '../site-legacy-archive-sp20/common.php';

class Process
{
	/* Class constructor */
	function Process()
	{
		if(isset($_REQUEST['action']) && $_REQUEST['action'] == "deletegame")
			$this->procDeleteGame();
		else if(isset($_REQUEST['uploadgameimage']))
			$this->procUploadGameImage();
		else if(isset($_REQUEST['deleteimage']))
			$this->procDeleteImage();
		else if(isset($_POST['subeditgame']))		
		        $this->procEditGame();
		else if(isset($_POST['createnewuser']))
			$this->procNewUser();
		else // error
			header("Location: index.php");
	}
	
	function procDeleteGame()
	{
		$gametodelete = $_REQUEST['game'];
		unlink("../games/$gametodelete.xml");
		header("Location: managegames.php");
	}
	
	function procDeleteImage()
	{
		$game = $_REQUEST['game'];
		$imagetodelete = $_REQUEST['image'];
		$file = "../games/i/$game/$imagetodelete";
		if(file_exists($file))
			unlink($file);
		header("Location: manageimages.php?game=$game");
	}
	
	function procUploadGameImage()
	{
		if(trim($_POST['game']) == '')
		{
			header("Location: manageimages.php?error=".ERROR_INVALID_GAME); // Invalid Game
			return;
		}
		if($_FILES['gameimageupload']['size'] > 2100000)
		{
			header("Location: manageimages.php?error=".ERROR_FILE_SIZE); // File too big
			return;
		}
		// find the game name and code
		$doc = new DOMDocument();
		$doc->load("../games/{$_POST['game']}.xml");
		$game = $doc->getElementsByTagName("game")->item(0);
		$name = $game->getElementsByTagName("name")->item(0)->nodeValue;
		$code = $game->getElementsByTagName("code")->item(0)->nodeValue;
		
		// get the actual file name and extension of the image
		$base = basename($_FILES['gameimageupload']['name']);
		$e = explode(".",$base);
		$extension = strtolower($e[count($e) - 1]);
		
		// autoname it!
		// 1. Find the highest current _xx suffix.
		// 2. Add 1 to it
		// 3. Combine elements together to form a file.
		if(!$_POST['disableautoname'])
		{
			// start at gamename_00 because we will automatically add 1 to the counter at the end to get gamename_01
			$current = "00";
			
			// get the files
			$files = GetFiles("../games/i/$code/");
			foreach($files as $file)
			{
				$patterns = array();
				// if the file matches the form of game_xx, then set the current to be xx
				if(preg_match("/{$code}_([0-9][0-9])/", $file, $patterns))
					$current = $patterns[1];
			}
			// add one to the current and print in 2 digit format
			$current = sprintf("%02d",((int)$current) + 1);
			$base = "{$code}_$current.$extension";
		}
		
		// checks to see whether the uploaded file extension is correct
		$valid_extensions = array("jpg", "jpeg", "gif", "png");
		if(array_search($extension, $valid_extensions) !== false)
		{
			// checks to see whether the file already exists
			$target_path = "../games/i/$code/".$base;
			if(file_exists($target_path))
			{
				header("Location: manageimages.php?error=".ERROR_FILE_EXISTS); // File already exists
				return;
			}
			// success!
			move_uploaded_file($_FILES['gameimageupload']['tmp_name'], $target_path);
		}
		else
		{
			header("Location: manageimages.php?&error=".ERROR_INVALID_EXTENSION); // Invalid extension
			return;
		}
		// success!
		header("Location: manageimages.php?success=".htmlentities($base)."&uploadgame=$code&game=$code");
	}
	
	function procEditGame()
	{
		// creates a new game, with ../ as a reference to the root directory
		$game = new GCGame(null, "../");
		
		// sets the game name
		$game->name = ucwords(trim(stripslashes($_POST['name'])));
		if($game->name != "") // make sure the game name isn't empty
		{
			// strip out any non-alphanumeric characters to form the code
			$game->code = preg_replace("/[^a-z0-9]/", "", strtolower($game->name));
			if(isset($_POST['code']) && $_POST['code'] != '')
				$game->code = preg_replace("/[^a-z0-9]/", "", strtolower($_POST['code']));
			
			// make sure the icon is a nice size
			if($_FILES['iconupload']['size'] <= 1100000)
			{
				// find the file name
				$base = basename($_FILES['iconupload']['name']);
				if($base != '')
				{
					// find the extension and check if it's valid
					$e = explode(".",$base);
					$extension = strtolower($e[count($e) - 1]);
					
					$valid_extensions = array("jpg", "jpeg", "gif", "png");
					if(array_search($extension, $valid_extensions) !== false)
					{
						// removes previous files
						foreach($valid_extensions as $ext)
							if(file_exists("../games/i/icons/".$game->code.".".$ext))
								unlink("../games/i/icons/".$game->code.".".$ext);
						
						// success! move the file.
						$target_path = "../games/i/icons/".$game->code.".".$extension;
						move_uploaded_file($_FILES['iconupload']['tmp_name'], $target_path);
					}
					else
					{
						header("Location: editgame.php?game=$game->code&error=2"); // Invalid extension
						return;
					}
				}
			}
			else
			{
				header("Location: editgame.php?game=$game->code&error=3"); // File too big
				return;
			}
			
			// sets some more properties
			$game->history = trim(stripslashes($_POST['history']));
			$game->board = trim(stripslashes($_POST['board']));
			$game->pieces = trim(stripslashes($_POST['pieces']));
			$game->tomove = trim(stripslashes($_POST['tomove']));
			$game->towin = trim(stripslashes($_POST['towin']));
			$game->rules = trim(stripslashes($_POST['rules']));
			
			// split by new lines
			$strategy_splits = explode("\n",stripslashes($_POST['strategies']));
			foreach($strategy_splits as $strategy)
			{
				// make sure the line isn't empty
				if(strlen(trim($strategy)) > 0)
				{
					// split the strategy into (Name): (Description) and add it to the array of strategies
					$index = strpos($strategy,":");
					$name = ucwords(trim(substr($strategy,0,$index)));
					$description = trim(substr($strategy,$index+1));
					$game->strategies[] = array("name"=>$name, "description"=>$description);
				}
			}
			
			$variant_splits = explode("\n",stripslashes($_POST['variants']));
			foreach($variant_splits as $variant)
			{
				if(strlen(trim($variant)) > 0)
				{
					$index = strpos($variant,":");
					$name = ucwords(trim(substr($variant,0,$index)));
					$description = trim(substr($variant,$index+1));
					$game->variants[] = array("name"=>$name, "description"=>$description);
				}
			}
			
			$alternate_splits = explode("\n",stripslashes($_POST['alternates']));
			foreach($alternate_splits as $alternate)
				if(strlen(trim($alternate)) > 0)
					$game->alternates[] = trim(ucwords($alternate));
			
			$pictures_splits = explode("\n",stripslashes($_POST['pictures']));
			foreach($pictures_splits as $picture)
				if(strlen(trim($picture)) > 0)
					$game->pictures[] = trim($picture);
				
			$reference_splits = explode("\n",stripslashes($_POST['references']));
			foreach($reference_splits as $reference)
				if(strlen(trim($reference)) > 0)
					$game->references[] = trim($reference);
			
			$link_splits = explode("\n",stripslashes($_POST['links']));
			foreach($link_splits as $link)
			{
				$link = trim($link);
				// make sure the link isn't empty
				if(strlen(trim($link)) > 0)
				{
					// parse the link into (Description) [(link)]
					$index = strpos($link,"[");
					$secondindex = strpos($link,"]");
					$description = ucwords(trim(substr($link,0,$index)));
					$url = trim(substr($link,$index+1,$secondindex - $index - 1));
					$game->links[] = array("url"=>$url, "description"=>$description);
				}
			}
			
			$gamescrafter_splits = explode("\n",stripslashes($_POST['gamescrafters']));
			foreach($gamescrafter_splits as $gamescrafter)
				if(strlen(trim($gamescrafter)) > 0)
					$game->gamescrafters[] = trim(ucwords($gamescrafter));
			
			// save the game and success!
			$game->save();
			header("Location: ../games.php?game=$game->code");
		}
		else
			header("Location: editgame.php?error=1"); // invalid game name
	}
	
	function procNewUser()
	{
		$doc = new DOMDocument('1.0', 'UTF-8');
        	$doc->formatOutput = true;
        	$root = $doc->createElement("member");
        	$root = $doc->appendChild($root);

		$nameAttr = $root->appendChild($doc->createAttribute("name"));
		$nameAttr->appendChild($doc->createTextNode($_POST['name']));
        
		require_once '../members/member.class.php';
		$count = memberCount();
		$numberAttr = $root->appendChild($doc->createAttribute("number"));
		$numberAttr->appendChild($doc->createTextNode($count+1));

		$year = $root->appendChild($doc->createElement("year"));
        	$year->appendChild($doc->createTextNode($_POST['year']));

		$major = $root->appendChild($doc->createElement("major"));
                $major->appendChild($doc->createTextNode($_POST['major']));
		
		$firstsemester = $root->appendChild($doc->createElement("semester-joined"));
                $firstsemester->appendChild($doc->createTextNode($_POST['semester-joined']));
		
		$semesters = $root->appendChild($doc->createElement("gc-semesters"));
                $semesters->appendChild($doc->createTextNode($_POST['gc-semesters']));
		
		$projects = $root->appendChild($doc->createElement("projects"));
              $project = $projects->appendChild($doc->createElement("project"));
                $project->appendChild($doc->createTextNode($_POST['projects']));

		$biography = $root->appendChild($doc->createElement("biography"));
                $biography->appendChild($doc->createTextNode($_POST['biography']));

		$favoriteGame = $root->appendChild($doc->createElement("favorite-game"));
                $favoriteGame->appendChild($doc->createTextNode($_POST['favorite-game']));

		$favoriteIceCream = $root->appendChild($doc->createElement("favorite-ice-cream"));
                $favoriteIceCream->appendChild($doc->createTextNode($_POST['favorite-ice-cream']));	
        	
		$semesterJoined = $_POST['semester-joined'];
		if ($semesterJoined == "Spring 2020") {
            $semesterAbbrev = "sp20";
        } else if ($semesterJoined == "Fall 2020") {
            $semesterAbbrev = "fa20";
        } else {
            $semesterAbbrev = str_replace(array("Fall", "Spring", " ", "20"), array("fa", "sp", "", ""), $semesterJoined);
        }
		$shortName = str_replace(" ", "", $_POST['name']);

		$photographs = $root->appendChild($doc->createElement("photographs"));
		
		$normal = $photographs->appendChild($doc->createElement("normal"));
		$normal->appendChild($doc->createTextNode("$semesterAbbrev/resized-{$shortName}.jpg"));
		$photographs->appendChild($normal);

		$normalFullsize = $photographs->appendChild($doc->createElement("normal-fullsize"));
		$normalFullsize->appendChild($doc->createTextNode("$semesterAbbrev/$shortName.jpg"));
		$photographs->appendChild($normalFullsize);

		$crazy = $photographs->appendChild($doc->createElement("crazy"));
		$crazy->appendChild($doc->createTextNode("$semesterAbbrev/resized-{$shortName}Crazy.jpg"));
		$photographs->appendChild($crazy);
		$crazyFullsize = $photographs->appendChild($doc->createElement("crazy-fullsize"));
		$crazyFullsize->appendChild($doc->createTextNode("$semesterAbbrev/{$shortName}Crazy.jpg"));
		$photographs->appendChild($crazyFullsize);

		$quote = $root->appendChild($doc->createElement("quote"));
                $quote->appendChild($doc->createTextNode($_POST['quote']));	
		
		$firstletter = strtolower($_POST['name'][0]);
		$dashedName = str_replace(" ", "-", $_POST['name']);

        if (file_exists("../members/xml/$firstletter/$dashedName.xml")) {
            // TODO: Attempt to save the file with a different name (perhaps with some incrementing suffix)
            echo "Unpleasant surprise! Name already exists :( You can, however, manually add the xml entry.";
            return;
        }

		$doc->save("../members/xml/$firstletter/$dashedName.xml");

		header("Location: managemembers.php");
	}
}

/* Initialize process */
$process = new Process;

?>