<?php
date_default_timezone_set('America/Los_Angeles');

// Use $prefix in case you are in subdirectories since everything on this site is relative.
// $current: the current page (we make the link unclickable so you can't go back to the same page)
function PrintHeader($prefix = "", $current = "")
{
    ?>
    <div id="header">
        <a id="imagemap-home" class="imagemap" href="<?php echo $prefix; ?>./" title="GamesCrafters Home">GamesCrafters</a>
        <a id="imagemap-g" class="imagemap letter" href="<?php echo $prefix; ?>games.php" title="Games">games</a>
        <a id="imagemap-a" class="imagemap letter" href="<?php echo $prefix; ?>analysis.php" title="Analysis">analysis</a>
        <a id="imagemap-m" class="imagemap letter" href="<?php echo $prefix; ?>members.php" title="Members">members</a>
        <a id="imagemap-e" class="imagemap letter" href="<?php echo $prefix; ?>extra.php" title="Extra">extra</a>
        <a id="imagemap-s" class="imagemap letter" href="<?php echo $prefix; ?>software.php" title="Software">software</a>
        <h1>
            <a href="<?php echo $prefix; ?>./" title="GamesCrafters Home">GamesCrafters</a>
        </h1>
        <ul id="site-navigation">
            <li><a <?= ($current == 'games') ? 'class="current"' : 'href="' . $prefix . 'games.php" title="Games"' ?>>games</a>
            </li>
            <li>
                <a <?= ($current == 'analysis') ? 'class="current"' : 'href="' . $prefix . 'analysis.php" title="Analysis"' ?>>analysis</a>
            </li>
            <li>
                <a <?= ($current == 'members') ? 'class="current"' : 'href="' . $prefix . 'members.php" title="Members"' ?>>members</a>
            </li>
            <li><a <?= ($current == 'extra') ? 'class="current"' : 'href="' . $prefix . 'extra.php" title="Extra"' ?>>extra</a>
            </li>
            <li>
                <a <?= ($current == 'software') ? 'class="current"' : 'href="' . $prefix . 'software.php" title="Software"' ?>>software</a>
            </li>
        </ul>
    </div>
    <?php
}

// Use $prefix in case you are in subdirectories since everything on this site is relative.
// Set $showOCF to true to display the OCF logo
function PrintFooter($prefix = "", $showOCF = false)
{
    ?>
    <!-- page footer -->
    <div id="footer">
        <p>
            <a href="http://www.berkeley.edu/" rel="external">UC Berkeley</a> |
            <a href="<?= $prefix ?>admin/">Admin</a> |
            This page last modified: <?= date('c', filemtime($_SERVER['SCRIPT_FILENAME'])) ?>
            <?php
            if ($showOCF) {
                echo ' | ' . "\n" . '            <a href="http://www.ocf.berkeley.edu" rel="external"><img src="http://www.ocf.berkeley.edu/images/hosted-logos/ocfbadge_mini8dark.png" 
alt="Hosted by the OCF" style="border: 0; width: 98px; height: 39px; vertical-align: middle"></a>' . "\n";
            }
            ?>
        </p>
    </div>
    <script type="text/javascript">var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
        document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E")); </script>
    <script type="text/javascript"> var pageTracker = _gat._getTracker("UA-3581208-1");
        pageTracker._initData();
        pageTracker._trackPageview(); </script>
    <?php
}

// Prints a list of games (usually in the sidebar)
// $page: represents the page you want the game to link to.
// 		  Ex: if you want to link to editgames.php, the links will print out as editgames.php?game=abalone
// Use $prefix in case you are in subdirectories since everything on this site is relative.
function GamesSidebar($page = "", $prefix = "")
{
    ?>
    <h2><a href="http://nyc.cs.berkeley.edu/gcweb/">play now</a></h2>
    <h2>puzzles</h2>
    <ul id="puzzles">
        <?php
        $files = GetFiles("{$prefix}games/puzzles/");

        foreach ($files as $file) {
            if (strpos($file, ".xml") !== false) {
                $doc = new DOMDocument();
                $doc->load($prefix . 'games/puzzles/' . $file);
                $game = $doc->getElementsByTagName("game")->item(0);
                $name = $game->getElementsByTagName("name")->item(0)->nodeValue;
                $code = $game->getElementsByTagName("code")->item(0)->nodeValue;
                echo '<li><a href="' . $page . '?puzzle=' . $code . '">' . $name . '</a></li>' . "\n";
            }
        }
        ?>
    </ul>

    <h2>games</h2>
    <ul>
        <li><a href="makegame.php">Make Your Own</a></li>
    </ul>
    <ul id="games">
        <?php
        $files = GetFiles("{$prefix}games/");

        foreach ($files as $file) {
            if (strpos($file, ".xml") !== false) {
                $doc = new DOMDocument();
                $doc->load($prefix . 'games/' . $file);
                $game = $doc->getElementsByTagName("game")->item(0);
                $name = $game->getElementsByTagName("name")->item(0)->nodeValue;
                $code = $game->getElementsByTagName("code")->item(0)->nodeValue;
                echo '<li><a href="' . $page . '?game=' . $code . '">' . $name . '</a></li>' . "\n";
            }
        }
        ?>
    </ul>
    <?php
}

// Gets all the files in a specific directory, sorted.
function GetFiles($directory)
{
    $files = array();
    if ($handle = opendir($directory)) {
        while (false !== ($file = readdir($handle)))
            if ($file[0] != ".") // Ignore ., .., .gitignore, etc.
                $files[] = $file;
        closedir($handle);
    }
    sort($files);
    return $files;
}

function GetNumGames($prefix = "")
{
    $count = 0;
    $files = GetFiles("{$prefix}games/");

    foreach ($files as $file) {
        if (strpos($file, ".xml") !== false)
            $count++;
    }
    return $count;
}

function memberCount()
{
    $count = 0;
    $rootDir = __DIR__ . '/../members/xml';
    foreach (GetFiles($rootDir) as $subdir) {
        $subdir = $rootDir . '/' . $subdir;
        foreach (GetFiles($subdir) as $xml) {
            $count++;
        }
    }
    return $count;
}

?>
