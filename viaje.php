<?php

class Viaje{
    private $codigoMismoDestino;
    private $destino;
    private $cantidadMaximaPasajeros;
    private $colObjPasajeros;
    private $objResponsable;
    private $precioViaje;

    public function __construct($codigoMismoDestinoInput, $destinoInput, $cantidadMaximaPasajerosInput, $colObjPasajerosInput , $objResponsableInput,$precioViaje) {
        $this->codigoMismoDestino = $codigoMismoDestinoInput;
        $this->destino = $destinoInput;
        $this->cantidadMaximaPasajeros = $cantidadMaximaPasajerosInput;
        $this->colObjPasajeros = $colObjPasajerosInput;
        $this->objResponsable = $objResponsableInput;
        $this->precioViaje = $precioViaje;
    }

    public function getObjResponsable(){
        return $this->objResponsable;
    }

    public function setObjResponsable($objResponsable){
        $this->objResponsable = $objResponsable;
    }

    // Método de acceso (getter) para codigoMismoDestino
    public function getCodigoMismoDestino() {
        return $this->codigoMismoDestino;
    }

    // Método de acceso (getter) para destino
    public function getDestino() {
        return $this->destino;
    }

    // Método de acceso (getter) para cantidadMaximaPasajeros
    public function getCantidadMaximaPasajeros() {
        return $this->cantidadMaximaPasajeros;
    }

    // Método de acceso (getter) para arrayPasajero
    public function getColObjPasajeros() {
        return $this->colObjPasajeros;
    }

       // Método de modificación (setter) para codigoMismoDestino
       public function setCodigoMismoDestino($codigoMismoDestino) {
        $this->codigoMismoDestino = $codigoMismoDestino;
    }

    // Método de modificación (setter) para destino
    public function setDestino($destino) {
        $this->destino = $destino;
    }

    // Método de modificación (setter) para cantidadMaximaPasajeros
    public function setCantidadMaximaPasajeros($cantidadMaximaPasajeros) {
        $this->cantidadMaximaPasajeros = $cantidadMaximaPasajeros;
    }

    // Método de modificación (setter) para arrayPasajero
    public function setColObjPasajeros($colObjPasajeros) {
        $this->colObjPasajeros = $colObjPasajeros;
    }

	public function getPrecioViaje(){
		return $this->precioViaje;
	}

	public function setPrecioViaje($value) {
		$this->precioViaje = $value;
	}

    
    public function hayPasajesDisponible(){
        $seFiltro = false;
        if(count($this->getColObjPasajeros()) <= $this->getCantidadMaximaPasajeros()){
            $seFiltro = true;
        }
        return $seFiltro;
    }


    public function venderPasaje($objPasajero){

        $costoFinal = 0;

        if($this->hayPasajesDisponible()){
            if($objPasajero	instanceof Pasajero){
                $costoFinal = ($this->getPrecioViaje()*($objPasajero->darPorcentajeIncremento()/100+1));
            }elseif($objPasajero instanceof PasajeroNecesidadesEspeciales){
                $costoFinal = ($this->getPrecioViaje()*($objPasajero->darPorcentajeIncremento()/100+1));
            }elseif($objPasajero instanceof PasajeroVip){
                $costoFinal = ($this->getPrecioViaje()*($objPasajero->darPorcentajeIncremento()/100+1));
            }
            $coleccionNuevaPasajeros = $this->getColObjPasajeros();
            $coleccionNuevaPasajeros[] = [$objPasajero,['Importe final' => $costoFinal]];
            $this->setColObjPasajeros($coleccionNuevaPasajeros);

        }
        
        return $costoFinal;

    }


