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

    public function encontrarPorDni($dni){
        $i = 0;
        $encontradoObj = -1;

        while($i < count($this->getColObjPasajeros()) && $encontradoObj == -1){
            if($this->getColObjPasajeros()[$i]->getNumeroDocumento() == $dni){
                $encontradoObj = $i;
            }else{
                $i++;
            }

        }

        return $encontradoObj;
    }

    public function modificarArrayPasajeros($nombre,$apellido,$dni,$telefono){

        $colObjPasajeros = $this->getColObjPasajeros();
            $colObjPasajeros[$dni]->setNombre($nombre);
            $colObjPasajeros[$dni]->setApellido($apellido);
            $colObjPasajeros[$dni]->setTelefono($telefono);

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

    public function hayPasajesDisponible(){
        $seFiltro = false;
        if(count($this->getColObjPasajeros()) <= $this->getCantidadMaximaPasajeros()){
            $seFiltro = true;
        }
        return $seFiltro;
    }

    //implementar el método venderPasaje($objPasajero) que debe incorporar el pasajero a la colección de pasajeros
    //(solo si hay espacio disponible), actualizar los costos abonados y retornar el costo final que deberá ser abonado por el pasajero.
    public function venderPasaje($objPasajero){
        $coleccionNuevaPasajeros  = [];
        $coleccionNuevaPasajeros[] = $this->getColObjPasajeros();
        $costoFinal = 0;

        if($this->hayPasajesDisponible()){
            if($objPasajero	instanceof Pasajero){
                $costoFinal = ($this->getPrecioViaje()*($objPasajero->darPorcentajeIncremento()/100+1));
            }elseif($objPasajero instanceof PasajeroNecesidadesEspeciales){
                $costoFinal = ($this->getPrecioViaje()*($objPasajero->darPorcentajeIncremento()/100+1));
            }elseif($objPasajero instanceof PasajeroVip){
                $costoFinal = ($this->getPrecioViaje()*($objPasajero->darPorcentajeIncremento()/100+1));
            }
            $coleccionNuevaPasajeros[] = $objPasajero;
            $this->setColObjPasajeros($coleccionNuevaPasajeros);
        }
        
        return $costoFinal;

    }

    public function mostrarObjPasajero() {
        $texto = "";
        foreach($this->getColObjPasajeros() as $objPasajero){
                $texto .= $objPasajero;
                echo "\n";
        }
        return $texto;
  
    }

    public function __toString()
    {
        $texto = "Destino: {$this->getDestino()}"."\n";
        $texto .="Codigo del mismo destino:{$this->getCodigoMismoDestino()}"."\n";
        $texto .="Cantidad de pasajeros: {$this->getCantidadMaximaPasajeros()}"."\n";
        $texto .="Los pasajeros son :\n {$this->mostrarObjPasajero()}"."\n";
        $texto .="Responsable de realizar el viaje: \n
        {$this->getObjResponsable()}"."\n";
        return $texto ;
    }




}