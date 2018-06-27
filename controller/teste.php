<?php

    @include_once '..\model\vo\pedidos.php';
    @include_once '..\model\dao\PedidosDAO.php';
    
    
    $conn = new PDO("mysql:dbname=shgourmet;host=127.0.0.1", "shgourmet", "");
    $stmt = $conn->prepare("CALL select_usuario('LEONARDO','0808')");
    $stmt->execute();  
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $F = false;
    echo ($F);
    echo json_encode($result);
?>

