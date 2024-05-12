<?php

class Responsable extends Persona{
    
    private $numeroEmpleado;
    private $numeroLicencia;

    public function __construct($nombre,$apellido,$numeroEmpleadoInput, $numeroLicenciaInput) {
        parent::__construct($nombre, $apellido);
        $this->numeroEmpleado = $numeroEmpleadoInput;
        $this->numeroLicencia = $numeroLicenciaInput;
    }

    // Método getter para numeroEmpleado
    public function getNumeroEmpleado() {
        return $this->numeroEmpleado;
    }

    // Método setter para numeroEmpleado
    public function setNumeroEmpleado($numeroEmpleado) {
        $this->numeroEmpleado = $numeroEmpleado;
    }

    // Método getter para numeroLicencia
    public function getNumeroLicencia() {
        return $this->numeroLicencia;
    }

    // Método setter para numeroLicencia
    public function setNumeroLicencia($numeroLicencia) {
        $this->numeroLicencia = $numeroLicencia;
    }

    public function __toString()
    {
        return "numero empleado : {$this->getNumeroEmpleado()}
numero licencia : {$this->getNumeroLicencia()}
nombre : {$this->getNombre()}
apellido : {$this->getApellido()}";
    }

}
