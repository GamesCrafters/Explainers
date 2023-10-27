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
        <script type="text/javascript" src="/site-legacy-archive-sp20/resources/layout.js"></script>
    </head>
    <body>
        <!-- top header bar with main site navigation -->
        <?php PrintHeader("../"); ?>
        <!-- main page content -->
        <div id="main">
           <p>Hi there. You've probably been tasked with managing and updating this website. This web interface is dedicated to abstracting away many tasks that would normally require a console.  Please read the following guidelines before you get started on anything.</p>
			<ul>
            	<li>First of all, please <strong>do not leave extraneous files</strong> floating around the website. A complete overhaul of the site was written because the old website had layers upon layers of unused or broken pages. It wasn't easy, but the site is now clean.</li>
                <li>Make sure all pages are <strong>Valid HTML 4.01 Strict</strong>. No errors or warnings will be tolerated. You can use <a href="http://validator.w3.org/" rel="external">WC3's markup validator</a> to validate any page. Look at existing pages if you need any guidance.</li>
                <li>All game XML files are standardized and methods have been written to deal with them. <strong>DO NOT edit game files by hand</strong>. There's a handy edit games feature on this website for that very reason.</li>
                <li>All game image files are stored under /games/i/ and all website resources are stored under /resources. Do not use the two interchangeably.</li>
                <li>For maximum portability, <strong>all links are relative</strong>.</li>
            </ul>
        </div>
        <!-- side navigation bar -->
        <div id="sidebar">
            <h2>admin</h2>
            <ul>
            	<li><a href="admin.php">Admin</a></li>
            	<li><a href="managegames.php">Manage Games</a></li>
                <li><a href="manageimages.php">Manage Images</a></li>
            </ul>
        </div>
        <?php PrintFooter("../"); ?>
    </body>
</html>