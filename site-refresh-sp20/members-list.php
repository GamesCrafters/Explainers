<?php

require "common.inc";

if (empty($_GET['mid'])) {
    $_GET['mid'] = 'all';
}

// Read all members

require_once '../members/member.class.php';

$xmlDir = '../members/xml';
$members = [];

foreach (GetFiles($xmlDir) as $subdir) {
    $subdir = $xmlDir . '/' . $subdir;
    foreach (GetFiles($subdir) as $xml) {
        $xml = $subdir . '/' . $xml;
        $member = new Member($xml, '/members/');
		if ($_GET['mid'] == 'all' ||
		        $member->number == $_GET['mid'] ||
			    $_GET['mid'] == strtolower(preg_replace('/\s+/', '', $member->semesterJoined))) {

		    $members[] = $member;
			// Finish if getting only a single member
			if ($member->number == $_GET['mid']) {
			    break;
			}
		}
    }
}

// Reverse sort the members

function reverseCompareMembers(Member $a, Member $b) {
    return Member::compare($b, $a);
}

usort($members, 'reverseCompareMembers');

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
                if ($value != 'N/A') {
                    ?><li><strong><?= $label ?>:</strong> <?= $value ?></li><?php
                }
            }

            function renderArray($label, $array, $empty='N/A') {
                $value = implode(', ', $array);
                if (empty($value)) $value = $empty;
                renderString($label, $value);
            }

            function renderMemberQuote($label, $member) {
                if ($member->quote != 'N/A') {
                    ?><li><strong>Personal quote:</strong> <?= $member->quote != 'N/A' ? "<q>$member->quote</q>" : $member->quote ?><?= $member->cited != 'N/A' ? " ~ <cite>$member->cited</cite>" : "" ?></li><?php
                }
            }

            foreach ($members as $member) {

                if ($member->semesterJoined != 'N/A' && $member->semesterJoined != $semesterPrinting) {
                    $semesterPrinting = $member->semesterJoined;
                    if ($semesterPrinting != NULL) {
                        ?></ol><?php
                    }
                    ?><h3>Class of <?= $semesterPrinting ?></h3><ol class="members-list"><?php
                }

                ?><li class="member">
                    <a class="member-photo" href="<?= $member->normalPhotoFullSize ?>">
                        <img src="<?= $member->normalPhoto ?>" alt="<?= $member->name ?>">
                    </a>
                    <div class="member-info">
                        <div class="member-name"><strong><?= $member->name ?></strong><span class="member-number">#<?= $member->number ?></span></div>
                        <ul>
                            <?php renderString("Year", $member->year) ?>
                            <?php renderString("Major", $member->major) ?>
                            <?php renderString("Semesters in <abbr>GC</abbr>", $member->gcSemesters) ?>
                            <?php renderArray("Projects", $member->projects) ?>
                            <?php renderString("Biography", $member->biography) ?>
                            <?php renderMemberQuote("Quote", $member) ?>
                            <?php renderString("Favorite GamesCraftersy game", $member->favoriteGame) ?>
                            <?php renderString("Favorite ice-cream", $member->favoriteIceCream) ?>
                            <?php renderString("After GamesCrafters", $member->after) ?>
                        </ul>
                    </div>
                    <a class="member-photo" href="<?= $member->crazyPhotoFullSize ?>">
                        <img src="<?= $member->crazyPhoto ?>" alt="<?= $member->name ?>">
                    </a>
                </li><?php
            } ?>
            </ol>
        </div>
    </div>
    <?php renderFooter() ?>
</body>
</html>