<?php 

require "common.inc";

// Read all games

require_once '../instructions/game.class.php';

$rootDir = "../instructions";
$xmlGameDir = "$rootDir/eng/games";
$gameCodeAndNames = [];
foreach (GetFiles($xmlGameDir) as $xml) {
    $xml = "$xmlGameDir/$xml";
    if (!strpos($xml, ".xml")) continue;
    $game = new Game($xml, "$rootDir/");
    $gameCodeAndNames[] = [$game->code, $game->name];
}
unset($game);
$numGames = count($gameCodeAndNames);

$xmlPuzzleDir = "$rootDir/eng/puzzles";
$puzzleCodeAndNames = [];
foreach (GetFiles($xmlPuzzleDir) as $xml) {
    $xml = "$xmlPuzzleDir/$xml";
    if (!strpos($xml, ".xml")) continue;
    $game = new Game($xml, "$rootDir/");
    $puzzleCodeAndNames[] = [$game->code, $game->name];
}
unset($game);
$numPuzzles = count($puzzleCodeAndNames);

$sectionHeadings = [];

function renderSectionHeading($heading) {
    global $sectionHeadings;
    $id = 'sec-' . str_replace(' ', '-', strtolower($heading));
    $sectionHeadings[] = [
        'url' => "#$id",
        'description' => $heading
    ];
    ?><h3 id="<?= $id ?>"><?= $heading ?></h3><?php
}

function renderString($str, $allowBlockElements = false) {
    global $code;

    $replaced = $str;

    if ($allowBlockElements) {
        // Images
        $replaced = preg_replace(
            "/\[img\s+src\s*=\s*\"([^\"]*)\"([^\]]+)\]/",
            "</p><figure class='size-original'><a href=\"/instructions/i/$code/$1\"><img src=\"/instructions/i/$code/$1\" $2></a></figure><p>",
            $str);
    }

    // Links
    $replaced = preg_replace(
        "/&lt;\s*(http[^\s]*)\s*&gt;/",
        "<a href=\"$1\">$1</a>",
        $replaced);

    // Empty paragraphs
    $replaced = preg_replace(
        "/\[br\]/",
        "</p><p>",
        $replaced);

    echo $replaced;
}

function renderParagraphs($paragraphs) {
    renderString("<p>$paragraphs</p>", true);
}

function renderParagraphsWithHeading($heading, $paragraphs) {
    if ($paragraphs != '') {
        renderSectionHeading($heading);
        renderParagraphs($paragraphs);
    }
}

function renderParagraphsWithPrefix($prefix, $paragraphs) {
    if ($paragraphs != '') {
        renderParagraphs("<strong>$prefix</strong> " . $paragraphs);
    }
}

function renderListWithHeading($heading, $array, $listAttrs = '') {
    if (empty($array)) return;
    renderSectionHeading($heading);
    ?><ul <?= $listAttrs ?>><?php
    foreach ($array as $item) {
        ?><li><?php renderParagraphs($item) ?></li><?php
    }
    ?></ul><?php
}

function renderListOfLinks($array) {
    if (empty($array)) return;
    ?><ul><?php
    foreach ($array as $item) {
        ?><li><a href="<?= $item['url'] ?>"><?php renderString($item['description']) ?></a></li><?php
    }
    ?></ul><?php
}

function renderListOfLinksWithHeading($heading, $array) {
    if (empty($array)) return;
    renderSectionHeading($heading);
    renderListOfLinks($array);
}

function renderListDictionaryWithHeading($heading, $array) {
    if (empty($array)) return;
    renderSectionHeading($heading);
    ?><ul><?php
    foreach ($array as $item) {
        ?><li><strong><?php renderString($item['name']) ?>:</strong> <?php renderString($item['description']) ?></li><?php
    }
    ?></ul><?php
}

$gameRequested = false;
$game = NULL;
$lang = "eng";
$type = "games";
if (!empty($_GET["game"])) {
    $gameRequested = true;
    $code = $_GET["game"];
    if (!empty($_GET["lang"])) { // If language requested
        $lang = $_GET["lang"];
        $xml = "$rootDir/$lang/games/$code.xml";
        if (file_exists($xml)) { // See if file exists in requested language
            $game = new Game($xml, "");
        } else { // See if file exists in English
            $lang = "eng";
            $xml = "$xmlGameDir/$code.xml";
            if (file_exists($xml)) {
                $game = new Game($xml, "");
            }
        }
    } else { // Language not requested, default to English
        $xml = "$xmlGameDir/$code.xml";
    }
    if (file_exists($xml)) {
        $game = new Game($xml, "");
    }
} else if (!empty($_GET["puzzle"])) {
    $gameRequested = true;
    $type = "puzzles";
    $code = $_GET["puzzle"];
    if (!empty($_GET["lang"])) { // If language requested
        $lang = $_GET["lang"];
        $xml = "$rootDir/$lang/puzzles/$code.xml";
        if (file_exists($xml)) { // See if file exists in requested language
            $game = new Game($xml, "");
        } else { // See if file exists in English
            $lang = "eng";
            $xml = "$xmlPuzzleDir/$code.xml";
            if (file_exists($xml)) {
                $game = new Game($xml, "");
            }
        }
    } else { // Language not requested, default to English
        $xml = "$xmlPuzzleDir/$code.xml";
    }
    if (file_exists($xml)) {
        $game = new Game($xml, "");
    }
}

