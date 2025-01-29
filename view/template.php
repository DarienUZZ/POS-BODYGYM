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
    <link rel="stylesheet" href="view/assets/dist/css/adminlte.min.css">

    <!-- REQUIRED SCRIPTS -->

    <!-- Agregar los estilos y scripts de DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap4.min.css">
    
    <!-- jQuery -->
    <script src="view/assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="view/assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="view/assets/dist/js/adminlte.min.js"></script>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Inludes de navbar y sidebar -->
        <?php
        include "includes/navbar.php";
        include "includes/sidebar.php";
        ?>
        <!-- Inludes de navbar y sidebar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <?php include "view/dashboard.php"; ?>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Inludes footer -->
        <?php
        include "includes/footer.php";
        ?>
        <!-- Inludes footer -->

    </div>

    <script>
        function loadContent(php_page, content) {
            $("." + content).load(php_page, function() {
                // Si la página cargada es el dashboard, carga sus datos
                if (php_page === 'view/dashboard.php') {
                    loadDashboardData();
                } else if (php_page === 'view/addProducts.php') {
                    loadCategories();
                    loadPrices();
                    // Luego agregar el evento del formulario
                    insertProduct();
                } else if (php_page === 'view/products.php') {
                    loadProducts();
                }
            });
        }
    </script>

    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
</body>

</html>