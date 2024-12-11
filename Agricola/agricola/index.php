<?php
include_once 'config/Database.php';
include_once 'models/Cultivo.php';

$database = new Database();
$db = $database->getConnection();

$cultivo = new Cultivo($db);
$stmt = $cultivo->read();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Producción Agrícola</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Control de Producción Agrícola</h2>
                <a href="crear.php" class="btn btn-primary mb-3">
                    <i class="fas fa-plus-circle"></i> Agregar Cultivo
                </a>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tipo de Cultivo</th>
                                <th>Área Sembrada (ha)</th>
                                <th>Fecha de Siembra</th>
                                <th>Fecha Estimada de Cosecha</th>
                                <th>Insumos Utilizados</th>
                                <th>Responsable</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                extract($row);
                                echo "<tr>
                                    <td>{$id}</td>
                                    <td>{$tipo_cultivo}</td>
                                    <td>{$area_sembrada}</td>
                                    <td>{$fecha_siembra}</td>
                                    <td>{$fecha_cosecha_estimada}</td>
                                    <td>{$insumos_utilizados}</td>
                                    <td>{$responsable}</td>
                                    <td>
                                        <a href='editar.php?id={$id}' class='btn btn-info btn-sm'>
                                            <i class='fas fa-edit'></i> Editar
                                        </a>
                                        <a href='#' onclick='confirmarEliminar({$id})' class='btn btn-danger btn-sm'>
                                            <i class='fas fa-trash-alt'></i> Eliminar
                                        </a>
                                    </td>
                                </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <script>
    function confirmarEliminar(id) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'eliminar.php?id=' + id;
            }
        })
    }
    </script>
    <?php
    if (isset($_GET['mensaje'])) {
        echo "
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '" . $_GET['mensaje'] . "',
            })
        </script>
        ";
    }
    ?>
</body>
</html>

