<?php
$sno = $_REQUEST["sno"];
$sname = $_REQUEST["sname"];
$m1 = $_REQUEST["m1"];
$m2 = $_REQUEST["m2"]; 
$m3 = $_REQUEST["m3"];
$m4 = $_REQUEST["m4"];

$total = $m1 + $m2 + $m3 + $m4;
$avg = $total / 4;

if ($m1>=40 && $m2>=40 && $m3>=40 && $m4>=40) {
    $result = "PASS";
} else {
    $result = "FAIL";
}

if ($total >= 350) {
    $grade = "FIRST CLASS";
} elseif ($total >= 275) {
    $grade = "SECOND CLASS";
} elseif ($total >= 200) {
    $grade = "C";
} else {
    $grade = "D";
}

echo "S.No: " . $sno;
echo "<br>Student Name: " . $sname;
echo "<br>M1: " . $m1;
echo "<br>M2: " . $m2;
echo "<br>M3: " . $m3;
echo "<br>M4: " . $m4;
echo "<br>Total Marks: " . $total;
echo "<br>Average: " . $avg;
echo "<br>Result: " . $result;
echo "<br>Grade: " . $grade;
?>