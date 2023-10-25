<?php
ini_set('display_errors',1); 
 error_reporting(E_ALL);
function endsWith( $str, $sub ) {
     return ( substr( $str, strlen( $str ) - strlen( $sub ) ) === $sub );
}
  $dir = opendir('.');
  while($entry = readdir($dir)){
    if($entry[0] != '.' && endsWith($entry, '.xml')){
      $doc = new DOMDocument();
      $doc->load($entry);

      // $game = $doc->getElementsByTagName("game")->item(0);

      // $title = $game->getElementsByTagName("name")->item(0);
      //print $title;
    }
?>
