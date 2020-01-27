<?php
function file_get_contents_curl($url) {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_URL, $url);

    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}
$url = file_get_contents_curl('http://w3stu.cs.jmu.edu/vandemjh/jack.png');
$file = file_put_contents('picture.png', $data);
$image = imagecreatefrompng($file); //imagecreatefromjpeg
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
