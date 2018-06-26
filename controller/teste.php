<?php

    @include_once '..\model\vo\pedidos.php';
    @include_once '..\model\dao\PedidosDAO.php';
    
    
    $f = new PedidosDAO(NULL);
    
    echo json_encode($f->selectAll());
?>

