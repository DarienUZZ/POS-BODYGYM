<?php
require_once "controller/pagesController.php";
session_start();

// Verificar sesión
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: view/login.php');
    exit();
}

// Manejo de rutas
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Instanciar el controlador una sola vez
$controller = new PagesController();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Point of sale</title>

    <link rel="shortcut icon" href="view/assets/dist/img/logo-body-gym.png" type="image/x-icon">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="view/assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="view/assets/dist/css/template.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">

    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css">

    <!-- jQuery -->
    <script src="view/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="view/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="view/assets/dist/js/adminlte.min.js"></script>
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Includes de navbar y sidebar -->
        <?php
        include "view/includes/navbar.php";
        include "view/includes/sidebar.php";
        ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            <?php
            // Router básico
            switch ($uri) {
                case '/POS-BODYGYM/':
                    $controller->index();
                    break;
                case '/POS-BODYGYM/products':
                    $controller->products();
                    break;
                case '/POS-BODYGYM/inventory':
                    $controller->inventory();
                    break;
                case '/POS-BODYGYM/categories':
                    $controller->categories();
                    break;
                case '/POS-BODYGYM/prices':
                    $controller->prices();
                    break;
                case '/POS-BODYGYM/sales':
                    $controller->sales();
                    break;
                case '/POS-BODYGYM/users':
                    $controller->users();
                    break;
                case '/POS-BODYGYM/logout':
                    $controller->logout();
                    break;
                default:
                    $controller->error404();
                    break;
            }
            ?>

        </div>

        <!-- Footer -->
        <?php include "view/includes/footer.php"; ?>
    </div>
    <!-- DataTables Scripts -->
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js"></script>
    <!-- DataTables Buttons JS -->
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>

</html>