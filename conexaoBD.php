<?php
/*conexaoBD.php*/

try {
    require("env.php");
    $pdo = new PDO($db, $user, $passwd, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    $output = 'Impossível conectar BD : ' . $e . '<br>';
    echo $output;
}
?>