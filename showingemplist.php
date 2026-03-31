<?php
$host = 'localhost';
$port = '5432';
$dbname = 'postgres';
$username = 'postgres';
$password = 'Abhishek@123';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    echo "Connected to PostgreSQL successfully!<br>";
    
    // SELECT * FROM emp
    $stmt = $pdo->query("SELECT * FROM emp");
    
    echo "<h3>Employee Records:</h3>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>";
    
    // Get column names for header
    $columns = [];
    for ($i = 0; $i < $stmt->columnCount(); $i++) {
        $col = $stmt->getColumnMeta($i);
        $columns[] = $col['name'];
        echo "<th>" . $col['name'] . "</th>";
    }
    echo "</tr>";
    
    // Fetch and display rows
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        foreach ($columns as $col) {
            echo "<td>" . htmlspecialchars($row[$col]) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>