<?php

    $conn = new PDO("mysql:dbname=shgourmet;host=127.0.0.1", "shgourmet", "");
    $stmt = $conn->prepare("CALL select_funcionario('VIVIANE')");
    $stmt->execute();    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode($result);
?>

