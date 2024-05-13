<?php 

class Pasajero extends Persona{

    private $numeroDocumento;
    private $telefono;
    private $nroAsiento;
    private $nroTicket;

    public function __construct($nombre, $apellido, $numeroDocumentoInput, $telefonoInput,$nroAsiento,$nroTicket) {
        parent::__construct($nombre, $apellido);
        $this->numeroDocumento = $numeroDocumentoInput;
        $this->telefono = $telefonoInput;
        $this->nroTicket = $nroTicket;
        $this->nroAsiento = $nroAsiento;
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

    public function getNroAsiento() {
		return $this->nroAsiento;
	}

	public function setNroAsiento($value) {
		$this->nroAsiento = $value;
	}

	public function getNroTicket() {
		return $this->nroTicket;
	}

	public function setNroTicket($value) {
		$this->nroTicket = $value;
	}

    public function darPorcentajeIncremento(){
        return 10;
    }

    public function __toString()
    { 
        $texto = parent::__toString();
        $texto .= "numero de documento : {$this->getNumeroDocumento()}"."\n";
        $texto .= "telefono : {$this->getTelefono()}"."\n";
        $texto .= "numero de asiento : {$this->getNroAsiento()}"."\n";
        return $texto ;
    }


}