<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
   
$cno = $_POST["cno"];
$cname = $_POST["cname"];
$pread = $_POST["pread"];
$cread = $_POST["cread"];

$units = $cread - $pread;

if ($units <= 200) {
    $amount = $units * 1;
}
elseif ($units <= 300) {
    $amount = (200 * 1) + (($units - 200) * 1.25);
}
elseif ($units <= 400) {
    $amount = (200 * 1) + (100 * 1.25) + (($units - 300) * 1.5);
}
elseif ($units <= 500) {
    $amount = (200 * 1) + (100 * 1.25) + (100 * 1.5) + (($units - 400) * 1.75);
}
else {
    $amount = (200 * 1) + (100 * 1.25) + (100 * 1.5) + (100 * 1.75) + (($units - 500) * 2);
}

$tax = $amount * 0.1;
$total_amount = $amount + $tax;

echo("CNo: ".$cno);
echo("<br>CName: ".$cname);
echo("<br>pread: ".$pread);
echo("<br>cread: ".$cread);
echo("<br>charged units: ".$units);
echo("<br>charged amount: Rs.".$amount);
echo("<br>service tax: Rs.".$tax);
echo("<br>total amount: Rs.".$total_amount);
}else{
      echo(" please use the post method to call this api");
}
      
?>