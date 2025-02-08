<div class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Columna pequeña para los catálogos -->
            <div class="col-md-4">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Product Catalog</h3>
                        <!-- <button type="button" class="btn bg-blue float-right mr-3" data-toggle="modal" data-target="#addCategoryProductModal">
                            <i class="fas fa-plus"></i> Add New Category
                        </button> -->
                    </div>
                    <div class="card-body">
                        <table id="productCatalogTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Actions</th>

                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí irían los datos del catálogo de productos -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Price Catalog</h3>

                        <!-- <button type="button" class="btn bg-green float-right mr-3" data-toggle="modal" data-target="#addPriceProductModal">
                            <i class="fas fa-plus"></i> Add New Prices
                        </button> -->
                    </div>
                    <div class="card-body">
                        <table id="priceCatalogTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí irían los datos del catálogo de precios -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Method Payment</h3>

                        <!-- <button type="button" class="btn bg-green float-right mr-3" data-toggle="modal" data-target="#addPriceProductModal">
                            <i class="fas fa-plus"></i> Add New Prices
                        </button> -->
                    </div>
                    <div class="card-body">
                        <table id="methodPaymentCatalogTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Method</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí irían los datos del catálogo de precios -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCategoryProductModalLabel" aria-hidden="true" id="addCategoryProductModal">
    <div class="modal-dialog modal-ml" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                <h4 class="mb-2">Add New Category</h4>
                <p class="text-muted mb-4">Create a new category to organize and classify your products in the catalog.</p>

                <form id="addCategoryProductForm" method="POST">
                    <div class="form-group mb-4">
                        <label class="form-label mb-2" for="CategoryName">Category name</label>
                        <input type="text" class="form-control mb-3" id="addCategoryName" name="addCategoryName" placeholder="Enter category name">
                        <button type="submit" class="btnAddCategory btn btn-primary w-100">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addPriceProductModalLabel" aria-hidden="true" id="addPriceProductModal">
    <div class="modal-dialog modal-ml" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body px-4">
                <h4 class="mb-2">Add New Price</h4>
                <p class="text-muted mb-4">Create a new category to organize and classify your products in the catalog.</p>

                <form id="addPriceProductForm" method="POST">
                    <div class="form-group mb-4">
                        <label class="form-label mb-2" for="PricesName">Category name</label>
                        <input type="number" class="form-control mb-3" id="addPriceProduct" name="addPriceProduct" placeholder="Enter new price">
                        <button type="submit" class="btnAddPriceProduct btn btn-primary w-100">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // Inicializar DataTables
        $('#productCatalogTable').DataTable({
            lengthChange: false,
            info: false,
            language: {
                search: "", // Elimina el texto "Search"
                searchPlaceholder: "Buscar..." // Opcional: Agrega un placeholder
            },

            ajax: {
                url: 'ajax/getCatalogsProducts.php',
                dataSrc: '',

            },
            columns: [{
                    data: 'id_catalago_productos'
                },
                {
                    data: 'descripcion'
                },

                {
                    data: null,
                    render: function(data) {
                        return `
                 <button class="btn btn-sm" (${data.id_catalago_productos})">
                                     <i class="fas fa-edit"></i>
                                 </button>
                                 <button class="btn btn-sm "(${data.id_catalago_productos})">
                                     <i class="fas fa-trash"></i>
                                 </button>
                             `;
                    }
                }
            ],
            responsive: true,
            autoWidth: false,
            pageLength: 7,
            dom: '<"row"<"col-sm-0"f><"col text-right"B>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
            buttons: [{
                text: '<i class="fas fa-plus"></i> Add New Category',
                className: 'btn bg-gray',
                action: function(e, dt, node, config) {
                    $('#addCategoryProductModal').modal('show');
                }
            }]

        });
    });
    $(document).ready(function() {
        // Inicializar DataTables
        $('#priceCatalogTable').DataTable({
            lengthChange: false,
            language: {
                search: "",
                searchPlaceholder: "Buscar..."
            },
            info: false,

            ajax: {
                url: 'ajax/getCatalogsPrice.php',
                dataSrc: '',

            },
            columns: [{
                    data: 'id_catalago_precio'
                },
                {
                    data: 'precio'
                },

                {
                    data: null,
                    render: function(data) {
                        return `
                 <button class="btn btn-sm" (${data.id_catalago_precio})">
                                     <i class="fas fa-edit"></i>
                                 </button>
                                 <button class="btn btn-sm "(${data.id_catalago_precio})">
                                     <i class="fas fa-trash"></i>
                                 </button>
                             `;
                    }
                }
            ],
            responsive: true,
            autoWidth: false,
            pageLength: 7,
            dom: '<"row"<"col-sm-0"f><"col text-right"B>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
            buttons: [{
                text: '<i class="fas fa-plus"></i> Add New Price',
                className: 'btn bg-gray',
                action: function(e, dt, node, config) {
                    $('#addPriceProductModal').modal('show');
                }
            }]
        });
    });
    $(document).ready(function() {
        // Inicializar DataTables
        $('#methodPaymentCatalogTable').DataTable({
            lengthChange: false,
            info: false,
            language: {
                search: "", // Elimina el texto "Search"
                searchPlaceholder: "Buscar..." // Opcional: Agrega un placeholder
            },

            ajax: {
                url: 'ajax/getCategoryPayment.php',
                dataSrc: '',

            },
            columns: [{
                    data: 'id_metodo_pago'
                },
                {
                    data: 'descripcion'
                },

                {
                    data: null,
                    render: function(data) {
                        return `
                 <button class="btn btn-sm" (${data.id_catalago_productos})">
                                     <i class="fas fa-edit"></i>
                                 </button>
                                 <button class="btn btn-sm "(${data.id_catalago_productos})">
                                     <i class="fas fa-trash"></i>
                                 </button>
                             `;
                    }
                }
            ],
            responsive: true,
            autoWidth: false,
            pageLength: 7,
            dom: '<"row"<"col-sm-0"f><"col text-right"B>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
            buttons: [{
                text: '<i class="fas fa-plus"></i> Add New Method',
                className: 'btn bg-gray',
                action: function(e, dt, node, config) {
                    $('#addCategoryProductModal').modal('show');
                }
            }]

        });
    });
    $(document).ready(function() {
        $('.btnAddCategory').on('click', function(e) {
            e.preventDefault();

            const categoryName = $('#addCategoryName').val();

            if (!categoryName) {
                alert('El nombre de la categoría es requerido.');
                return;
            }

            $.ajax({
                url: 'ajax/addCategoryProduct.php',
                method: 'POST',
                data: {
                    categoryName: categoryName
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Categoría agregada correctamente.');
                        $('#addCategoryProductModal').modal('hide'); // Cerrar 
                        $('#addCategoryProductForm')[0].reset(); // Limpiar
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al agregar la categoría:', error);
                    alert('Error al agregar la categoría. Por favor, intenta de nuevo.');
                }
            });
        });
    });
    $(document).ready(function() {
        $('.btnAddPriceProduct').on('click', function(e) {
            e.preventDefault();

            const price = $('#addPriceProduct').val();

            if (!price) {
                alert('El precio es requerido.');
                return;
            }

            $.ajax({
                url: 'ajax/addCategoryPrice.php',
                method: 'POST',
                data: {
                    price: price
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Nuevo Precio agregado correctamente.');
                        $('#addPriceProductModal').modal('hide'); // Cerrar 
                        $('#addPriceProductForm')[0].reset(); // Limpiar
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al agregar el precio:', error);
                    alert('Error al agregar el precio. Por favor, intenta de nuevo.');
                }
            });
        });
    });
</script>