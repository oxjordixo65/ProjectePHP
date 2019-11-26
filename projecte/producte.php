<?php
    class producte {

        # ATRIBUTS
        private $id;
        private $descripcio;
        
        # CONSTRUCTOR
        public function __construct($idprod, $descprod) {
            $this->$id = $idprod;
            $this->$descripcio = $descprod;
        }

        # GETTER
        public function __get($prop) {
			if(property_exists($this,$prop)){
				return $this->$prop;
			}
			else{
				return -1;
			}		
        }
        
        # SETTER
        public function __set($prop, $valor) {
            if(property_exists($this,$prop)) {
                $this->$prop = $valor;
            }
        }

        # TO STRING
        public function __toString() {
            return "Producte amb ID: [$id].\n$descripcio";
        }


    }
?>