<?php
include_once 'pasajero.php';
include_once 'Responsable.php';

class Viaje{
    private $codigoMismoDestino;
    private $destino;
    private $cantidadMaximaPasajeros;
    private $objPasajeros;
    private $objResponsable;

    public function __construct($codigoMismoDestinoInput, $destinoInput, $cantidadMaximaPasajerosInput, $objPasajerosInput , $objResponsableInput) {
        $this->codigoMismoDestino = $codigoMismoDestinoInput;
        $this->destino = $destinoInput;
        $this->cantidadMaximaPasajeros = $cantidadMaximaPasajerosInput;
        $this->objPasajeros = $objPasajerosInput;
        $this->objResponsable = $objResponsableInput;
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
    public function getObjPasajeros() {
        return $this->objPasajeros;
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
    public function setObjPasajeros($objPasajeros) {
        $this->objPasajeros = $objPasajeros;
    }

    public function encontrarPorDni($dni){
        $i = 0;
        $booleano = false;
        $encontradoObj = -1;

        while($i < count($this->getObjPasajeros()) && $booleano != true){
            if($this->getObjPasajero()[$i] == $dni){
                $encontradoObj = $i;
            }
        }
        return $encontradoObj;
    }

    public function modificarArrayPasajeros($nombre,$apellido,$dni,$telefono){

        if( $this->getObjPasajeros()[$this->encontrarPorDni($dni)] != -1 ){
            $this->getObjPasajeros()[$this->encontrarPorDni($dni)]->setNombre($nombre);
            $this->getObjPasajeros()[$this->encontrarPorDni($dni)]->setApellido($apellido);
            $this->getObjPasajeros()[$this->encontrarPorDni($dni)]->setNumeroDocumento($dni);
            $this->getObjPasajeros()[$this->encontrarPorDni($dni)]->setTelefono($telefono);
        } 
        
    }

    public function mostrarObjPasajero() {
        $texto = "";
        foreach($this->getObjPasajero() as $objPasajero){
            $texto .= $objPasajero;
        }
        return $texto;
  
    }
    public function encontrarPorNumeroLicencia($numeroEmpleado){
        $encontrado = true;
        if($this->getObjResponsable()->getNumeroEmpleado() == $numeroEmpleado){ 
            $encontrado = false;
        }
        return $encontrado;
    }
    public function reemplazarResponsable($numeroEmpleado,$numeroLicencia,$nombre,$apellido){

        if($this->getObjResponsable()->encontrarPorNumeroLicencia($numeroEmpleado)){
            $this->getObjResponsable()->setNumeroEmpleado($numeroEmpleado);
            $this->getObjResponsable()->setNumeroLicencia($numeroLicencia);
            $this->getObjResponsable()->setNombre($nombre);
            $this->getObjResponsable()->setApellido($apellido);
        }
    }
    public function reemplazarDatosViaje($codigoViajeMod,$destinoViajeMod,
    $cantidadMaximaPasajerosMod){

    if($codigoViajeMod == $this->getCodigoMismoDestino()){
        $this->setCodigoMismoDestino($codigoViajeMod);
        $this->setDestino($destinoViajeMod);
        $this->setCantidadMaximaPasajeros($cantidadMaximaPasajerosMod);
    }
    }

    public function __toString()
    {
        $texto = "Destino: {$this->getDestino()}"."\n";
        $texto .="Codigo del mismo destino:{$this->getCodigoMismoDestino()}"."\n";
        $texto .="Cantidad de pasajeros: {$this->getCantidadMaximaPasajeros()}"."\n";
        $texto .="Los pasajeros son :\n {$this->mostrarObjPasajero()}"."\n";
        $texto .="Responsable de realizar el viaje: {$this->getObjResponsable()}"."\n";
        return $texto ;
    }

}




