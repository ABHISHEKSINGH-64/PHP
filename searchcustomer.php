<?php
$host = 'localhost';
$port = '5432';
$dbname = 'BANKING';
$username = 'postgres';
$password = 'Abhishek@123';
?>

<!DOCTYPE html>
<html>
<head>
<style>
body{
    height:100vh;
    margin:0;
    display:flex;
    justify-content:center;
    align-items:center;
    font-family:Arial;
}

.box{
    border:1px solid #ccc;
    padding:30px;
    border-radius:8px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
    text-align:center;
}
</style>
</head>

<body>

<div class="box">

<?php
try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $cn = new PDO($dsn, $username, $password);
    $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $cid = $_GET["cid"] ?? '';

        if ($cid) {

            $sql = "SELECT * FROM customer WHERE cid = :cid";
            $stmt = $cn->prepare($sql);
            $stmt->execute([':cid' => $cid]);

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row) {
                echo "<h2>Customer Details</h2>";
                echo "CID: " . $row['cid'] . "<br>";
                echo "Name: " . $row['cname'] . "<br>";
                echo "Email: " . $row['email'] . "<br>";
                echo "Age: " . $row['age'] . "<br>";
                echo "City: " . $row['city'] . "<br>";
                echo "State: " . $row['state'] . "<br>";
            } else {
                echo "<h3>Record not found</h3>";
            }

        } else {
            echo "Enter CID";
        }
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
echo "<hr>";include("searchcustomer.html")
?>

</div>

</body>
</html>