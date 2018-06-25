<?php

    $conn = new PDO("mysql:dbname=shgourmet;host=127.0.0.1", "shgourmet", "");
    $stmt = $conn->prepare("CALL selectID_funcionario(1)");
    $stmt->execute();    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($result);
?>

