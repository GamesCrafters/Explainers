<?php include '../site-legacy-archive-sp20/common.php'; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-US">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="author" content="UC Berkeley GamesCrafters Research Group">
        <meta name="description" content="A research and development group formed by Dr. Dan Garcia in 2001 to explore the fertile area of combinatorial and computational game theory.">
        <meta name="copyright" content="&copy; copyright 2007 by GamesCrafters">
        <title>GamesCrafters :: Admin</title>
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
        	<h2>Documentation</h2>
			<p>While there is not any full-fledged documentation, here are some tips to help you make any necessary changes.</p>
            <ul>
            	<li>All game image files are stored under /games/i/ and all website resources are stored under /resources. Do not use the two interchangeably.</li>
                <li>For maximum portability, <strong>all links are relative</strong>.</li>
            	<li>Of all the files in root, only <code>gcgame.php</code> and <code>common.php</code> are not directly displayed. <code>gcgame.php</code> is main game class that handles loading and saving games. <code>common.php</code> contains functions for printing out the header and footer of each page, printing out a list of games, and for getting all files in a specific directory.</li>
                <li>Each page should contain a title in the form of &quot;GamesCrafters :: Page Title&quot;</li>
                <li>Each page should have the same structure: a call to PrintHeader, main content, and a call to PrintFooter.</li>
            </ul>
        </div>
        <!-- side navigation bar -->
        <div id="sidebar">
            <h2>admin</h2>
            <ul>
            	<li><a href="./">Admin</a></li>
                <li><a href="documentation.php">Documentation</a></li>
            	<li><a href="managegames.php">Manage Games</a></li>
                <li><a href="manageimages.php">Manage Images</a></li>
            </ul>
        </div>
        <?php PrintFooter("../"); ?>
    </body>
</html>