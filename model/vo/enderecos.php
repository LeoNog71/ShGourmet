<?php
    class Endereco{
		
		private $id;
		private $rua;
		private $bairro;
		private $cidade;
		private $numero;
                
		function __construct($id, $rua, $bairro, $cidade, $numero){
                    $this->id = $id;
                    $this->rua = $rua;
                    $this->bairro = $bairro;
                    $this->cidade = $cidade;
                    $this->numero = $numero;
                        
		}
		public function getId(){
			return $this->id;
		}
		public function setId($id){
			$this->id = $id;
		}
		public function getRua(){
			return $this->rua;
		}
		public function setRua($rua){
			$this->rua = $rua;
		}
		public function getBairro(){
			return $this->bairro;
		}
		public function setBairro($bairro){
			$this->bairro = $bairro;
		}
		public function getCidade(){
			return $this->cidade;
		}
		public function setCidade($cidade){
			$this->cidade = $cidade;
		}
		public function getNumero(){
			return $this->numero;
		}
		public function setNumero($numero){
			$this->numero = $numero;
		}
	}

?>

