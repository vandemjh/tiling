<?php

defined("ABSPATH") || define("ABSPATH", __DIR__ . "/");
defined("CSS") || define("CSS", __DIR__ . "/css/style.css");
defined("TILINGJS") || define("TILINGJS", __DIR__ . "/js/tiling.js");
defined("CREATERGBARRAY") || define("CREATERGBARRAY", __DIR__ . "/createRGBArray.php");

function openCSS() {
  $toOpen = fopen(CSS, "r");
  $toReturn = fread($toOpen, filesize(CSS));
  fclose($toOpen);
  return $toReturn;
}

function openJS() {
  $toOpen = fopen(TILINGJS, "r");
  $toReturn = fread($toOpen, filesize(TILINGJS));
  fclose($toOpen);
  return $toReturn;
}

?>
