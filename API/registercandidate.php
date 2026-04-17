<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
    {

    $host = 'localhost';
    $port = '5432';
    $dbname = 'Leapstart';
    $username = 'postgres';
    $password = 'Abhishek@123';

    $idno=$_POST["idno"];
    $name=$_POST["name"];
    $mobile=$_POST["mobile"];
    $email=$_POST["email"];
    $dob=$_POST["dob"];
    $user_password=$_POST["user_password"];
     
    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT COUNT(*) as count FROM candidates WHERE idno = :idno");
        $stmt->execute(['idno' => $idno]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

      


        if($result[0]['count'] == 0){
            $qry = "insert into candidates(idno,name,mobile,email,dob,user_password) values('$idno','$name','$mobile','$email','$dob','$user_password')";
            $pdo->query($qry);

            echo "Record Inserted Successfully";

        }else{
           echo "Id Number Already Exist";
        }
        

    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode([
            'status'  => 'error',
            'message' => $e->getMessage()
        ], JSON_PRETTY_PRINT);
    }
}else{
    echo "Use Post Method";
}
?>