<?php
$host = 'localhost';
$port = '5432';
$dbname = 'BANKING';
$username = 'postgres';
$password = 'Abhishek@123';

$msg = "";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $cn = new PDO($dsn, $username, $password);
    $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "GET") {

        $cid   = $_GET["cid"] ?? '';
        $cname = $_GET["cname"] ?? '';
        $email = $_GET["email"] ?? '';
        $age   = $_GET["age"] ?? '';
        $city  = $_GET["city"] ?? '';
        $state = $_GET["state"] ?? '';

        if ($cid && $cname && $email && $age && $city && $state) {

            $sql = "INSERT INTO customer (cid, cname, email, age, city, state)
                    VALUES (:cid, :cname, :email, :age, :city, :state)";

            $stmt = $cn->prepare($sql);
            $stmt->execute([
                ':cid' => $cid,
                ':cname' => $cname,
                ':email' => $email,
                ':age' => $age,
                ':city' => $city,
                ':state' => $state
            ]);

            $msg = "Customer inserted successfully";
        } else {
            $msg = "Please fill all fields";
        }
    }

    echo $msg;

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

