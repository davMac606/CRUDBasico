<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Commandee</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@picocss/pico@1/css/pico.min.css">
</head>

<body>
    <hr>

    <h2>Consulta de pedidos e items</h2>

</body>

</html>

<?php
include("conexaoBD.php");
try {
    //buscando dados
    $stmt = $pdo->prepare("SELECT * FROM `order` ORDER BY quantity, priority, `status`");
    $stmt->execute();
    $fp = fopen('order_log.csv', 'w');

    $colTitles = array('quantity', 'priority', 'status');
    fputcsv($fp, $colTitles);
    echo "<table border='1px'>";
    echo "<tr><th>Quantity</th><th>Priority</th><th>Status</th></tr>";

    while ($row = $stmt->fetch()) {
        $quantity = $row['quantity'];
        $priority = $row['priority'];
        $status = $row['status'];

        $list = array(
            array($quantity, $priority, $status)
        );

        foreach ($list as $line) {
            fputcsv($fp, $line);

        }
        echo "<td>" . $quantity . "</td>";
        echo "<td>" . $priority . "</td>";
        echo "<td>" . $status . "</td>";
        echo "</tr>";
    }
    
    fclose($fp);
 
    echo "</table><br>";
    $stmt1 = $pdo->prepare("SELECT * FROM item ORDER BY `name`, price, available");
    $stmt1->execute();
    $fp1 = fopen('item_log.csv', 'w');
    $colTitles1 = array('name', 'price', 'available');
    fputcsv($fp1, $colTitles1);
    echo "<table border='1px'>";
    echo "<tr><th>Name</th><th>Price</th><th>Available</th></tr>";
    while ($row1 = $stmt1->fetch()) {
        $name = $row1['name'];
        $price = $row1['price'];
        $available = $row1['available'];

        $list1 = array(
            array($name, $price, $available)
        );
        foreach ($list1 as $line1) {
            fputcsv($fp1, $line1);
        }
        echo "<td>" . $name . "</td>";
        echo "<td>" . $price . "</td>";
        echo "<td>" . $available . "</td>";
        echo "</tr>";
    }
    fclose($fp1);

    echo "</table><br>";


} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>