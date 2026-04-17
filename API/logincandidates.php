<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{

    $host = 'localhost';
    $port = '5432';
    $dbname = 'Leapstart';
    $username = 'postgres';
    $password = 'Abhishek@123';

    $idno = $_POST["idno"];
    $user_password = $_POST["user_password"];

    try {

        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare ("SELECT COUNT(*) as count FROM candidates WHERE idno = :idno AND password = :user_password ");

        $stmt->execute([
            'idno' => $idno,
            'user_password' => $user_password
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result['count'] == 1){
            echo "Connected Successfully";
        } else {
            echo "Invalid ID Number or Password";
        }

    } catch (PDOException $e) {
        echo $e->getMessage();
    }

}
else
{
    echo "Use POST Method";
}
?>