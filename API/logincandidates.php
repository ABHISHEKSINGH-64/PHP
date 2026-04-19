<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Database Connection
    $host = "localhost";
    $port = "5432";
    $dbname = "Leapstart";
    $username = "postgres";
    $password = "Abhishek@123";

    // Get Form Data Safely
    $idno = $_POST["idno"] ?? "";
    $user_password = $_POST["user_password"] ?? "";

    // Check Empty Fields
    if (empty($idno) || empty($user_password)) {
        exit("Please enter ID Number and Password");
    }

    try {
        // Connect to PostgreSQL
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        $pdo = new PDO($dsn, $username, $password);

        // Error Mode
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Query
        $stmt = $pdo->prepare('
            SELECT COUNT(*) AS count 
            FROM candidates 
            WHERE idno = :idno 
            AND "password" = :user_password
        ');

        // Execute Query
        $stmt->execute([
            ':idno' => $idno,
            ':user_password' => $user_password
        ]);

        // Fetch Result
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // Login Check
        if ($result["count"] > 0) {
            echo "Login Success";
        } else {
            echo "Invalid ID Number or Password";
        }

    } catch (PDOException $e) {
        echo "Database Error: " . $e->getMessage();
    }

} else {
    echo "Use POST Method";
}
?>