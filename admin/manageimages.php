<?php
include '../site-legacy-archive-sp20/common.php';
define("ERROR_FILE_EXISTS", 1);
define("ERROR_INVALID_EXTENSION", 2);
define("ERROR_FILE_SIZE", 3);
define("ERROR_INVALID_GAME", 4);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="author" content="UC Berkeley GamesCrafters Research Group">
        <meta name="description" content="A research and development group formed by Dr. Dan Garcia in 2001 to explore the fertile area of combinatorial and computational game theory.">
        <meta name="copyright" content="&copy; copyright 2007 by GamesCrafters">
        <title>GamesCrafters :: Admin :: Manage Games</title>
        <link rel="shortcut icon" href="/site-legacy-archive-sp20/resources/gc.png" type="image/png">
        <link rel="stylesheet" href="/site-legacy-archive-sp20/resources/stylesheet.css" type="text/css">
        <!--[if lt IE 7]><link rel="stylesheet" href="/site-legacy-archive-sp20/resources/iefixes.css" type="text/css"><![endif]-->
        <script type="text/javascript" src="/site-legacy-archive-sp20/resources/layout.js"></script>
    </head>
    <body>
        <!-- top header bar with main site navigation -->
        <?php PrintHeader("../"); ?>
        <!-- main page content -->
        <div id="main">
           <h2 style="margin-bottom:10px">manage images</h2>
           <div>
           <?php
		   	if(isset($_REQUEST['success']))
			{
				echo "File successfully uploaded for <strong>{$_REQUEST['uploadgame']}</strong> as {$_REQUEST['success']}";
			}
		   ?>
           </div>
           <h3>Upload Game Image</h3>
           <form enctype="multipart/form-data" method="post" action="process.php" name="uploadgameimage">
               <div>
               		<?php
					PrintGameSelect(); 
                    if($_REQUEST['error'] == ERROR_INVALID_GAME)
						echo "<span style=\"color:red;\">Please select a game.</span>";
					?>
                   <input type="hidden" name="MAX_FILE_SIZE" value="2000000">
                   Choose a file to upload (png, jpg, gif):<br>
                   <input name="gameimageupload" type="file">
                   <?php
				   if(isset($_REQUEST['error']))
				   {
				   		if($_REQUEST['error'] == ERROR_FILE_EXISTS)
							echo "<span style=\"color:red;\">File already exists.</span>";
						else if($_REQUEST['error'] == ERROR_INVALID_EXTENSION)
							echo "<span style=\"color:red;\">Invalid extension. Please use jpg, gif, or png.</span>";
						else if($_REQUEST['error'] == ERROR_FILE_SIZE)
							echo "<span style=\"color:red;\">File size too large. Max size 2MB.</span>";
				   }
				   ?>
                   <br>
                   <div style="margin-top: 2px; margin-bottom: 2px;">
                   <input type="checkbox" name="disableautoname"> Disable auto-naming (Check this box if you want to embed the image in the rules)
                   </div>
                   <input type="submit" value="Submit">
                   <input type="hidden" name="uploadgameimage" value="1">
          	   </div>
           </form>
           <br>
           <h3>Delete Images</h3>
           <form method="get" action="">
           		<?php PrintGameSelect("onchange=\"form.submit();\""); ?>
           </form>
           <?php
		   if(isset($_REQUEST['game']) && $_REQUEST['game'] != '')
		   {
		   		$game = $_REQUEST['game'];
				$files = GetFiles("../games/i/$game");
				$images = array();
				foreach($files as $file)
				{
					$base = basename($file);
					$e = explode(".",$base);
					$extension = strtolower($e[count($e) - 1]);
					
					$valid_extensions = array("jpg", "jpeg", "gif", "png");
					if(array_search($extension, $valid_extensions) !== false)
					{
						$images[] = $base;
					}
				}
				echo "<h4>$game images</h4>";
				if(count($images) > 0)
				{
					?>
					<table>
						<tr>
							<th>file</th>
							<th>x</th>
						</tr>
					<?php
					foreach($images as $image)
					{
						echo "<tr><td>$image</td><td><a href=\"process.php?deleteimage=1&amp;game=$game&amp;image=".urlencode($image)."\">delete</a></td></tr>";
					}
					echo "</table>";
				}
				else
					echo "No pictures found.";
		   }
		   ?>
        </div>
        <!-- side navigation bar -->
        <div id="sidebar">
        	<h2>admin</h2>
            <ul>
            	<li><a href="./">Admin</a></li>
            	<li><a href="managegames.php">Manage Games</a></li>
                <li><a href="manageimages.php">Manage Images</a></li>
                <li><a href="managemembers.php">Manage Members</a></li>
            </ul>
        </div>
        <?php PrintFooter("../"); ?>
    </body>
</html>

<?php
// Prints a <select> list of games, with optional javascript to include in the <select> tag.
function PrintGameSelect($javascript="")
{
	?>
	<p>Select Game: <select name="game" <?php echo $javascript; ?>>
	<option value="">Select Game</option>
	<?php
	$files = GetFiles('../games/');
	foreach($files as $file)
	{
		// find only the xml files
		if(strpos($file,".xml") !== false)
		{
			// loads in the document and finds the game name and code.
			$doc = new DOMDocument();
			$doc->load("../games/$file");
			$game = $doc->getElementsByTagName("game")->item(0);
			$name = htmlentities($game->getElementsByTagName("name")->item(0)->nodeValue);
			$code = $game->getElementsByTagName("code")->item(0)->nodeValue;
			echo "<option value=\"$code\">$name</option>";
		}
	}
	?>
	</select>
    </p>
    <?php
}
?>