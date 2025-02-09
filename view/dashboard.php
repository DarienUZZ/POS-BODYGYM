<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 id="dailySales"> </h3>

                            <p>Daily Sales</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3 id="dailyEarnings"></h3>

                            <p>Daily Earnings</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3 id="registeredProducts"></h3>

                            <p>Registered products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="/POS-BODYGYM/products" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3 id="lowStockProducts"></h3>

                            <p>Low Stock Products</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="/POS-BODYGYM/inventory" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Productos Más Vendidos</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="topProductsChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Ventas Diarias</h3>
                    </div>
                    <div class="card-body">
                        <canvas id="salesChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->


</div>

<script>
    function loadDashboardData() {
        fetch('ajax/dashboard.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('dailySales').textContent = data.dailySales;
                document.getElementById('registeredProducts').textContent = data.totalProducts;
                document.getElementById('lowStockProducts').textContent = data.lowStockProducts;
            })
            .catch(error => console.error('Error:', error));
    }

    document.addEventListener("DOMContentLoaded", function() {
        loadDashboardData();
    });

    document.addEventListener("DOMContentLoaded", function() {
        fetch('ajax/prueba.php')
            .then(response => response.json())
            .then(data => {
                // Datos de ventas diarias
                const salesChart = new Chart(document.getElementById("salesChart"), {
                    type: "line",
                    data: {
                        labels: ["Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado", "Domingo"], // Días de la semana
                        datasets: [{
                                label: "Card",
                                backgroundColor: "rgba(54, 162, 235, 0.5)",
                                borderColor: "rgba(54, 162, 235, 1)",
                                borderWidth: 1,
                                data: data.card // Datos de pagos con tarjeta
                            },
                            {
                                label: "Sinpe",
                                backgroundColor: "rgba(75, 192, 192, 0.5)",
                                borderColor: "rgba(75, 192, 192, 1)",
                                borderWidth: 1,
                                data: data.sinpe // Datos de pagos con Sinpe
                            },
                            {
                                label: "Cash",
                                backgroundColor: "rgba(255, 206, 86, 0.5)",
                                borderColor: "rgba(255, 206, 86, 1)",
                                borderWidth: 1,
                                data: data.cash // Datos de pagos en efectivo
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Datos de productos más vendidos
                const topProductsChart = new Chart(document.getElementById("topProductsChart"), {
                    type: "bar",
                    data: {
                        labels: data.topProducts.labels, // ["Producto A", "Producto B", ...]
                        datasets: [{
                            label: "Cantidad Vendida",
                            data: data.topProducts.values, // [50, 30, 20, ...]
                            backgroundColor: "rgba(40, 167, 69, 0.5)",
                            borderColor: "rgba(40, 167, 69, 1)",
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error("Error:", error));
    });
</script>