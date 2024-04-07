<?php
include_once 'pasajeros.php';
include_once 'Responsable.php';

class Viaje{
    private $codigoMismoDestino;
    private $destino;
    private $cantidadMaximaPasajeros;
    private $objPasajero;
    private $objResponsable;

    public function __construct($codigoMismoDestinoInput, $destinoInput, $cantidadMaximaPasajerosInput, $objPasajerosInput , $objResponsableInput) {
        $this->codigoMismoDestino = $codigoMismoDestinoInput;
        $this->destino = $destinoInput;
        $this->cantidadMaximaPasajeros = $cantidadMaximaPasajerosInput;
        $this->objPasajero = $objPasajerosInput;
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
    public function getObjPasajero() {
        return $this->objPasajero;
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
    public function setObjPasajero($objPasajero) {
        $this->objPasajero = $objPasajero;
    }

    public function mostrarObjPasajero() {
        $texto = "";
        foreach($this->getObjPasajero() as $objPasajero){
            $texto .= $objPasajero;
        }
        return $texto;
  
    }

    public function __toString()
    {
        $texto = "destino: {$this->getDestino()}"."\n";
        $texto .="codigo del mismo destino:{$this->getCodigoMismoDestino()}"."\n";
        $texto .= "cantidad de pasajeros: {$this->getCantidadMaximaPasajeros()}"."\n";
        $texto .= "los pasajeros son :\n {$this->mostrarObjPasajero()}"."\n";
        $texto .= "responsable de realizar el viaje: {$this->getObjResponsable()}"."\n";
        return $texto ;
    }
}




