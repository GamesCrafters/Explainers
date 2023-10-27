<?php include '../site-legacy-archive-sp20/common.php'; ?>
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
           <h2>manage games</h2>
           <a href="editgame.php">Add Game</a>
           <table id="games">
           <tr>
           		<th>Game</th>
                <th>Code</th>
                <th>Edit</th>
                <th>x</th>
           </tr>
		   <?php
				$files = GetFiles('../games/');
				foreach($files as $file)
				{
					if(strpos($file,".xml") !== false)
					{
						// loads in the game and finds the name and code
						$doc = new DOMDocument();
						$doc->load("../games/$file");
						$game = $doc->getElementsByTagName("game")->item(0);
						$name = $game->getElementsByTagName("name")->item(0)->nodeValue;
						$code = $game->getElementsByTagName("code")->item(0)->nodeValue;
						echo "<tr>";
						echo "<td><a href=\"../games.php?game=$code\">$name</a></td>";
						echo "<td>$code</td>";
						echo "<td><a href=\"editgame.php?game=$code\">Edit</a></td>";
						echo "<td><a href=\"process.php?action=deletegame&amp;game=$code\">Delete</a></td>";
						echo "</tr>";
					}
				}
            ?>
            </table>
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
        <?php PrintFooter(); ?>
    </body>
</html>