<?php

 
    @include_once '..\model\vo\suco.php';
    @include_once '..\model\dao\SucoDAO.php';
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
            
        $classe = new Suco();
       
       $classe->setId((int)$array->id);
       $classe->setNome(strtoupper($array->nome));
       $classe->setSabor(strtoupper($array->sabor));
       $classe->setDescricao(strtoupper($array->descricao));
       $classe->setPreco_venda(floatval($array->preco_venda));
       $classe->setQuantidade((int)$array->quantidade);
       
       $classe->setPreco_compra(floatval($array->preco_compra));
       $classe->setFornecedor(strtoupper($array->fornecedor));
       $classe->setMarca(strtoupper($array->marca));
       $classe->setTamanho(strtoupper($array->tamanho));

        return $classe;
    }
    
     function enviaJson($array){
            
        echo json_encode($array);
    }

    function atualizar($array) {
        $f  = new SucoDAO(recebeJson($array));
        $f->update();
    }

    function cadastrar($array) {
       $f  = new SucoDAO(recebeJson($array));
       $f->insert();
    }

    function excluir($array) {
       $f  = new SucoDAO(recebeJson($array));
       $f->delete();
    }

    function pesquisa($array) {
        $consulta = recebeJson($array);
        $f = new SucoDAO(NULL);
        enviaJson($f->select(strtoupper($consulta->getNome())));
    }
    function pesquisaId($array) {
        $consulta = recebeJson($array);
        $f = new SucoDAO(NULL);
        enviaJson($f->selectID($consulta->getNome()));
    }


?>
