<?php
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Database Details
    $host = "localhost";
    $port = "5432";
    $dbname = "Leapstart";
    $username = "postgres";
    $dbpassword = "Abhishek@123";

    // Get POST Values
    $idno = isset($_POST["idno"]) ? trim($_POST["idno"]) : "";
    $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";

    // Check Empty
    if ($idno == "" || $password == "") {
        echo json_encode([
            "status" => "error",
            "message" => "Please enter ID Number and Password"
        ], JSON_PRETTY_PRINT);
        exit();
    }

    try {

        // Connect PostgreSQL
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        $pdo = new PDO($dsn, $username, $dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL Query
        $stmt = $pdo->prepare('
            SELECT idno, name, mobile, email, dob, "password", isactive
            FROM candidates
            WHERE idno = :idno
        ');

        // Execute
        $stmt->execute([
            ':idno' => $idno
        ]);

        $candidate = $stmt->fetch(PDO::FETCH_ASSOC);

        // User Not Found
        if (!$candidate) {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid ID Number or Password"
            ], JSON_PRETTY_PRINT);
            exit();
        }

        $storedPassword = $candidate["password"];

        // Password Check
        $passwordMatched = false;

        if ($password === $storedPassword) {
            $passwordMatched = true;
        } elseif (password_verify($password, $storedPassword)) {
            $passwordMatched = true;
        }

        if (!$passwordMatched) {
            echo json_encode([
                "status" => "error",
                "message" => "Invalid ID Number or Password"
            ], JSON_PRETTY_PRINT);
            exit();
        }

        // Check Active Status
        if (!$candidate["isactive"]) {
            echo json_encode([
                "status" => "error",
                "message" => "Account is inactive"
            ], JSON_PRETTY_PRINT);
            exit();
        }

        // Remove Password from Output
        unset($candidate["password"]);

        // Success
        echo json_encode([
            "status" => "success",
            "message" => "Login Success",
            "data" => $candidate
        ], JSON_PRETTY_PRINT);

    } catch (PDOException $e) {

        echo json_encode([
            "status" => "error",
            "message" => "Database Error: " . $e->getMessage()
        ], JSON_PRETTY_PRINT);
    }

} else {

    echo json_encode([
        "status" => "error",
        "message" => "Use POST Method"
    ], JSON_PRETTY_PRINT);
}
?>