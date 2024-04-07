<?php 

class Pasajeros {
    private $nombre;
    private $apellido;
    private $numeroDocumento;
    private $telefono;

    public function __construct($nombreInput, $apellidoInput, $numeroDocumentoInput, $telefonoInput) {
        $this->nombre = $nombreInput;
        $this->apellido = $apellidoInput;
        $this->numeroDocumento = $numeroDocumentoInput;
        $this->telefono = $telefonoInput;
    }

    // Método getter para nombre
    public function getNombre() {
        return $this->nombre;
    }

    // Método setter para nombre
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    // Método getter para apellido
    public function getApellido() {
        return $this->apellido;
    }

    // Método setter para apellido
    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    // Método getter para numeroDocumento
    public function getNumeroDocumento() {
        return $this->numeroDocumento;
    }

    // Método setter para numeroDocumento
    public function setNumeroDocumento($numeroDocumento) {
        $this->numeroDocumento = $numeroDocumento;
    }

    // Método getter para telefono
    public function getTelefono() {
        return $this->telefono;
    }

    // Método setter para telefono
    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    
    public function __toString()
    { 
        return "nombre: {$this->getNombre()}
apellido:{$this->getApellido()}
numero de documento:{$this->getNumeroDocumento()}
telefono:{$this->getTelefono()}";
        
    }
}
