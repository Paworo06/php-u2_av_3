<?php

require_once 'DatosPersonales.php';

class Profesor extends DatosPersonales {
    private $centroImparte;
    private $departamentoAdscrito;
    private $cursoEscolar;

    // Constructor
    public function __construct($nombreCompleto, $dni, $direccion, $fechaNacimiento, $email, $telefono, $centroImparte, $departamentoAdscrito, $cursoEscolar) {
        parent::__construct($nombreCompleto, $dni, $direccion, $fechaNacimiento, $email, $telefono);
        $this->centroImparte = $centroImparte;
        $this->departamentoAdscrito = $departamentoAdscrito;
        $this->cursoEscolar = $cursoEscolar;
    }

    // Getters
    public function getCentroImparte() { return $this->centroImparte; }
    public function getDepartamentoAdscrito() { return $this->departamentoAdscrito; }
    public function getCursoEscolar() { return $this->cursoEscolar; }

    // Setters
    public function setCentroImparte($centroImparte) { $this->centroImparte = $centroImparte; }
    public function setDepartamentoAdscrito($departamentoAdscrito) { $this->departamentoAdscrito = $departamentoAdscrito; }
    public function setCursoEscolar($cursoEscolar) { $this->cursoEscolar = $cursoEscolar; }

    // Método para mostrar los datos
    public function MostrarDatos() {
        $datos = $this->getDatosPersonalesArray();
        $datos['Centro donde Imparte'] = $this->centroImparte;
        $datos['Departamento Adscrito'] = $this->departamentoAdscrito;
        $datos['Curso Escolar'] = $this->cursoEscolar;

        $this->generarTabla('Datos Personales del Profesor', $datos);
    }
    
    // Método para generar la tabla HTML
    private function generarTabla($titulo, $datos) {
        echo '<h2>' . $titulo . '</h2>';
        echo '<table border="1" style="border-collapse: collapse; width: 50%;">';
        foreach ($datos as $clave => $valor) {
            echo '<tr>';
            echo '<td style="font-weight: bold; padding: 8px;">' . $clave . '</td>';
            echo '<td style="padding: 8px;">' . htmlspecialchars($valor) . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}