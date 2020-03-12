<?php
include("../utils.php");
include(CREATERGBARRAY);
$rustart = getrusage();

// $command = escapeshellcmd('/generateImages.py');
// $output = shell_exec($command);
// echo $output;


/*
var t0 = performance.now();

doSomething();   // <---- The function you're measuring time for

var t1 = performance.now();
console.log("Call to doSomething took " + (t1 - t0) + " milliseconds.");
*/


/** --- Timing --- **/
function rutime($ru, $rus, $index) {
    return ($ru["ru_$index.tv_sec"]*1000 + intval($ru["ru_$index.tv_usec"]/1000))
     -  ($rus["ru_$index.tv_sec"]*1000 + intval($rus["ru_$index.tv_usec"]/1000));
}

$ru = getrusage();
echo "<p>This process used " . rutime($ru, $rustart, "utime") .
    " ms for its computations.\n";
echo "It spent " . rutime($ru, $rustart, "stime") .
    " ms in system calls </p>\n";

/** --- End timing --- **/
?>
