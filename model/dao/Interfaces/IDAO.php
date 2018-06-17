<?php
    interface IDAO {
        public function insert();
        public function update();
        public function select($consulta);
        public function delete();
        
}
?>