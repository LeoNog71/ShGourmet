<?php

    $conn = new PDO("mysql:dbname=shgourmet;host=127.0.0.1", "shgourmet", "");
    $consulta = 1;
    $stmt = $conn->prepare("CALL selectID_pizza($consulta)");
    $stmt->execute();    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $a = (array) $result;
    print_r($a);
    echo json_encode($result);
?>

