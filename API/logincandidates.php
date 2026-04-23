<?php
include("functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST")
    {

    $host = 'localhost';
    $port = '5432';
    $dbname = 'Leapstart';
    $username = 'postgres';
    $password = 'Abhishek@123';

    $idno=$_POST["idno"];
    $user_password=$_POST["password"];
     
    try {
        $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt ="SELECT * FROM candidates WHERE idno = '$idno' AND password = '$user_password'";
        $result = $pdo->query($stmt);
        $user = $result->fetch(PDO::FETCH_ASSOC);
        
        if($user){
            if($user["isactive"] == 'true'){
                $token = getAccessToken(50);
                $stmt2 = "DELETE FROM usertokens where idno='$idno'";
                $result2 = $pdo->query($stmt2);
                $stmt3 = "INSERT INTO usertokens(idno,token) VALUES('$idno','$token')";
                $result3 = $pdo->query($stmt3);

                echo json_encode([
                    "status" => "success",
                    "message" => "Login Successful",
                    "data" =>[
                        "idno" => $user["idno"],
                        "name" => $user["name"],
                        "email" => $user["email"],
                        "token" => $token
                    ]
                ]);
            }else{
                echo json_encode([
                    "status" => "success",
                    "message" => "Account Is InActive"
                ]);
            }

        }else{
           echo json_encode([
                    "status" => "success",
                    "message" => "Invalide ID or Password"
                ]);
        }


    } catch (PDOException $e) {
       echo "Error: " . $e->getMessage();
    }
}else{
    echo "Use Post Method";
}
?>