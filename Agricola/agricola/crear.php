<?php
if ($_POST) {
    include_once 'config/Database.php';
    include_once 'models/Cultivo.php';

    $database = new Database();
    $db = $database->getConnection();

    $cultivo = new Cultivo($db);

    $cultivo->tipo_cultivo = $_POST['tipo_cultivo'];
    $cultivo->area_sembrada = $_POST['area_sembrada'];
    $cultivo->fecha_siembra = $_POST['fecha_siembra'];
    $cultivo->fecha_cosecha_estimada = $_POST['fecha_cosecha_estimada'];
    $cultivo->insumos_utilizados = $_POST['insumos_utilizados'];
    $cultivo->responsable = $_POST['responsable'];

    if ($cultivo->create()) {
        header("Location: index.php?mensaje=Cultivo registrado exitosamente");
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudo registrar el cultivo.',
            })
        </script>
        ";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Cultivo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Registrar Cultivo</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="mb-3">
                        <label for="tipo_cultivo" class="form-label">Tipo de Cultivo</label>
                        <input type="text" class="form-control" id="tipo_cultivo" name="tipo_cultivo" required>
                    </div>
                    <div class="mb-3">
                        <label for="area_sembrada" class="form-label">Área Sembrada (ha)</label>
                        <input type="number" step="0.01" class="form-control" id="area_sembrada" name="area_sembrada" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_siembra" class="form-label">Fecha de Siembra</label>
                        <input type="date" class="form-control" id="fecha_siembra" name="fecha_siembra" required>
                    </div>
                    <div class="mb-3">
                        <label for="fecha_cosecha_estimada" class="form-label">Fecha Estimada de Cosecha</label>
                        <input type="date" class="form-control" id="fecha_cosecha_estimada" name="fecha_cosecha_estimada" required>
                    </div>
                    <div class="mb-3">
                        <label for="insumos_utilizados" class="form-label">Insumos Utilizados</label>
                        <textarea class="form-control" id="insumos_utilizados" name="insumos_utilizados" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="responsable" class="form-label">Responsable</label>
                        <input type="text" class="form-control" id="responsable" name="responsable" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Registrar
                    </button>
                    <a href="index.php" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
</body>
</html>

