<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3 mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title1">Inventory Summary</h5>
                    </div>
                    <div class="card-body" style="max-height: 735px; overflow-y: auto;">
                        <div class="inventorySummaryCards" id="inventorySummaryCards">

                        </div>
                    </div>
                </div>
            </div>

            <div class="col mt-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Inventory details</h5>
                    </div>
                    <div class="card-body">
                        <table id="inventoryTable" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Restock date</th>
                                    <th>Restock time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

<!-- <style>
    #inventoryBody {
        max-height: 620px;
        /* Ajusta esta altura según necesites */
        overflow-y: auto;
        /* Estilos opcionales para mejorar la apariencia del scroll */
        scrollbar-width: thin;
        /* Para Firefox */
        scrollbar-color: #888 #f1f1f1;
        /* Para Firefox */
    }

    /* Estilos para el scrollbar en navegadores WebKit (Chrome, Safari, etc.) */
    #inventoryBody::-webkit-scrollbar {
        width: 6px;
    }

    #inventoryBody::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    #inventoryBody::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 10px;
    }

    #inventoryBody::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    /* Para mantener el espaciado consistente */
    .inventory-summary:last-child {
        margin-bottom: 0 !important;
    }
</style> -->
<div class="modal fade" id="registerStockModal" tabindex="-1" role="dialog" aria-labelledby="registerStockLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerStockLabel">Register stock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registerStockForm" method="POST">
                    <div class="form-group">
                        <label for="product">Product</label>
                        <select class="form-control selectpicker" name="product" id="productSearch" data-live-search="true" data-size="5">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity"></input>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date"></input>
                    </div>
                    <div class="form-group">
                        <label for="time">Time</label>
                        <input type="time" class="form-control" id="time" name="time"></input>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="registerRestockModal" tabindex="-1" role="dialog" aria-labelledby="registerRestockLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="registerRestockLabel">Register Restock</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="registerRestockForm" method="POST">
                    <div class="form-group">
                        <label for="inventorySelect">Inventory Item</label>
                        <select class="form-control selectpicker" name="inventorySelect" id="inventorySelect" data-live-search="true" data-size="5">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="restockQuantity">Quantity</label>
                        <input type="number" class="form-control" id="restockQuantity" name="restockQuantity"></input>
                    </div>
                    <div class="form-group">
                        <label for="restockDate">Date</label>
                        <input type="date" class="form-control" id="restockDate" name="restockDate"></input>
                    </div>
                    <div class="form-group">
                        <label for="restockTime">Time</label>
                        <input type="time" class="form-control" id="restockTime" name="restockTime"></input>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn-Restock btn btn-primary">Restock</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#inventoryTable').DataTable({
            lengthChange: false,
            language: {
                search: "",
                searchPlaceholder: "Search inventory items..."
            },
            ajax: {
                url: "ajax/ajaxInventory/getInventory.php",
                dataSrc: ''
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "product"
                },
                {
                    "data": "quantity"
                },
                {
                    "data": "restock_date"
                },
                {
                    "data": "restock_time"
                },
                {
                    data: null,
                    render: function(data) {
                        return `
                            <button class="btn btn-sm " onclick="deleteInventory(${data.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        `;
                    }
                }
            ],
            responsive: true,
            autoWidth: false,
            dom: '<"row"<"col-sm-0"f><"col text-right"B>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
            buttons: [{
                text: '<i class="fas fa-plus"></i> Register Stock',
                className: 'btn bg-gray',
                action: function(e, dt, node, config) {
                    $('#registerStockModal').modal('show');
                }
            }, {
                text: '<i class="fas fa-plus"></i> Register Restock',
                className: ' ml-3 btn bg-green',
                action: function(e, dt, node, config) {
                    $('#registerRestockModal').modal('show');
                }
            }],
            pageLength: 10,
        });
    });

    $(document).ready(function() {
        // Inicializar Bootstrap Select
        $('#productSearch').selectpicker();

        // Cargar productos cuando se abra el modal
        $('#registerStockModal').on('show.bs.modal', function() {
            $.ajax({
                url: 'ajax/ajaxProduct/searchProducts.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Limpiar opciones anteriores
                    $('#productSearch').empty();

                    // Agregar nuevas opciones
                    data.forEach(function(product) {
                        $('#productSearch').append(
                            $('<option>', {
                                value: product.id_producto,
                                text: product.nombre_producto
                            })
                        );
                    });

                    // Actualizar Bootstrap Select
                    $('#productSearch').selectpicker('refresh');
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar los productos:', error);
                }
            });
        });

        // Limpiar el select cuando se cierre el modal
        $('#registerStockModal').on('hidden.bs.modal', function() {
            $('#productSearch').val(null).selectpicker('refresh');
        });
    });

    $(document).ready(function() {
        $('#registerStockForm').on('submit', function(e) {
            e.preventDefault();

            // Obtener los valores del formulario
            var productId = $('#productSearch').val();
            var quantity = $('#quantity').val();
            var date = $('#date').val();
            var time = $('#time').val();

            // Validar los valores
            if (productId === null || quantity === '' || date === '' || time === '') {
                alert('Todos los campos son obligatorios.');
                return false;
            }

            var formData = {
                productId: productId,
                quantity: quantity,
                date: date,
                time: time
            };

            $.ajax({
                url: 'ajax/ajaxInventory/addInventory.php',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Restock registrado correctamente.');
                        $('#registerStockModal').modal('hide');
                        $('#inventoryTable').DataTable().ajax.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al registrar el restock:', error);
                }
            })

            $('#registerStockForm').on('hiden.bs.modal', function(e) {
                $('#registerStockForm')[0].reset();
            })

        })
    });

    $(document).ready(function() {
        // Cargar items de inventario cuando se abra el modal
        $('#registerRestockModal').on('show.bs.modal', function() {
            $.ajax({
                url: 'ajax/ajaxInventory/getInventory.php',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#inventorySelect').empty();
                    data.forEach(function(item) {
                        $('#inventorySelect').append(
                            $('<option>', {
                                value: item.id,
                                text: `${item.product} (Current: ${item.quantity})`
                            })
                        );
                    });
                    $('#inventorySelect').selectpicker('refresh');
                },
                error: function(xhr, status, error) {
                    console.error('Error al cargar los items de inventario:', error);
                }
            });
        });

        // Manejar el submit del formulario de restock
        $('.btn-Restock').on('click', function(e) {
            e.preventDefault(); // Evitar que el formulario se envíe automáticamente

            var inventoryId = $('#inventorySelect').val();
            var quantity = $('#restockQuantity').val();
            var date = $('#restockDate').val();
            var time = $('#restockTime').val();

            alert(`Data: ${inventoryId}, ${quantity}, ${date}, ${time}`); // Mostrar valores en una alerta

            // Validación básica
            if (!inventoryId || !quantity || !date || !time) {
                alert('Todos los campos son obligatorios.');
                return;
            }

            var formData = {
                id_inventario: inventoryId,
                quantity: quantity,
                date: date,
                time: time
            };

            $.ajax({
                url: 'ajax/inventoryRestock.php',
                method: 'POST',
                data: formData,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert('Restock registrado correctamente.');
                        $('#registerRestockModal').modal('hide');
                        $('#inventoryTable').DataTable().ajax.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error al registrar el restock:', error);
                }
            });
        });


        // Limpiar formulario al cerrar
        $('#registerRestockModal').on('hidden.bs.modal', function() {
            $('#registerRestockForm')[0].reset();
            $('#inventorySelect').selectpicker('refresh');
        });
    });

    function deleteInventory(idInventory) {
        if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
            fetch(`ajax/ajaxInventory/deleteInventory.php?id=${idInventory}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        $('#inventoryTable').DataTable().ajax.reload(); // Recargar la tabla
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al eliminar el registro. Por favor, intenta de nuevo.');
                });
        }
    }

    $(document).ready(function() {
        $.ajax({
            url: "ajax/ajaxInventory/getInventorySummary.php",
            method: "GET",
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    let html = '';
                    response.data.forEach(function(item) { // Accede a response.data
                        html += `
                        <div class="card mb-2">
                            <div class="card-body">
                                <h6 class="card-title">${item.product}</h6>
                                <p class="card-text">Quantity: ${item.total_quantity}</p>
                            </div>
                        </div>
                    `;
                    });
                    $('#inventorySummaryCards').html(html);
                } else {
                    console.error('Error:', response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar el resumen de inventario:', error);
            }
        });
    });
</script>