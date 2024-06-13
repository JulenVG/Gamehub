<?php
	class Biblioteca
	{
        public $usuario;
		public $juegos;

		
		//contructor con dos parametros opcionales
		function __construct( $usuario = '', $juegos = '')
		{
            $this->usuario= $usuario;
			$this->juegos = $juegos;

		}

		//setter/getter       
		public function getJuegos(){
            return $this->juegos; 
        }

		public function getUsuario(){
            return $this->usuario; 
        }
	}
?>