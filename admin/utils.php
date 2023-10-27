<?php

require_once __DIR__ . '/../site-legacy-archive-sp20/common.php';
require_once __DIR__ . '/../members/member.class.php';

/**
 * Removes gaps and overlapping member ids
 *
 * Usage (run from terminal):
 * $ php -a
 * > require("utils.php");
 * > renumberMembers();
 */
function renumberMembers()
{
    $rootDir = __DIR__ . '/../members/xml';
    $members = [];
    foreach (GetFiles($rootDir) as $subdir) {
        $subdir = $rootDir . '/' . $subdir;
        foreach (GetFiles($subdir) as $xml) {
            $xml = $subdir . '/' . $xml;
            $members[] = [
                $xml,
                new Member($xml, '/members/')
            ];
        }
    }

    function compareMembers($a, $b)
    {
        return Member::compare($a[1], $b[1]);
    }

    usort($members, 'compareMembers');

    $number = 0;
    foreach ($members as [$xml, $member])
    {
        $doc = new DOMDocument;
        $doc->load($xml);
        $doc->firstChild->attributes->getNamedItem("number")->nodeValue = ++$number;
        $doc->save($xml);
    }
}
