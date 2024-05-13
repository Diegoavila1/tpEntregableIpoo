<?

class PasajeroVip extends Pasajero{
    
    private $nroViajeroFrecuente;
    private $cantidadMillasPasajero; 
    
    public function __construct($nombre, $apellido, $numeroDocumentoInput, $telefonoInput,$nroViajeroFrecuente,$nroAsiento,$nroTicket,$cantidadMillasPasajero) {
        parent::__construct($nombre, $apellido, $numeroDocumentoInput, $telefonoInput,$nroAsiento,$nroTicket,$cantidadMillasPasajero);
        $this->nroViajeroFrecuente = $nroViajeroFrecuente;
    }

	public function getNroViajeroFrecuente() {
		return $this->nroViajeroFrecuente;
	}

	public function setNroViajeroFrecuente($value) {
		$this->nroViajeroFrecuente = $value;
	}
	public function getCantidadMillasPasajero() {
		return $this->cantidadMillasPasajero;
	}

	public function setCantidadMillasPasajero($value) {
		$this->cantidadMillasPasajero = $value;
	}

   //Para un pasajero VIP se incrementa el importe un 35% y si la cantidad de millas acumuladas supera a las 300 millas se realiza un incremento del 30%. 
    public function darPorcentajeIncremento(){
        $importe = 35;
        if($this->getCantidadMillasPasajero() > 300){
            $importe += 30;
        }
        return $importe;
    }

    public function __toString()
    {
        $texto = parent::__toString();
        $texto .= "numero Viajero frecuente : {$this->getNroViajeroFrecuente()}"."\n";
        return $texto;
    }


}