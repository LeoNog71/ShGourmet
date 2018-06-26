<?php

    $conn = new PDO("mysql:dbname=shgourmet;host=127.0.0.1", "shgourmet", "");
    $consulta = 1;
    $stmt = $conn->prepare("CALL selectID_pizza($consulta)");
    $stmt->execute();    
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    #$a = (array) $result;
    $pedidos = array(1,2,3,4,);
    array_push($result,$pedidos);
    print_r($result);
    //echo json_encode($a);
?>

