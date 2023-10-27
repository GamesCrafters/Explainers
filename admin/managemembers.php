<?php
include '../site-legacy-archive-sp20/common.php';
define("ERROR_FILE_EXISTS", 1);
define("ERROR_INVALID_EXTENSION", 2);
define("ERROR_FILE_SIZE", 3);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="author" content="UC Berkeley GamesCrafters Research Group">
    <meta name="description"
          content="A research and development group formed by Dr. Dan Garcia in 2001 to explore the fertile area of combinatorial and computational game theory.">
    <meta name="copyright" content="&copy; copyright 2007 by GamesCrafters">
    <title>GamesCrafters :: Admin :: Manage Members</title>
    <link rel="shortcut icon" href="/site-legacy-archive-sp20/resources/gc.png" type="image/png">
    <link rel="stylesheet" href="/site-legacy-archive-sp20/resources/stylesheet.css" type="text/css">
    <!--[if lt IE 7]>
    <link rel="stylesheet" href="/site-legacy-archive-sp20/resources/iefixes.css" type="text/css">
    <![endif]-->
    <script type="text/javascript" src="/site-legacy-archive-sp20/resources/layout.js"></script>
</head>
<body>
<!-- top header bar with main site navigation -->
<?php PrintHeader("../"); ?>
<!-- main page content -->
<div id="main">
    <h2 style="margin-bottom:10px">manage members</h2>
    <div>
        <?php
        if (isset($_REQUEST['success'])) {
            echo "File successfully uploaded for <strong>{$_REQUEST['uploadgame']}</strong> as {$_REQUEST['success']}";
        }
        ?>
    </div>
    <h3>Create New User (#<?= memberCount() + 1 ?>)</h3>
    <form method="post" action="process.php" name="createnewuser">
        <table class="form">
            <tr>
                <td>Name</td>
                <td><input name="name" id="name"></td>
            </tr>
            <tr>
                <td>Year</td>
                <td><input name="year" id="year"></td>
            </tr>
            <tr>
                <td>Major</td>
                <td><input name="major" id="major"></td>
            </tr>
            <tr>
                <td>First Semester in GC</td>
                <td>
                    <select name="semester-joined" id="semester-joined">
                        <option value="Spring 2020">Spring 2020</option>
                        <option value="Fall 2019">Fall 2019</option>
                        <option value="Spring 2019">Spring 2019</option>
                        <option value="Fall 2018">Fall 2018</option>
                        <option value="Spring 2018">Spring 2018</option>
                        <!--<option value="Spring 2011">Spring 2011/option>-->
                        <option value="Fall 2010">Fall 2010</option>
                        <option value="Spring 2010">Spring 2010</option>
                        <option value="Fall 2009">Fall 2009</option>
                        <option value="Spring 2009">Spring 2009</option>
                        <option value="Fall 2008">Fall 2008</option>
                        <option value="Spring 2008">Spring 2008</option>
                        <option value="Fall 2007">Fall 2007</option>
                        <option value="Spring 2007">Spring 2007</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Semesters in GC</td>
                <td><input name="gc-semesters" id="gc-semesters"></td>
            </tr>
            <tr>
                <td>Projects</td>
                <td><input name="projects" id="projects"></td>
            </tr>
            <tr>
                <td>Bio</td>
                <td><input name="biography" id="biography"></td>
            </tr>
            <tr>
                <td>Quote</td>
                <td><input name="quote" id="quote"></td>
            </tr>
            <tr>
                <td>Favorite Gamescraftersy Game</td>
                <td><input name="favorite-game" id="favorite-game"></td>
            </tr>
            <tr>
                <td>Favorite Ice Cream</td>
                <td><input name="favorite-ice-cream" id="favorite-ice-cream"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="createnewuser">
                    <input type="submit" value="Submit">
                </td>
            </tr>
        </table>
    </form>
    <br>
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
