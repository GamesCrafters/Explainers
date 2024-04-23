<?php

require "common.inc";

// Read all members

require_once '../members/individual/member.class.php';

$xmlDir = '../members/xml';
$members = [];

foreach (GetFiles($xmlDir) as $subdir) {
    $subdir = $xmlDir . '/' . $subdir;
    foreach (GetFiles($subdir) as $xml) {
        $xml = $subdir . '/' . $xml;
        $member = new Member($xml, '');
		$members[] = $member;
    }
}

$members = [];
if (($csvFile = fopen('../members/individual/members.csv', 'r')) !== FALSE) {
    // Read the header row
    $header = fgetcsv($csvFile);
    // Read each row of data
    while (($row = fgetcsv($csvFile)) !== FALSE) {
        // Output HTML for each person
        if (!empty($row)) {
            $member = new Member($row);
            $members[] = $member;
        }
    }
    fclose($csvFile);
}

?>
<!doctype html>
<html>
<head>
    <?php renderHead("Members") ?>
</head>
<body>
    <?php renderLogoAndNav() ?>
    <?php include "members-sidebar.inc" ?>
    <div id="page-content-members-list" class="page-content">
        <div class="page-content-wrapper">
            <?php
            $semesterPrinting = NULL;

            function renderString($label, $value) {
                if ($value) {
                    ?><li><strong><?= $label ?>:</strong> <?= $value ?></li><?php
                }
            }

            function renderMemberQuote($label, $member) {
                if ($member->quote) {
                    ?><li><strong>Personal quote:</strong> <?= $member->quote ? "<q>$member->quote</q>" : $member->quote ?><?= $member->cited ? " ~ <cite>$member->cited</cite>" : "" ?></li><?php
                }
            }

            foreach ($members as $member) {

                if ($member->semesterJoined != $semesterPrinting) {
                    $semesterPrinting = $member->semesterJoined;
                    ?></ol><?php?><h3>Joined <?= $semesterPrinting ?></h3><ol class="members-list"><?php
                }

                ?><li class="member">
                    <img class="member-photo" src="/members/individual/<?= $member->normalPhoto ?>" alt="<?= $member->name ?>">
                    <div class="member-info">
                        <div class="member-name"><strong><?= $member->name ?></strong><span class="member-number">#<?= $member->number ?></span></div>
                        <ul>
                            <?php renderString("Year", $member->year) ?>
                            <?php renderString("Major", $member->major) ?>
                            <?php renderString("Semesters in GamesCrafters", $member->gcSemesters) ?>
                            <?php renderString("Projects", $member->projects) ?>
                            <?php renderString("Biography", $member->biography) ?>
                            <?php renderMemberQuote("Quote", $member) ?>
                            <?php renderString("Favorite GamesCrafters-type game", $member->favoriteGame) ?>
                            <?php renderString("Favorite Ice Cream", $member->favoriteIceCream) ?>
                        </ul>
                    </div>
                    <img class="member-photo" src="/members/individual/<?= $member->crazyPhoto ?>" alt="<?= $member->name ?>">
                </li><?php
            } ?>
            </ol>
        </div>
    </div>
    <?php renderFooter() ?>
</body>
</html>