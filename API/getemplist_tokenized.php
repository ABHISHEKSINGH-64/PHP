<?php
header('Content-Type: application/json');

// Get token from URL (GET or POST)
$token = $_GET['token'] ?? $_POST['token'] ?? null;

if (!$token) {
    echo json_encode([
        "status" => "error",
        "message" => "Token is missing"
    ], JSON_PRETTY_PRINT);
    exit;
}

// DB connection details
$host = 'localhost';
$port = '5432';
$dbname = 'postgres';   // ✅ your database
$username = 'postgres';
$password = 'Abhishek@123';

try {
    // Connect to PostgreSQL
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $cn = new PDO($dsn, $username, $password);
    $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // ✅ Check token
    $qry = "SELECT * FROM tokens WHERE token = :token";
    $stmt = $cn->prepare($qry);
    $stmt->execute(['token' => $token]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) === 0) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid token"
        ], JSON_PRETTY_PRINT);
        exit;
    }

    // ✅ Fetch employee data
    $query = "SELECT * FROM emp";
    $stmt = $cn->prepare($query);
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // ✅ Success response
    echo json_encode([
        "status" => "success",
        "data" => $rows
    ], JSON_PRETTY_PRINT);

} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ], JSON_PRETTY_PRINT);
}
?>