// Reprise sidebar if content wants to overwrite the sidebar
$sidebarReprise = !empty($game);

?>
<!doctype html>
<html>
<head>
    <?php renderHead("Games") ?>
</head>
<body class="<?= $sidebarReprise ? 'sidebar-reprise' : '' ?>">
    <?php renderLogoAndNav() ?>
    <?php ob_start(); // Start content buffer ?>
    <div id="page-content-games" class="page-content">
        <div class="page-content-wrapper">
            <?php if ($gameRequested) { ?>
                <?php if (!empty($game)) { ?>
                    <div class="game">
                        <div class="game-wrapper">
                            <?php
                            $extension = '';
                            if (file_exists("$rootDir/games/i/$code/$code.png")) $extension = "png";
                            else if (file_exists("$rootDir/games/i/$code/$code.svg")) $extension = "svg";
                            else if (file_exists("$rootDir/games/i/$code/$code.jpg")) $extension = "jpg";
                            else if (file_exists("$rootDir/games/i/$code/$code.jpeg")) $extension = "jpeg";
                            else if (file_exists("$rootDir/games/i/$code/$code.gif")) $extension = "gif";
                            if (!empty($extension)) { ?><img class="game-icon" src="/games/i/<?= $code ?>/<?= $code ?>.<?= $extension ?>" alt="<?= $game->name ?>"><?php } ?>
                            <h2><?= $game->name ?></h2>
                            <p><a href="/instructions/<?= $lang ?>/<?= $type ?>/<?= $code ?>.xml">Download XML</a></p>
                        </div>
                    </div>
                    <?php renderParagraphsWithHeading("History", $game->history) ?>
                    <?php renderParagraphsWithHeading("The Board", $game->board) ?>
                    <?php renderParagraphsWithHeading("The Pieces", $game->pieces) ?>
                    <?php if (!empty($game->tomove) || !empty($game->towin) || !empty($game->rules)) { ?>
                        <?php renderSectionHeading("Rules") ?>
                        <?php renderParagraphsWithPrefix("To move:", $game->tomove) ?>
                        <?php renderParagraphsWithPrefix("To win:", $game->towin) ?>
                        <?php renderParagraphs($game->rules) ?>
                    <?php } ?>
                    <?php renderListDictionaryWithHeading("Strategies", $game->strategies) ?>
                    <?php renderListDictionaryWithHeading("Variants", $game->variants) ?>
                    <?php renderListWithHeading("Alternate Names", $game->alternates) ?>
                    <?php renderListWithHeading("Pictures", $game->pictures, 'class="game-pictures"') ?>
                    <?php renderListWithHeading("References", $game->references) ?>
                    <?php renderListOfLinksWithHeading("Links", $game->links) ?>
                    <?php renderListWithHeading("GamesCrafters", $game->gamescrafters) ?>
                <?php } else { ?><h3>Game Not Found</h3><p>Uh oh...</p><?php } ?>
            <?php } else { ?>
                <h3>GAMESMAN</h3>
                <p>The games this project considers are two-person, abstract strategy games such as Tic-Tac-Toe, Connect 4, and Mancala.<br>The family of abstract games shares a set of characteristics that allow for computational solvability. These characteristics are:</p>
                <ul>
                    <li>Perfect information, meaning that all information must be available to both players at all times.</li>
                    <li>No chance, which implies no dice, shuffling, or spinning</li>
                </ul>
                <p>Together, these properties allow for strong, non-probabilistic solutions which can be used to simulate a perfect computer player.</p>
                <p>There are currently <strong><?= $numGames ?> game<?= $numGames != 1 ? 's' : '' ?></strong> and <strong><?= $numPuzzles ?> puzzle<?= $numPuzzles != 1 ? 's' : '' ?></strong> in our system.</p>
                <blockquote>
                    <p>Every game ever invented by mankind, is a way of making things hard for the fun of it!</p>
                    <p>&mdash; <cite>John Ciardi</cite></p>
                </blockquote>
            <?php } ?>
        </div>
    </div>
    <?php $pageContent = ob_get_contents(); ob_end_clean(); // End content buffer ?>
    <?php if (!empty($game)) { ?>
        <div class="page-sidebar">
            <div class="page-sidebar-wrapper">
                <h2><?= $game->name ?></h2>
                <?php renderListOfLinks($sectionHeadings) ?>
            </div>
        </div>
    <?php } ?>
    <?php echo $pageContent ?>
    <div class="page-sidebar <?= $sidebarReprise ? 'page-sidebar-reprise' : '' ?>">
        <div class="page-sidebar-wrapper">
            <h2>Games</h2>
            <h3>All Games</h3>
            <ul>
                <?php foreach ($gameCodeAndNames as $codeAndName) {
                    $code = $codeAndName[0];
                    $name = $codeAndName[1];
                    ?><li><a href="?game=<?= $code ?>"><?= $name ?></a></li><?php
                } ?>
            </ul>
            <h3>All Puzzles</h3>
            <ul>
                <?php foreach ($puzzleCodeAndNames as $codeAndName) {
                    $code = $codeAndName[0];
                    $name = $codeAndName[1];
                    ?><li><a href="?puzzle=<?= $code ?>"><?= $name ?></a></li><?php
                } ?>
            </ul>
        </div>
    </div>
    <?php renderFooter() ?>
</body>
</html>