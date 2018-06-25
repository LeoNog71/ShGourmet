<?php

 
    @include_once '..\model\vo\porcao.php';
    @include_once '..\model\dao\PorcaoDAO.php';
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
   
    function recebeJson($array){
            
       $classe = new Porcao();
       
       $classe->setId((int)$array->id);
       $classe->setNome($array->nome);
       $classe->setDescricao($array->descricao);
       $classe->setPreco_venda((double)$array->preco_venda);
       $classe->setQuantidade((int)$array->quantidade);
       
       $classe->setPreco_compra((double)$array->preco_compra);
       $classe->setFornecedor($array->fornecedor);
       $classe->setTamanho($array->tamanho);

        return $classe;
    }
    
     function enviaJson($array){
            
        echo json_encode($array);
    }

    function atualizar($array) {
        $f  = new PorcaoDAO(recebeJson($array));
        $f->update();
    }

    function cadastrar($array) {
       $f  = new PorcaoDAO(recebeJson($array));
       $f->insert();
    }

    function excluir($array) {
       $f  = new PorcaoDAO(recebeJson($array));
       $f->delete();
    }

    function pesquisa($array) {
        $consulta = recebeJson($array);
        $f = new PorcaoDAO(NULL);
        enviaJson($f->select(strtoupper($consulta->getNome())));
    }
    function pesquisaId($array) {
        $consulta = recebeJson($array);
        $f = new PorcaoDAO(NULL);
        enviaJson($f->selectID($consulta->getNome()));
    }


?>
