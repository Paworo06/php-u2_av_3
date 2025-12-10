<?php

class DatosPersonales {
    protected $nombreCompleto;
    protected $dni;
    protected $direccion;
    protected $fechaNacimiento;
    protected $email;
    protected $telefono;

    // Constructor
    public function __construct($nombreCompleto, $dni, $direccion, $fechaNacimiento, $email, $telefono) {
        $this->nombreCompleto = $nombreCompleto;
        $this->dni = $dni;
        $this->direccion = $direccion;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->email = $email;
        $this->telefono = $telefono;
    }

    // Getters
    public function getNombreCompleto() { return $this->nombreCompleto; }
    public function getDni() { return $this->dni; }
    public function getDireccion() { return $this->direccion; }
    public function getFechaNacimiento() { return $this->fechaNacimiento; }
    public function getEmail() { return $this->email; }
    public function getTelefono() { return $this->telefono; }

    // Setters
    public function setNombreCompleto($nombreCompleto) { $this->nombreCompleto = $nombreCompleto; }
    public function setDni($dni) { $this->dni = $dni; }
    public function setDireccion($direccion) { $this->direccion = $direccion; }
    public function setFechaNacimiento($fechaNacimiento) { $this->fechaNacimiento = $fechaNacimiento; }
    public function setEmail($email) { $this->email = $email; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }

    // Método para obtener los datos personales como un array (útil para la tabla)
    protected function getDatosPersonalesArray() {
        return [
            'Nombre Completo' => $this->nombreCompleto,
            'DNI' => $this->dni,
            'Dirección' => $this->direccion,
            'Fecha de Nacimiento' => $this->fechaNacimiento,
            'Email' => $this->email,
            'Teléfono' => $this->telefono
        ];
    }
}