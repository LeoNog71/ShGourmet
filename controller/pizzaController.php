<?php

 
    @include_once '..\model\vo\pizza.php';
    @include_once '..\model\dao\PizzaDAO.php';
   # include_once '..\Interfaces\IDAO.php';
   
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
    if($array->operacao =='6'){
        pesquisaAll($array);
    }
   
    function recebeJson($array){
  
       $classe = new Pizza();
       $classe->setId((int)$array->id);
       $classe->setNome(strtoupper($array->nome));
       $classe->setDescricao(strtoupper($array->descricao));
       $classe->setPreco_venda(floatval($array->preco_venda));
       $classe->setQuantidade((int)$array->quantidade);
       
       $classe->setPreco_compra((double)$array->preco_compra);
       $classe->setFornecedor(strtoupper($array->fornecedor));
       $classe->setTamanho(strtoupper($array->tamanho));
    
        return $classe;
    }
    
     function enviaJson($array){
            
        echo json_encode($array);
    }

    function atualizar($array) {
        $f  = new PizzaDAO(recebeJson($array));
        $f->update();
    }

    function cadastrar($array) {
       $f  = new PizzaDAO(recebeJson($array));
       $f->insert();
    }

    function excluir($array) {
       $f  = new PizzaDAO(recebeJson($array));
       $f->delete();
    }

    function pesquisa($array) {
        $consulta = recebeJson($array);
        $f = new PizzaDAO(NULL);
        enviaJson($f->select(strtoupper($consulta->getNome())));
    }
    function pesquisaId($array) {
        $consulta = recebeJson($array);
        $f = new PizzaDAO(NULL);
        $teste= $consulta->getId();
        enviaJson($f->selectID($teste));
    }
    function pesquisaAll() {
        
        $f = new PizzaDAO(NULL);
        enviaJson($f->selectALL());
    }


?>
