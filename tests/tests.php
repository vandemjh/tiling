<?php
include("../utils.php");
include(CREATERGBARRAY);
set_time_limit(0);

// Exec the python script
// $command = escapeshellcmd("python3 ./generateImages.py");
$output = exec("python3 ./generateImages.py 2>&1"); // Redirect stderr to stdout

if (strcmp($output, "success") != 0) {
  echo "Python3 script failed, exiting...</br>";
  echo $output;
  die();
}

$calls = 0;

/** --- Timing --- **/
function rutime($ru, $rus, $index) {
    return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
     -  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
}

/** --- Printing --- **/
function printResults($pixels, $skipSize) {
  $rustart = getrusage();
  // global $calls;
  echo "<th>" . $pixels . "</th>";
  echo "<th>" . $pixels * $pixels . "</th>"; //$calls ++ . ": " .
  createRGBArray(ABSPATH . "/tests/images/" . $pixels . ".png", $skipSize);
  $ru = getrusage();
  echo "<th>" . $computations = rutime($ru, $rustart, "utime") . "</th>";//This process used . ms for its computations.
  echo "<th>" . $calls = rutime($ru, $rustart, "stime") . "</th>"; //"It spent . ms in system calls";
  echo "<th>" . ((int)$computations + (int)$calls) . "</th>"; // Total time
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

echo "<table><style>table, td, th {border:1px solid black;text-align:center;border-collapse:collapse;}</style>";
echo "<tr><td colspan=5>--- System Timing Tests ---</th></tr>";

echo "<tr><th>Height / Width</th><th>Total Pixels</th>
      <th>Time spent on computations</th>
      <th>Time spent in system calls</th>
      <th>Total Time</th></tr>";

$ruInitial = getrusage();

for ($skipSize = 25; $skipSize >= 1; $skipSize = $skipSize - 1) {
  echo "<tr><td colspan=5><strong>SkipSize = " . $skipSize . "</strong></th></tr>";
  for ($i = 250; $i <= 5250; $i = $i + 250) {
    echo "<tr>";
    printResults($i, $skipSize);
    echo "</tr>";
  }
}

echo "<th></table>";
echo "</br>--- Total test usage ---";
$ru = getrusage();
echo "</br>All tests used " . rutime($ru, $ruInitial, "utime") .
    " ms for its computations.";
echo "They spent " . rutime($ru, $ruInitial, "stime") .
    " ms in system calls";

/** --- End timing --- **/
?>
