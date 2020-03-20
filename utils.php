<?php

defined("ABSPATH") || define("ABSPATH", __DIR__ . "/");
defined("CSS") || define("CSS", __DIR__ . "/css/style.css");
defined("IMAGESIZES") || define("IMAGESIZES", __DIR__ . "/scale/imageSizes.json");
defined("TILINGJS") || define("TILINGJS", __DIR__ . "/js/tiling.js");
defined("TILINGPHP") || define("TILINGPHP", __DIR__ . "/tiling.php");
defined("CREATERGBARRAY") || define("CREATERGBARRAY", __DIR__ . "/createRGBArray.php");

if (!function_exists("openCSS")) {
  function openCSS() {
    $toOpen = fopen(CSS, "r");
    $toReturn = fread($toOpen, filesize(CSS));
    fclose($toOpen);
    return $toReturn;
  }
}

if (!function_exists("openJS")) {
  function openJS() {
    $toOpen = fopen(TILINGJS, "r");
    $toReturn = fread($toOpen, filesize(TILINGJS));
    fclose($toOpen);
    return $toReturn;
  }
}

if (!function_exists("openIMAGESIZES")) {
  function openIMAGESIZES() {
    $toOpen = fopen(IMAGESIZES, "r");
    $toReturn = fread($toOpen, filesize(IMAGESIZES));
    fclose($toOpen);
    return $toReturn;
  }
}


?>
