<?php
include_once("utils.php");
include_once(CREATERGBARRAY);

echo "<!DOCTYPE html><html><style>" . openCSS() . "</style>";
// echo "<input type=\"range\" min=\"2\" max=\"50\" value=\"20\" class=\"slider\" id=\"size\">";
echo "<canvas><script>";
if (count($_GET) == 0) {
    echo "\n</script>\n</canvas><form class = \"form\" \"form\" action=\"" . "tiling.php" . "\" method=\"get\">
    Link to image: <input type=\"url\" name=\"url\"><br>
    <input type=\"submit\" value=\"Submit\"></form>\n</canvas>\n</html>";
    die();
}

$url = $_GET["url"];
$imageSizes = openIMAGESIZES();
$sizesJson = json_decode($imageSizes, true); //Move this to createRGBArray in the future
$skipSize = getBestSkip(getTotalPixels(getImageFromURL($url)), $sizesJson);

echo createRGBArray(getImageFromURL($url), $skipSize);
($pokemon = fopen("pokemon.data", "r")) or die("Unable to open file!");
($emoji = fopen("unicode/emoji.data", "r")) or die("Unable to open file!");
echo fread($pokemon, filesize("pokemon.data"));
echo fread($emoji, filesize("unicode/emoji.data"));

echo openJS();

echo "</script></canvas></html>";

?>
