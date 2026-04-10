<?php
$host = 'localhost';
$port = '5432';
$dbname = 'BANKING';
$username = 'postgres';
$password = 'Abhishek@123';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password);

    // Get form data
    $cid = $_POST['cid'];
    $cname = $_POST['cname'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $state = $_POST['state'];
    $city = $_POST['city'];

    // Insert query
    $sql = "INSERT INTO customer (cid, cname, email, age, state, city)
            VALUES (:cid, :cname, :email, :age, :state, :city)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        ':cid' => $cid,
        ':cname' => $cname,
        ':email' => $email,
        ':age' => $age,
        ':state' => $state,
        ':city' => $city
    ]);

    echo "Customer added successfully!";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>