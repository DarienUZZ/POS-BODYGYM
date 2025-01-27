        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index3.html" class="brand-link">
                <img src="view/assets/dist/img/logo-body-gym.png" alt="logo-body-gym" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Body Gym Jaco</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link active" onclick="loadContent('view/dashboard.php', 'content-wrapper')">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Dashboard
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link ">
                                <i class="nav-icon fas fa-box-open"></i>
                                <p>
                                    Products
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a style="cursor: pointer;" class="nav-link" onclick="loadContent('view/products.php', 'content-wrapper')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Inventory</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a style="cursor: pointer;" class="nav-link" onclick="loadContent('view/addProducts.php', 'content-wrapper')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Add Products</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a style="cursor: pointer;" class="nav-link" onclick="loadContent('view/categories.php', 'content-wrapper')">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Categories</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" onclick="loadContent('view/sales.php', 'content-wrapper')">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Sales
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" onclick="loadContent('view/purchases.php', 'content-wrapper')">
                                <i class="nav-icon fas fa-th"></i>
                                <p>
                                    Purchases
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" onclick="loadContent('view/reports.php', 'content-wrapper')">
                                <i class="nav-icon fas fa-chart-bar"></i>
                                <p>
                                    Reports
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a style="cursor: pointer;" class="nav-link" onclick="loadContent('view/settings.php', 'content-wrapper')">
                                <i class="nav-icon fas fa-cogs"></i>
                                <p>
                                    Settings
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <script>
            $(".nav-link").on('click', function() {
                $(".nav-link").removeClass('active');
                $(this).addClass('active');
            })
        </script>