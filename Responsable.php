<?php

class Responsable{
    private $numeroEmpleado;
    private $numeroLicencia;
    private $nombre;
    private $apellido;

    public function __construct($numeroEmpleadoInput, $numeroLicenciaInput, $nombreInput, $apellidoInput) {
        $this->numeroEmpleado = $numeroEmpleadoInput;
        $this->numeroLicencia = $numeroLicenciaInput;
        $this->nombre = $nombreInput;
        $this->apellido = $apellidoInput;
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
    
    public function __toString()
    {
        return "numero empleado : {$this->getNumeroEmpleado()}
numero licencia : {$this->getNumeroLicencia()}
nombre : {$this->getNombre()}
apellido : {$this->getApellido()}";
    }

}
