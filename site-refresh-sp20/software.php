<?php require "common.inc" ?>
<!doctype html>
<html>
<head>
    <?php renderHead("Software") ?>
</head>
<body>
    <?php renderLogoAndNav() ?>
    <div class="page-sidebar">
        <div class="page-sidebar-wrapper">
            <h2>Software</h2>
            <ul>
                <li><a href="https://nyc.cs.berkeley.edu/wiki/Projects">All projects</a></li>
                <li><a href="https://github.com/GamesCrafters">GitHub repositories</a></li>
            </ul>
        </div>
    </div>
    <div class="page-content">
        <div class="page-content-wrapper">
            <h3><abbr>GAMESMAN</abbr></h3>
            <p><dfn>Game-independent Automatic Move/position-tree Exhaustive-Search, Manipulation And Navigation</dfn></p>
            <p>Gamesman is the centerpiece of the GamesCrafters project. It provides a framework for our researchers to describe a board game in the C programming language. Once the description is completed, Gamesman can solve that game by evaluating every possible board position. Gamesman can then determine the value for each position, i.e. if a perfect player will win, lose, or tie against a perfect opponent. After the game has been solved and the value for every position is known, Gamesman allows the user to play against a perfect opponent, as well as optionally display information about who is winning. Combined with Gamesman's perfect knowledge about each possible move, the human player can then develop perfect strategies for playing the game. Gamesman also allows you to play many of our games using a graphical interface.</p>
            <p>You can find all GamesCrafters projects <a href="https://nyc.cs.berkeley.edu/wiki/Projects">here</a>.</p>
            <h3>Related Links</h3>
            <ul>
                <li>Aaron Siegel's <a href="http://cgsuite.sourceforge.net/">CGSuite</a> (currently version 0.7 beta).</li>
                <li><a href="../software/rearranger.scm">Scheme code (<code>.scm</code> file)</a> for a perfect hash for Rearranger-style games with one or two types of pieces.</li>
            </ul>
            <hr>
            <blockquote>
                <p>
                    There once was a prof known as Danny...<br>
                    who couldn't play games worth a penny.<br>
                    He wrote a small program...<br>
                    that played them all fo' him.<br>
                    Now he indeed seems quite canny!
                </p>
                <p>&mdash; <cite>Daniel Horn, UC Berkeley class of 2003</cite></p>
            </blockquote>
        </div>
    </div>
    <?php renderFooter() ?>
</body>
</html>