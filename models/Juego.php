<?php
	class Juego
	{
        public $id;
		public $nombre;
		public $img;
		public $descripcion;
		public $genero;
        public $estado;
		public $plataforma;
		public $valoraciones;
		
		//contructor
		function __construct( $id = '', $nombre = '', $img = '', $descripcion = '', $genero = '', $estado = '', $plataforma = '', $valoraciones = '' )
		{
            $this->id = $id;
			$this->nombre = $nombre;
			$this->img = $img;
            $this->descripcion = $descripcion;
			$this->genero = $genero;
			$this->estado = $estado;
            $this->plataforma = $plataforma;
			$this->valoraciones = $valoraciones;
		}

		//setter
		public function getID(){
            return $this->id; 
        } 
        
		public function getNombre(){
            return $this->nombre; 
        }


		public function getImg(){
            return $this->img; 
        }

		public function getDescripcion(){ 
            return $this->descripcion; 
        }


		public function getGenero(){ 
            return $this->genero; 
        }

		public function setEstado($estado){
			$this->estado = $estado;
		}

		public function getEstado(){ 
            return $this->estado; 
        }

		public function setPlataforma($plataforma){
			$this->plataforma = $plataforma;
		}

		public function getPlataforma(){ 
            return $this->plataforma; 
        }

		public function setValoraciones($valoraciones){
			$this->valoraciones = $valoraciones;
		}

		public function getValoraciones(){ 
            return $this->valoraciones; 
        }
	}
?>