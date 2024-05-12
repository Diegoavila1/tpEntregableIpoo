<?php 

class Persona{
	
    private $nombre;
    private $apellido;

	public function __construct($nombre, $apellido) {
		$this->nombre = $nombre;
		$this->apellido = $apellido;
	}

	public function getNombre() {
		return $this->nombre;
	}

	public function setNombre($value) {
		$this->nombre = $value;
	}

	public function getApellido() {
		return $this->apellido;
	}

	public function setApellido($value) {
		$this->apellido = $value;
	}
    public function __toString()
    {
        return "nombre : {$this->getNombre()}
        apellido : {$this->getApellido()}";

    }
}