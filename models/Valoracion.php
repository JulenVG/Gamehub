<?php
	class Valoracion
	{
        public $usuario;
		public $nota;
		public $comentario;
		
		//contructor con dos parametros opcionales
		function __construct( $usuario = '', $nota = '', $comentario = '')
		{
            $this->usuario= $usuario;
			$this->nota = $nota;
            $this->comentario = $comentario;


		}

		//getter       
		public function getUsuario(){
            return $this->usuario; 
        }
		public function getNota(){
            return $this->nota; 
        }

		public function getComentario(){ 
            return $this->comentario; 
        }

	}
?>