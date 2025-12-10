<?php
// Incluir las definiciones de las clases
require_once 'Profesor.php';
require_once 'Alumno.php';
require_once 'DatosPersonales.php';

$mensaje_error = '';
$resultado_html = '';

// --- Lógica de Validación y Procesamiento ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Datos comunes
        $tipo = $_POST['tipo'];
        $nombreCompleto = $_POST['nombreCompleto'];
        $dni = $_POST['dni'];
        $direccion = $_POST['direccion'];
        $fechaNacimiento = $_POST['fechaNacimiento'];
        $email = $_POST['email'];
        $telefono = $_POST['telefono'];

        // Comprobación de que al menos los campos comunes no estén vacíos
        if (empty($nombreCompleto) || empty($dni) || empty($email) || empty($tipo)) {
            throw new Exception("Los campos Nombre, DNI, Email y Tipo son obligatorios.");
        }

        if ($tipo === 'alumno') {
            // Datos específicos de Alumno
            $estudiosMatriculado = $_POST['estudiosMatriculado'];
            $anioCurso = $_POST['anioCurso'];
            $centro = $_POST['centro'];

            // Validación semántica para Alumno
            if (empty($estudiosMatriculado) || empty($anioCurso) || empty($centro)) {
                throw new Exception("Si el tipo es Alumno, los campos Estudios, Año y Centro son obligatorios.");
            }
            // Validación: Asegurar que los campos de Profesor están vacíos.
            if (!empty($_POST['centroImparte']) || !empty($_POST['departamentoAdscrito']) || !empty($_POST['cursoEscolar'])) {
                 throw new Exception("Si el tipo es Alumno, los campos específicos del Profesor deben estar vacíos.");
            }

            // Instanciar Alumno
            $objeto = new Alumno($nombreCompleto, $dni, $direccion, $fechaNacimiento, $email, $telefono, $estudiosMatriculado, (int)$anioCurso, $centro);

        } elseif ($tipo === 'profesor') {
            // Datos específicos de Profesor
            $centroImparte = $_POST['centroImparte'];
            $departamentoAdscrito = $_POST['departamentoAdscrito'];
            $cursoEscolar = $_POST['cursoEscolar'];

            // Validación para Profesor
            if (empty($centroImparte) || empty($departamentoAdscrito) || empty($cursoEscolar)) {
                throw new Exception("Si el tipo es **Profesor**, los campos Centro, Departamento y Curso Escolar son obligatorios.");
            }
            // Validación: Asegurar que los campos de Alumno están vacíos.
            if (!empty($_POST['estudiosMatriculado']) || !empty($_POST['anioCurso']) || !empty($_POST['centro'])) {
                 throw new Exception("Si el tipo es Profesor, los campos específicos del Alumno deben estar vacíos.");
            }

            // Instanciar Profesor
            $objeto = new Profesor($nombreCompleto, $dni, $direccion, $fechaNacimiento, $email, $telefono, $centroImparte, $departamentoAdscrito, $cursoEscolar);

        } else {
            throw new Exception("Debe seleccionar un tipo (Alumno o Profesor).");
        }

        // Mostrar los datos usando el método polimórfico
        $resultado_html = $objeto->MostrarDatos();

    } catch (Exception $e) {
        $mensaje_error = "Error de validación: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>U2_AV_3</title>

    <!-- Le he pedido al Gemini que me lo deje bonito pero simple -->
    <style>
        body { font-family: Arial, sans-serif; }
        .formulario-container { display: flex; gap: 20px; }
        .comunes, .alumno, .profesor { border: 1px solid #ccc; padding: 15px; flex: 1; }
        .error { color: red; font-weight: bold; margin-bottom: 20px; }
        .resultado { margin-top: 30px; border-top: 2px solid #333; padding-top: 20px; }
        label { display: block; margin-top: 10px; }
        input[type="text"], input[type="email"], select, input[type="date"] { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        .campo-opcional { opacity: 0.5; }
    </style>
</head>
<body>

    <h1>Formulario de Registro (Alumno/Profesor)</h1>

    <?php if ($mensaje_error): ?>
        <div class="error"><?php echo $mensaje_error; ?></div>
    <?php endif; ?>


    <!-- Aquí en el formulario vas a ver que dentro de los cuadros a rellenar con información
    tienen un value, esto lo pongo porque si te sale un error se quedan guardados en los campos
    que rellenaste y no tienes que volver a ponerlos (me lo ha dicho la IA) -->

    <form method="POST" action="registrar.php">
        <div class="formulario-container">
            
            <div class="comunes">
                <h3>Datos Comunes</h3>
                
                <label for="tipo">Tipo de Registro</label>
                <select id="tipo" name="tipo" required>
                    <option value="">-- Seleccionar --</option>
                    <option value="alumno" <?php echo (isset($tipo) && $tipo === 'alumno') ? 'selected' : ''; ?>>Alumno</option>
                    <option value="profesor" <?php echo (isset($tipo) && $tipo === 'profesor') ? 'selected' : ''; ?>>Profesor</option>
                </select>

                <label for="nombreCompleto">Nombre Completo</label>
                <input type="text" id="nombreCompleto" name="nombreCompleto" value="<?php echo $_POST['nombreCompleto'] ?? ''; ?>" required>

                <label for="dni">DNI</label>
                <input type="text" id="dni" name="dni" value="<?php echo $_POST['dni'] ?? ''; ?>" required>

                <label for="direccion">Dirección</label>
                <input type="text" id="direccion" name="direccion" value="<?php echo $_POST['direccion'] ?? ''; ?>">

                <label for="fechaNacimiento">Fecha de Nacimiento</label>
                <input type="date" id="fechaNacimiento" name="fechaNacimiento" value="<?php echo $_POST['fechaNacimiento'] ?? ''; ?>">
                
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo $_POST['email'] ?? ''; ?>" required>

                <label for="telefono">Teléfono</label>
                <input type="text" id="telefono" name="telefono" value="<?php echo $_POST['telefono'] ?? ''; ?>">
            </div>

            <div class="alumno">
                <h3>Datos de Alumno</h3>
                <p class="campo-opcional">(Dejar vacíos si es Profesor)</p>
                <label for="estudiosMatriculado">Estudios Matriculado</label>
                <input type="text" id="estudiosMatriculado" name="estudiosMatriculado" value="<?php echo $_POST['estudiosMatriculado'] ?? ''; ?>">

                <label for="anioCurso">Año del Curso</label>
                <input type="text" id="anioCurso" name="anioCurso" value="<?php echo $_POST['anioCurso'] ?? ''; ?>">

                <label for="centro_alumno">Centro</label>
                <input type="text" id="centro_alumno" name="centro" value="<?php echo $_POST['centro'] ?? ''; ?>">
            </div>

            <div class="profesor">
                <h3>Datos de Profesor</h3>
                <p class="campo-opcional">(Dejar vacíos si es Alumno)</p>
                <label for="centroImparte">Centro donde Imparte Clases</label>
                <input type="text" id="centroImparte" name="centroImparte" value="<?php echo $_POST['centroImparte'] ?? ''; ?>">

                <label for="departamentoAdscrito">Departamento Adscrito</label>
                <input type="text" id="departamentoAdscrito" name="departamentoAdscrito" value="<?php echo $_POST['departamentoAdscrito'] ?? ''; ?>">

                <label for="cursoEscolar">Curso Escolar</label>
                <input type="text" id="cursoEscolar" name="cursoEscolar" value="<?php echo $_POST['cursoEscolar'] ?? ''; ?>">
            </div>

        </div>
        <br>
        <button type="submit">Registrar Datos</button>
    </form>

    <?php if ($resultado_html): ?>
        <div class="resultado">
            <?php echo $resultado_html; ?>
        </div>
    <?php endif; ?>

</body>
</html>