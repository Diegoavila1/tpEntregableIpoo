<?php

class PasajeroNecesidadesEspeciales extends Pasajero{
    
    private $sillaRuedas;
    private $asistenciaParaEmbarque;
    private $comidaEspecial;

	public function __construct($nombre, $apellido, $numeroDocumentoInput, $telefonoInput,$nroViajeroFrecuente,$sillaRuedas, $asistenciaParaEmbarque, $comidaEspecial,$nroAsiento,$nroTicket) {
        parent::__construct($nombre, $apellido, $numeroDocumentoInput, $telefonoInput,$nroViajeroFrecuente,$nroAsiento,$nroTicket);
		$this->sillaRuedas = $sillaRuedas;
		$this->asistenciaParaEmbarque = $asistenciaParaEmbarque;
		$this->comidaEspecial = $comidaEspecial;
	}

	public function getSillaRuedas() {
		return $this->sillaRuedas;
	}

	public function setSillaRuedas($value) {
		$this->sillaRuedas = $value;
	}

	public function getAsistenciaParaEmbarque() {
		return $this->asistenciaParaEmbarque;
	}

	public function setAsistenciaParaEmbarque($value) {
		$this->asistenciaParaEmbarque = $value;
	}

	public function getComidaEspecial() {
		return $this->comidaEspecial;
	}

	public function setComidaEspecial($value) {
		$this->comidaEspecial = $value;
	}


    public function darPorcentajeIncremento(){
        $pasaje = 0;
        if($this->getSillaRuedas() && $this->getSillaRuedas() && $this->getComidaEspecial()){
            $pasaje = 30;
        }elseif($this->getSillaRuedas() || $this->getSillaRuedas() || $this->getComidaEspecial()){
            $pasaje = 15;
        }
        return $pasaje;
    }

    public function __toString()
    {
        $texto = parent::__toString();
        $texto .= "silla de ruedas : {$this->getSillaRuedas()}";
        $texto .= "asistencia : {$this->getAsistenciaParaEmbarque()}";
        $texto .= "comidas especiales : {$this->getComidaEspecial()}";
        return $texto;
    }

}