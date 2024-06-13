<?php
	class Usuario
	{
		private $id;
		private $email;
		public $usuario;
		private $contra;
		public $genero;
		public $nacimiento;
		
		//constructor
		function __construct($id = '', $email = '', $usuario = '', $contra = '', $genero = '', $nacimiento = '' )
		{
			$this->id = $id;
			$this->email = $email;
			$this->usuario = $usuario;
            $this->contra = $contra;
			$this->genero = $genero;
			$this->nacimiento = $nacimiento;

		}

		//getter
		public function getID(){
            return $this->id; 
        }

		public function getEmail(){
            return $this->email; 
        }

		public function getUsuario(){
            return $this->usuario; 
        }

		public function getContra(){ 
            return $this->contra; 
        }

		public function getGenero(){ 
            return $this->genero; 
        }

		public function getNacimiento(){ 
            return $this->nacimiento; 
        }
	}
?>