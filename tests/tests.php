<?php
include("../utils.php");
include(CREATERGBARRAY);
$calls = 0;

/** --- Timing --- **/
function rutime($ru, $rus, $index) {
    return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
     -  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
}

/** --- Printing --- **/
function printResults($pixels) {
  $rustart = getrusage();
  global $calls;
  echo "</br>Test " . $calls ++ . ": " . $pixels;
  createRGBArray(ABSPATH . "/tests/images/" . $pixels . ".png");
  $ru = getrusage();
  echo "</br>This process used " . rutime($ru, $rustart, "utime") .
      " ms for its computations.";
  echo "It spent " . rutime($ru, $rustart, "stime") .
      " ms in system calls";
}



// $command = escapeshellcmd('/generateImages.py');
// $output = shell_exec($command);
// echo $output;

/*
var t0 = performance.now();

doSomething();   // <---- The function you're measuring time for

var t1 = performance.now();
console.log("Call to doSomething took " + (t1 - t0) + " milliseconds.");
*/

echo "--- System Timing Tests ---";
for ($i = 250; $i <= 5000; $i = $i + 250) {
  printResults($i);
}

echo "</br>--- Total test usage ---";
$ru = getrusage();
echo "</br>All tests used " . rutime($ru, $rustart, "utime") .
    " ms for its computations.";
echo "They spent " . rutime($ru, $rustart, "stime") .
    " ms in system calls";

/** --- End timing --- **/
?>
