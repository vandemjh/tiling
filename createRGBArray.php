<?php
/**
 * Creates the array of rgb values based on the given url in JavaScript form.
 **/
function createRGBArray($url, $skipSize)
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
            break;
    }
    if ($image == null) {
        echo "\nalert(\"file type not supported at this time!\");</script>";
        die();
    }
    $width = imagesx($image);
    $height = imagesy($image);

    // $skipSize = 2; //TODO : A function to automate this number to be as low as possible.

    //($width >= $height ? $height : $height) / 50;
    $newWidth = $width / $skipSize; //imagesx($image);// / $skipSize; //imagesx($image)
    $newHeight = $height / $skipSize; //imagesy($image);// / $skipSize;
    $rgbArray = "const rgbArray = [";
    for ($x = 0; $x < $width; $x += $skipSize) {
        //for loop runs through each column and...
        $rgbArray = $rgbArray . "[";
        for ($y = 0; $y < $height; $y += $skipSize) {
            // each row to add rgb values.
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
                ($y + $skipSize < $height ? "," : "");
        }
        $rgbArray = $rgbArray . "]" . ($x + $skipSize < $width ? "," : "");
    }
    $rgbArray = $rgbArray . "];";
    imagedestroy($image);
    return $rgbArray;
}
?>
