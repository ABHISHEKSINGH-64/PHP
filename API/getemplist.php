<?php
$host = "localhost";
$port = "5432";
$dbname = "postgres";
$user = "postgres";
$password = "Abhishek@123";

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT * FROM emp";
    $stmt = $pdo->query($sql);

    // Fetch all data
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Set header for JSON
    header('Content-Type: application/json');

    // Output JSON
    echo json_encode($employees, JSON_PRETTY_PRINT);

} catch (PDOException $e) {
    echo json_encode([
        "error" => $e->getMessage()
    ]);
}
?>