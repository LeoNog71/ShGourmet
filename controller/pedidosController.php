<?php

 
    @include_once '..\model\vo\pedidos.php';
    @include_once '..\model\dao\PedidosDAO.php';
  
    $json = file_get_contents('php://input');
    $array = json_decode($json);
    if($array->operacao == '1'){
        cadastrar($array);
    }
    if($array->operacao == '2'){
        atualizar($array);
    }
    if($array->operacao =='4'){
        pesquisa($array);
    }
    if($array->operacao =='5'){
        pesquisaId($array);
    }
 
    function recebeJson($array){
            
       $classe = new Pedidos();
       
       $classe->setId($array->id);
       $classe->setIdCliente($array->id_cliente);
       $classe->setIdFuncionario($array->id_funcionario);
       $classe->setData($array->data_pedido);
       $classe->setValor_total($array->valor_total);
       foreach ($array->pedido_produto as $value) {
           $classe->setProdutos($value->id);
       }

        return $classe;
    }
    
     function enviaJson($array){
            
        echo json_encode($array);
    }

    function atualizar($array) {
        $f  = new LacheDAO(recebeJson($array));
        $f->update();
    }

    function cadastrar($array) {
       $f  = new LancheDAO(recebeJson($array));
       $f->insert();
    }

    function excluir($array) {
       $f  = new LancheDAO(recebeJson($array));
       $f->delete();
    }

    function pesquisa($array) {
        $consulta = recebeJson($array);
        $f = new LancheDAO(NULL);
        enviaJson($f->select(strtoupper($consulta->getNome())));
    }
    function pesquisaId($array) {
        $consulta = recebeJson($array);
        $f = new LancheDAO(NULL);
        enviaJson($f->selectID($consulta->getNome()));
    }


?>

