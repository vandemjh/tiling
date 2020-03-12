<?php
include("createRGBArray.php");
$css = fread(fopen("css/style.css", "r"), filesize("css/style.css"));

echo "<!DOCTYPE html>";
echo "<html>";
echo "<style>" . $css . "</style>";
// echo "<input type=\"range\" min=\"2\" max=\"50\" value=\"20\" class=\"slider\" id=\"size\">";
echo "<canvas>";
echo "<script>";
if (count($_GET) == 0) {
    echo "\n</script>\n</canvas><form class = \"form\" \"form\" action=\"tiling.php\" method=\"get\">
    Link to image: <input type=\"url\" name=\"url\"><br>
    <input type=\"submit\" value=\"Submit\"></form>\n</canvas>\n</html>";
    die();
}
$url = $_GET["url"];

echo createRGBArray($url);
($pokemon = fopen("pokemon.data", "r")) or die("Unable to open file!");
($emoji = fopen("unicode/emoji.data", "r")) or die("Unable to open file!");
echo fread($pokemon, filesize("pokemon.data"));
echo fread($emoji, filesize("unicode/emoji.data"));

($script = fopen("tiling.js", "r")) or die("Unable to open file!");

echo fread($script, filesize("tiling.js"));

fclose($script);

echo "</script>";
echo "</canvas>";
echo "</html>";

?>
