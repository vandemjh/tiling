<?php
$image = imagecreatefromjpeg("Profile Picture.jpg");
$width = imagesx($image);// / $skipLength; //imagesx($image)
$height = imagesy($image);// / $skipLength;
$skipLength = 15;//($width >= $height ? $height : $height) / 50;
$newWidth = $width / $skipLength;//imagesx($image);// / $skipLength; //imagesx($image)
$newHeight = $height / $skipLength;//imagesy($image);// / $skipLength;
$rgbArray = "const rgbArray = [";
for ($x = 0; $x < $width; $x+=$skipLength) {
  $rgbArray = $rgbArray."[";
  for ($y = 0; $y < $height; $y+=$skipLength) {
  $rgb = imagecolorat($image, $x, $y);
  $r = ($rgb >> 16) & 0xFF;
  $g = ($rgb >> 8) & 0xFF;
  $b = $rgb & 0xFF;
  $rgbArray = $rgbArray."[".$r.",".$g.",". $b. "]" . ($y + $skipLength <= $height ? "," : "");
  //echo($r + $g + $b);
}
$rgbArray = $rgbArray."]".($x + $skipLength <= $width ? "," : "");
}
$rgbArray = $rgbArray."];";
echo($rgbArray);
//var_dump($colors);
//$image = imagecreatefrompng("Profile Picture.png")
 ?>