    public function crearPasajero($nombrePasajero, $apellidoPasajero, $numeroDocumentoPasajero, $telefonoPasajero, $nroAsiento,$nroTicket){
        //creo un pasajero siempre y cuando no exista uno ya anteriormente
        $objPasajero = new Pasajero($nombrePasajero, $apellidoPasajero, $numeroDocumentoPasajero, $telefonoPasajero, $nroAsiento, $nroTicket);
        $importe = $this->venderPasaje($objPasajero);
        return $importe;
    }
    public function crearPasajeroVip($nombrePasajero, $apellidoPasajero, $numeroDocumentoPasajero, $telefonoPasajero, $nroViajeroFrecuente, $nroAsiento,$nroTicket,$cantidadMillasPasajero){
        //creo un pasajero siempre y cuando no exista uno ya anteriormente
        $objPasajeroVip = new PasajeroVip($nombrePasajero, $apellidoPasajero, $numeroDocumentoPasajero, $telefonoPasajero, $nroViajeroFrecuente, $nroAsiento,$nroTicket,$cantidadMillasPasajero);
        $importe = $this->venderPasaje($objPasajeroVip);
        return $importe;
    }
    public function crearPasajeroNecesidadesEspeciales($nombre, $apellido, $numeroDocumento, $telefono,$nroViajeroFrecuente,$sillaRuedas, $asistenciaParaEmbarque, $comidaEspecial,$nroAsiento,$nroTicket){
        //creo un pasajero siempre y cuando no exista uno ya anteriormente
        $objPasajeroEspecial = new PasajeroNecesidadesEspeciales($nombre,$apellido,$numeroDocumento,$telefono,$nroViajeroFrecuente,$sillaRuedas,$asistenciaParaEmbarque,$comidaEspecial,$nroAsiento,$nroTicket);
        $importe = $this->venderPasaje($objPasajeroEspecial);
        return $importe;
    }
    public function crearResponsable($objResponsable){

        $this->setObjResponsable($objResponsable);

    }

    
    public function encontrarPorTicket($ticketChequeoInterno){
        print_r($this->getColObjPasajeros());

        $i=0;
        $posicionObjeto = null;

        while($i < count($this->getColObjPasajeros()) && $posicionObjeto == null){
            if($this->getColObjPasajeros()[$i][0]->getNroTicket() == $ticketChequeoInterno){
                $posicionObjeto = $this->getColObjPasajeros()[$i][0];
                echo $posicionObjeto."\n";
            }else{
                $i++;
            }
        }
        
        return $posicionObjeto;
    }

    public function modificarPasajero($nombre,$apellido,$numeroDocumento,$telefono,$nroViajeroFrecuente,$ticketChequeoInterno){

        print_r($this->getColObjPasajeros());

        $i=0;
        $bandera = null;

        while($i < count($this->getColObjPasajeros()) && $bandera == null){
            if($this->getColObjPasajeros()[$i][0]->getNroTicket() == $ticketChequeoInterno){
                $this->getColObjPasajeros()[$i][0]->setNombre($nombre);
                $this->getColObjPasajeros()[$i][0]->setApellido($apellido);
                $this->getColObjPasajeros()[$i][0]->setTelefono($telefono);
                $this->getColObjPasajeros()[$i][0]->setNumeroDocumento($numeroDocumento);
                $this->getColObjPasajeros()[$i][0]->setNroViajeroFrecuente($nroViajeroFrecuente);
                $bandera = $this->getColObjPasajeros()[$i][0];
            }else{
                $i++;
            }
        }
        
        return $bandera;
    }

    public function modificarPasajeroVip($nombre, $apellido, $numeroDocumento, $telefono,$nroViajeroFrecuente,$nroAsiento,$nroTicket){

        print_r($this->getColObjPasajeros());

        $i=0;
        $bandera = null;

        while($i < count($this->getColObjPasajeros()) && $bandera == null){
            if($this->getColObjPasajeros()[$i][0]->getNroTicket() == $nroTicket){
                $this->getColObjPasajeros()[$i][0]->setNombre($nombre);
                $this->getColObjPasajeros()[$i][0]->setApellido($apellido);
                $this->getColObjPasajeros()[$i][0]->setTelefono($telefono);
                $this->getColObjPasajeros()[$i][0]->setNumeroDocumento($numeroDocumento);
                $this->getColObjPasajeros()[$i][0]->setNroViajeroFrecuente($nroViajeroFrecuente);
                $this->getColObjPasajeros()[$i][0]->setNroAsiento($nroAsiento);
                $bandera = $this->getColObjPasajeros()[$i][0];
            }else{
                $i++;
            }
        }
        
        return $bandera;

    }

