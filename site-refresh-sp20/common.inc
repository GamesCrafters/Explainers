<?php

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

function renderHead($title) {
    $pageTitle = renderPageTitle($title);
    include "head.inc";
}

function renderLogoAndNav() {
    include "logo-nav.inc";
}

function renderFooter() {
    include "footer.inc";
}

function renderPageTitle($title) {
    return "GamesCrafters :: $title";
}
