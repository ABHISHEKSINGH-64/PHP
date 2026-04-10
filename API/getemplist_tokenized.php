<?php
header('Content-Type: application/json');

if (isset($_GET["token"])) {

    $token = $_GET["token"];

    $host = 'localhost';
    $port = '5432';
    $dbname = 'BANKING';
    $username = 'postgres';
    $password = 'Abhishek@123';

    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        $cn = new PDO($dsn, $username, $password);
        $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // check token (use lowercase table name)
        $qry = "SELECT * FROM Tokens WHERE token = :token";
        $stmt = $cn->prepare($qry);
        $stmt->execute(['token' => $token]);
        $x = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($x) === 0) {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid token"
            ], JSON_PRETTY_PRINT);
            exit;
        }

        // fetch employee data
        $query = "SELECT * FROM emp";
        $stmt = $cn->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

} else {
    echo json_encode([
        "status" => "error",
        "message" => "Token is missing"
    ], JSON_PRETTY_PRINT);
    exit;
}
?>