    public function modificarPasajeroNecesidadesEspeciales($nombre, $apellido, $numeroDocumento, $telefono,$nroViajeroFrecuente,$sillaRuedas, $asistenciaParaEmbarque, $comidaEspecial,$nroAsiento,$nroTicket){

                
        print_r($this->getColObjPasajeros());

        $i=0;
        $bandera = null;

        while($i < count($this->getColObjPasajeros()) && $bandera == null){
            if($this->getColObjPasajeros()[$i][0]->getNroTicket() == $nroTicket){
                $this->getColObjPasajeros()[$i][0]->setNombre($nombre);
                $this->getColObjPasajeros()[$i][0]->setApellido($apellido);
                $this->getColObjPasajeros()[$i][0]->setTelefono($telefono);
                $this->getColObjPasajeros()[$i][0]->setNumeroDocumento($numeroDocumento);
                $this->getColObjPasajeros()[$i][0]->setNroViajeroFrecuente($nroViajeroFrecuente);
                $this->getColObjPasajeros()[$i][0]->setNroAsiento($nroAsiento);
                $this->getColObjPasajeros()[$i][0]->setSillaRuedas($sillaRuedas);
                $this->getColObjPasajeros()[$i][0]->setAsistenciaParaEmbarque($asistenciaParaEmbarque);
                $this->getColObjPasajeros()[$i][0]->setComidaEspecial($comidaEspecial);
                $bandera = $this->getColObjPasajeros()[$i][0];
            }else{
                $i++;
            }
        }
        
        return $bandera;


    }


    public function encontrarPorNumeroLicencia($numeroEmpleado){
        $encontrado = false;
        if($this->getObjResponsable()->getNumeroEmpleado() == $numeroEmpleado){ 
            $encontrado = true;
        }
        return $encontrado;
    }
    public function reemplazarResponsable($numeroEmpleado,$numeroLicencia,$nombre,$apellido){

            $this->getObjResponsable()->setNumeroEmpleado($numeroEmpleado);
            $this->getObjResponsable()->setNumeroLicencia($numeroLicencia);
            $this->getObjResponsable()->setNombre($nombre);
            $this->getObjResponsable()->setApellido($apellido);

    }

    public function reemplazarDatosViaje($codigoViajeMod,$destinoViajeMod,$cantidadMaximaPasajerosMod,$precioViaje){

        $this->setCodigoMismoDestino($codigoViajeMod);
        $this->setDestino($destinoViajeMod);
        $this->setCantidadMaximaPasajeros($cantidadMaximaPasajerosMod);
        $this->setPrecioViaje($precioViaje);

    }

    public function mostrarObjPasajero() {

        $texto = "";
        foreach ($this->getColObjPasajeros() as $objPasajeros) {
            $i=0;
            for ($i=0;$i < count($objPasajeros);$i++) {
                
                foreach ($objPasajeros[$i] as $indice => $valor) {
                        $texto .= $objPasajeros[0];
                        $texto .= "$indice : $valor\n"; // Mostrar "Costo final" con formato especial
                
                }
                $texto .= "\n";
            }
        }
    
        return $texto;
        //$texto .= $objPasajeros[0];
    }
    

    public function __toString()
    {
        $texto = "Destino: {$this->getDestino()}"."\n";
        $texto .="Codigo del mismo destino:{$this->getCodigoMismoDestino()}"."\n";
        $texto .="Cantidad de pasajeros: {$this->getCantidadMaximaPasajeros()}"."\n";
        $texto .="Los pasajeros son :\n {$this->mostrarObjPasajero()}"."\n";
        $texto .="Responsable de realizar el viaje: {$this->getObjResponsable()}"."\n";
        $texto .="El precio del viaje es de : {$this->getPrecioViaje()}"."\n";
        return $texto;
    }

} 