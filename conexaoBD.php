<?php
/*conexaoBD.php*/

try {
    require("env.php");
    $pdo = new PDO($db, $user, $passwd, array(
        PDO::MYSQL_ATTR_SSL_CA => 'cacert-2023-08-22.pem'
    ));
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    $output = 'Impossível conectar BD : ' . $e . '<br>';
    echo $output;
}
?>