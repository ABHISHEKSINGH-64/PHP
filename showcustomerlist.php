<?php
$host = 'localhost';
$port = '5432';
$dbname = 'BANKING';
$username = 'postgres';
$password = 'Abhishek@123';

try {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM customer ORDER BY cid");

    echo "<h3>Customers Records:</h3>";
    echo "<table border='1' cellpadding='10'>";
    echo "<tr>";

    $columns = [];
    for ($i = 0; $i < $stmt->columnCount(); $i++) {
        $col = $stmt->getColumnMeta($i);
        $columns[] = $col['name'];
        echo "<th>{$col['name']}</th>";
    }
    echo "</tr>";

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