<?php
// Incluir la clase base
require_once 'DatosPersonales.php';

class Alumno extends DatosPersonales {
    private $estudiosMatriculado;
    private $anioCurso;
    private $centro;

    // Constructor: llama al constructor padre y asigna atributos propios
    public function __construct($nombreCompleto, $dni, $direccion, $fechaNacimiento, $email, $telefono, $estudiosMatriculado, $anioCurso, $centro) {
        parent::__construct($nombreCompleto, $dni, $direccion, $fechaNacimiento, $email, $telefono);
        $this->estudiosMatriculado = $estudiosMatriculado;
        $this->anioCurso = $anioCurso;
        $this->centro = $centro;
    }

    // Getters
    public function getEstudiosMatriculado() { return $this->estudiosMatriculado; }
    public function getAnioCurso() { return $this->anioCurso; }
    public function getCentro() { return $this->centro; }

    // Setters
    public function setEstudiosMatriculado($estudiosMatriculado) { $this->estudiosMatriculado = $estudiosMatriculado; }
    public function setAnioCurso($anioCurso) { $this->anioCurso = $anioCurso; }
    public function setCentro($centro) { $this->centro = $centro; }

    // Método solicitado para mostrar los datos
    public function MostrarDatos() {
        $datos = $this->getDatosPersonalesArray();
        $datos['Estudios Matriculado'] = $this->estudiosMatriculado;
        $datos['Año del Curso'] = $this->anioCurso;
        $datos['Centro Educativo'] = $this->centro;
        
        $this->generarTabla('Datos Personales del Alumno', $datos);
    }
    
    // Función para generar la tabla HTML
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