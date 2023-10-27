<?php
require_once '../site-legacy-archive-sp20/gcgame.php';
include_once '../site-legacy-archive-sp20/common.php';

if(isset($_REQUEST['game']) && $_REQUEST['game'] != '')
    $game = new GCGame($_REQUEST['game'], "../");
else
    $game = new GCGame();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="author" content="UC Berkeley GamesCrafters Research Group">
        <meta name="description" content="A research and development group formed by Dr. Dan Garcia in 2001 to explore the fertile area of combinatorial and computational game theory.">
        <meta name="copyright" content="&copy; copyright 2007 by GamesCrafters">
        <title>GamesCrafters :: Edit Game</title>
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
            <h2>Edit Game</h2>
            <form enctype="multipart/form-data" method="post" action="process.php" name="subeditgame">
                <h3>Name</h3>
                <div><input name="name" value="<?php echo $game->name; ?>" alt="name of the game"> <?php if(isset($_GET['error']) && $_GET['error'] == 1) echo "<span style=\"color:red;\">Invalid Game Name</span>"; ?></div>
                <h3>Icon</h3>
                <div>
                <?php
                if($game->code != "")
                {
					// Determine icon extension.
                    $extension = "";
                    if(file_exists("../games/i/$game->code/$game->code.png"))
                        $extension = "png";
                    else if(file_exists("../games/i/$game->code/$game->code.jpg"))
                        $extension = "jpg";
                    else if(file_exists("../games/i/$game->code/$game->code.jpeg"))
                        $extension = "jpeg";
                    else if(file_exists("../games/i/$game->code/$game->code.gif"))
                        $extension = "gif";
                    if($extension != "")
                        echo "<img src=\"../games/i/$game->code/$game->code.$extension\" alt=\"$game->name\">";
                    else                        
                        echo "No icon file uploaded.";
                }
                ?>
                <br>
                <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
                Choose a file to upload (png, jpg, gif):<br>
                <input name="iconupload" type="file">
                <?php
                if(isset($_GET['error']) && $_GET['error'] == 2)
                    echo "<span style=\"color:red;\">Invalid extension. Please use jpg, gif, or png.</span>";
                if(isset($_GET['error']) && $_GET['error'] == 3)
                    echo "<span style=\"color:red;\">File size too big. Max is 1 MB.</span>";
                ?>
                </div>
                <h3>History</h3>
                <div><textarea name="history" rows="5" cols="60"><?php echo $game->history; ?></textarea></div>
                <h3>Board</h3>
                <div><textarea name="board" rows="5" cols="60"><?php echo $game->board; ?></textarea></div>
                <h3>Pieces</h3>
                <div><textarea name="pieces" rows="5" cols="60"><?php echo $game->pieces; ?></textarea></div>
                <h3>To Move</h3>
                <div><textarea name="tomove" rows="5" cols="60"><?php echo $game->tomove; ?></textarea></div>
                <h3>To Win</h3>
                <div><textarea name="towin" rows="5" cols="60"><?php echo $game->towin; ?></textarea></div>
                <h3>Rules</h3>
                <div>Embedded image syntax: [img src="games/i/ss/1210a.jpg" alt="1,2,...10 board" width="200"]<br>
                <?php PrintValidImages(); ?>
                <textarea name="rules" rows="5" cols="60"><?php echo $game->rules; ?></textarea></div>
                <h3>Strategies (one per line)</h3>
                <div>
                    Syntax: &lt;Strategy Name&gt;: &lt;Strategy Description&gt;<br>
                    <strong>Example:</strong> Safety in Numbers: Keep your pieces close together.<br>
                    <textarea name="strategies" rows="5" cols="60"><?php
                    foreach($game->strategies as $strategy)
                        echo "{$strategy['name']}: {$strategy['description']}\n";
                    ?></textarea>
                </div>
                
                <h3>Variants (one per line)</h3>
                <div>
                    Syntax: &lt;Variant Name&gt;: &lt;Variant Description&gt;<br>
                    <strong>Example:</strong> Misere: Reverses the rules.<br>
                    <textarea name="variants" rows="5" cols="60"><?php
                    foreach($game->variants as $variant)
                        echo "{$variant['name']}: {$variant['description']}\n";
                    ?></textarea>
                </div>
                
                <h3>Alternate Names (one per line)</h3>
                <div><textarea name="alternates" rows="5" cols="60"><?php
                foreach($game->alternates as $alternate)
                    echo "$alternate\n";
                ?></textarea></div>
                <h3>Pictures (one per line)</h3>
                <div>
                    Embedded image syntax: [img src="abalone_01.jpg" alt="abalone" width="200"]<br>
                    <?php PrintValidImages(); ?>
                    <textarea name="pictures" rows="5" cols="60"><?php
                    foreach($game->pictures as $picture)
                        echo "$picture\n";
                    ?></textarea>
                </div>
                
                <h3>References (one per line)</h3>
                <div><textarea name="references" rows="5" cols="60"><?php
                foreach($game->references as $reference)
                    echo "$reference\n";
                ?></textarea></div>
                
                <h3>Links (one per line)</h3>
                <div>
                    Syntax: &lt;Link Description&gt; [&lt;Link URL&gt;]<br>
                    <strong>Example:</strong> Official Abalone Site [http://uk.abalonegames.com/]<br>
                    <textarea name="links" rows="5" cols="60"><?php
                    foreach($game->links as $link)
                        echo "{$link['description']} [{$link['url']}]\n";
                    ?></textarea>
                </div>
                
                <h3>Gamescrafters (one per line)</h3>
                <div><textarea name="gamescrafters" rows="5" cols="60"><?php
                foreach($game->gamescrafters as $gamescrafter)
                    echo "$gamescrafter\n";
                ?></textarea></div>
                <div>
                    <br>
                    <input type="submit" value="Submit">
                    <input type="hidden" name="subeditgame" value="1">
                </div>
            </form>
        </div>
        <!-- side navigation bar -->
        <div id="sidebar">
            <?php GamesSidebar("../games.php", "../"); ?>
        </div>
        <?php PrintFooter(); ?>
    </body>
</html>

<?php
function PrintValidImages()
{
	global $game;
	echo "<h4>Valid Pictures</h4><ul>";
	$files = GetFiles("../games/i/$game->code");
	$hasitems = false;
	foreach($files as $file)
	{
		$base = basename($file);
		$e = explode(".",$base);
		$extension = strtolower($e[count($e) - 1]);
		
		$valid_extensions = array("jpg", "jpeg", "gif", "png");
		if(array_search($extension, $valid_extensions) !== false)
		{
			if($e[0] != $game->code)
			{
				echo "<li>$base</li>";
				$hasitems = true;
			}
		}
	}
	if(!$hasitems)
		echo "<li>No valid pictures found.</li>";
	echo "</ul>";
}
?>