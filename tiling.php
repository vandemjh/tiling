<?php
function createRGBArray($url)
{
    if (strlen($url) == 0) {
        return;
    }
    $urlArray = explode(".", $url);
    $image = null;
    switch ($urlArray[count($urlArray) - 1]) {
        case 'png':
            $image = imagecreatefrompng($url);
            break;
        case 'jpeg':
            $image = imagecreatefromjpeg($url);
            break;
        case 'png':
            $image = imagecreatefrompng($url);
            break;
        case 'gif':
            $image = imagecreatefromgif($url);
            break;
        case 'bmp':
            $image = imagecreatefrombmp($url);
            break;
        case 'xbm':
            $image = imagecreatefromxbm($url);
            break;
        default:
            $imageTry = imagepng(
                imagecreatefromstring(file_get_contents($url)),
                "temp"
            );
            if ($imageTry != null && $imageTry != false) {
                $image = imagecreatefrompng("temp");
            }
            break; //not supported
        //default: break;
    }
    if ($image == null) {
        echo "\nalert(\"file type not supported at this time!\");</script>";
        die();
    }
    $width = imagesx($image); // / $skipLength; //imagesx($image)
    $height = imagesy($image); // / $skipLength;
    $skipLength = 15; //($width >= $height ? $height : $height) / 50;
    $newWidth = $width / $skipLength; //imagesx($image);// / $skipLength; //imagesx($image)
    $newHeight = $height / $skipLength; //imagesy($image);// / $skipLength;
    $rgbArray = "const rgbArray = [";
    for ($x = 0; $x < $width; $x += $skipLength) {
        $rgbArray = $rgbArray . "[";
        for ($y = 0; $y < $height; $y += $skipLength) {
            $rgb = imagecolorat($image, $x, $y);
            $r = ($rgb >> 16) & 0xff;
            $g = ($rgb >> 8) & 0xff;
            $b = $rgb & 0xff;
            $rgbArray =
                $rgbArray .
                "[" .
                $r .
                "," .
                $g .
                "," .
                $b .
                "]" .
                ($y + $skipLength < $height ? "," : "");
            //echo($r + $g + $b);
        }
        $rgbArray = $rgbArray . "]" . ($x + $skipLength < $width ? "," : "");
    }
    $rgbArray = $rgbArray . "];";
    imagedestroy($image);
    return $rgbArray;
}
//$url = file_get_contents_curl('http://w3stu.cs.jmu.edu/vandemjh/jack.png');
//$file = file_put_contents('picture.png', $url);
echo "<!DOCTYPE html>";
echo "<html>";
echo "<style> html, body {
    width: 100%;
    height: 100%;
    margin: 0;
  }
  .form, body > form {
    margin: 0 auto;
width: 50%;
  }
  #size {
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
 </style>";
echo "<input type=\"range\" min=\"2\" max=\"50\" value=\"20\" class=\"slider\" id=\"size\">";
echo "<canvas>";
echo "<script>";
if (count($_GET) == 0) {
    echo "\n</script>\n</canvas><form class = \"form\" \"form\" action=\"tiling.php\" method=\"get\">
    Link to image: <input type=\"url\" name=\"url\"><br>
    <input type=\"submit\" value=\"Submit\">
  </form>\n</canvas>\n</html>";
    die();
}
$url = $_GET["url"];

echo createRGBArray($url);
($script = fopen("tiling.js", "r")) or die("Unable to open file!");
echo fread($script, filesize("tiling.js"));
fclose($script);
echo "</script>";
echo "</canvas>";
echo "</html>";

?>
