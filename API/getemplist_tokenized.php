<?php
header('Content-Type: application/json');


$data = json_decode(file_get_contents("php://input"), true);

$idno = $data['idno'] ?? $_POST['idno'] ?? null;
$password = $data['password'] ?? $_POST['password'] ?? null;

if (!$idno || !$password) {
    echo json_encode([
        "status" => "error",
        "message" => "idno and password required"
    ]);
    exit;
}


$host = 'localhost';
$port = '5432';
$dbname = 'Leapstart';  
$username = 'postgres';
$password_db = 'Abhishek@123';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $cn = new PDO($dsn, $username, $password_db);
    $cn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   
    $qry = "SELECT * FROM candidates WHERE idno = :idno AND Isactive = TRUE";
    $stmt = $cn->prepare($qry);
    $stmt->execute(['idno' => $idno]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode([
            "status" => "error",
            "message" => "User not found or inactive"
        ]);
        exit;
    }

  
    if (!password_verify($password, $user['password'])) {
        echo json_encode([
            "status" => "error",
            "message" => "Invalid password"
        ]);
        exit;
    }

    $token = bin2hex(random_bytes(25));

    // INSERT TOKEN
    $insert = "INSERT INTO usertokens (idno, token) VALUES (:idno, :token)";
    $stmt = $cn->prepare($insert);
    $stmt->execute([
        'idno' => $idno,
        'token' => $token
    ]);

    
    echo json_encode([
        "status" => "success",
        "message" => "Login successful",
        "token" => $token
    ]);

} catch (PDOException $e) {
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>