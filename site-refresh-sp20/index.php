<?php require "common.inc" ?>
<!doctype html>
<html>
<head>
    <?php renderHead("Home") ?>
</head>
<body>
    <?php renderLogoAndNav() ?>
    <div class="page-sidebar">
        <div class="page-sidebar-wrapper">
            <h2>Welcome!</h2>
            <ul>
                <li><a href="http://www.cs.berkeley.edu/~ddgarcia/">Dr. Dan Garcia</a></li>
            </ul>
        </div>
    </div>
    <div class="page-content">
        <div class="page-content-wrapper">
            <div class="highlight-box">
                <div class="highlight-box-wrapper">
                    <h2>Play now!</h2>
                    <p><a href="https://nyc.cs.berkeley.edu/uni/" target="_blank">Check out our games on GamesmanUni!</a></p>
                </div>
                <div class="highlight-box-wrapper">
                    <h2>Interested in joining GamesCrafters?</h2>
                    <p>We are meeting MWF 11am-noon this Spring 2023 semester in 606 Soda... Join us!</p>
                </div>
                <div class="highlight-box-wrapper">
                    <h2>CalWeek 2022</h2>
                    <p><a href="/calday2022">We put together a special page full of goodies for CalDay! Check them out here.</a></p>
                </div>
            </div>
            <p>The UC Berkeley GamesCrafters research and development group was formed by Teaching Prof. Dan Garcia in 2001 to explore the fertile area of combinatorial and computational game theory. At the core of the project is GAMESMAN, a system developed for solving, playing and analyzing two-person, abstract strategy games (e.g., Tic-Tac-Toe, or Chess). Given the description of a game as input, our system generates a text-based and Tcl/Tk graphical application that will solve it (in the strong sense), and then play it perfectly. Programmers can easily prototype a new game with multiple rule variants, learn the strategy via color-coded moves, and perform extended analysis. Since its inception, more than sixty-eight games have been integrated into the system by over five hundred undergraduates, with still more in development. While most students implemented new games, others modified the core architecture, wrote game-specific optimal hash functions, and added databases to increase the program's speed and efficiency. Designing intuitive and aesthetic graphical user interfaces has also been popular project. Our future research direction is principally "hunting big game" &mdash; implementing, solving and analyzing large games whose perfect strategy is yet unknown.</p>
            <figure>
                <img src="/members/group/main/GamesCrafters2023Sp.jpg" alt="The Spring 2023 GamesCrafters">
                <figcaption>The Spring 2023 GamesCrafters</figcaption>
            </figure>
        </div>
    </div>
    <?php renderFooter() ?>
</body>
</html>