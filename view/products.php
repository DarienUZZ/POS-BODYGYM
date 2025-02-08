<div class="content">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <h3 class="card-title">Products List</h3>
                    </div>
                    <div class="card-body">
                        <table id="productsTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Aquí irían los datos de la tabla de productos -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-ml" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addProductForm" method="POST">
                    <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" class="form-control" id="productName" name="productName" required>
                    </div>

                    <div class="form-group">
                        <label for="productCategory">Category</label>
                        <select class="form-control" id="productCategory" name="productCategory" required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="productPrice">Price</label>
                        <select class="form-control" id="productPrice" name="productPrice" required>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="productDescription">Description</label>
                        <textarea class="form-control" id="productDescription" name="productDescription" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="addProductForm" class="btn btn-primary">Add Product</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel" aria-hidden="true" id="editProductModal">
    <div class="modal-dialog modal-ml" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModal">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editProductForm" method="POST">
                    <input type="hidden" id="editProductId" name="productId">
                    <div class="form-group">
                        <label for="editProductName">Product Name</label>
                        <input type="text" class="form-control" id="editProductName" name="productName">
                    </div>

                    <div class="form-group">
                        <label for="editProductCategory">Category</label>
                        <select class="form-control" id="editProductCategory" name="productCategory">
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editProductPrice">Price</label>
                        <select class="form-control" id="editProductPrice" name="productPrice">
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="editProductDescription">Description</label>
                        <textarea class="form-control" id="editProductDescription" name="productDescription" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="editProductStatus">Status</label>
                        <select class="form-control" id="editProductStatus" name="productStatus">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" form="editProductForm" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>



<script>
    $(document).ready(function() {
        // Inicializar DataTables
        $('#productsTable').DataTable({
            lengthChange: false,
            info: false,
            ajax: {
                url: 'ajax/getProducts.php',
                dataSrc: '',

            },
            columns: [{
                    data: 'id_producto'
                },
                {
                    data: 'nombre_producto'
                },
                {
                    data: 'categoria'
                },
                {
                    data: 'precio'
                },
                {
                    data: 'descripcion'
                },
                {
                    data: 'activo',
                    render: function(data) {
                        return data == 1 ?
                            '<span class="badge badge-success">Active</span>' :
                            '<span class="badge badge-danger">Inactive</span>';
                    }
                },
                {
                    data: null,
                    render: function(data) {
                        return `
            <button class="btn btn-sm" onclick="openEditModal(${data.id_producto})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="btn btn-sm " onclick="deleteProduct(${data.id_producto})">
                                <i class="fas fa-trash"></i>
                            </button>
                        `;
                    }
                }
            ],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function(row) {
                            var data = row.data();
                            return 'Inventory details'
                        }
                    }),
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: 'table'
                    })
                }
            },
            autoWidth: false,
            language: {
                search: "",
                searchPlaceholder: "Search products...",
                paginate: {
                    first: 'First',
                    last: 'Last',
                    next: '<i class="fas fa-angle-right"></i>',
                    previous: '<i class="fas fa-angle-left"></i'
                }
            },
            dom: '<"row"<"col-sm-0"f><"col text-right"B>><"row"<"col-sm-12"tr>><"row"<"col-sm-5"i><"col-sm-7"p>>',
            buttons: [{
                text: '<i class="fas fa-plus"></i> Add New Category',
                className: 'btn bg-blue',
                action: function(e, dt, node, config) {
                    $('#addProductModal').modal('show');
                }
            }],
            pageLength: 10, // Default number of entries
        });
    });

    $(document).ready(function() {

        $('#addProductModal').on('show.bs.modal', function() {
            loadCategories();
            loadPrices();
        });

        insertProduct();
    });

    function loadCategories() {
        fetch('ajax/getCatalogsProducts.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('La respuesta de red no fue correcta');
                }
                return response.json();
            })
            .then(data => {
                const select = document.getElementById('productCategory');
                select.innerHTML = '';

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Select a category';
                select.appendChild(defaultOption);

                data.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id_catalago_productos;
                    option.textContent = category.descripcion;
                    select.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error loading categories:', error);
                alert('Error al cargar las categorías. Por favor, intenta de nuevo.');
            });
    }

    function loadPrices() {
        fetch('ajax/getCatalogsPrice.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('La respuesta de red no fue correcta');
                }
                return response.json();
            })
            .then(data => {
                const select = document.getElementById('productPrice');
                select.innerHTML = '';

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Selecciona un precio';
                select.appendChild(defaultOption);

                data.forEach(price => {
                    const option = document.createElement('option');
                    option.value = price.id_catalago_precio;
                    option.textContent = price.precio;
                    select.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error al cargar categorías:', error);
                alert('Error, try again');
            });
    }

    function loadCategories2(selectId = 'productCategory', selectedValue = null) {
        fetch('ajax/getCatalogsProducts.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('La respuesta de red no fue correcta');
                }
                return response.json();
            })
            .then(data => {
                const select = document.getElementById(selectId);
                select.innerHTML = '';

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Select a category';
                select.appendChild(defaultOption);

                data.forEach(category => {
                    const option = document.createElement('option');
                    option.value = category.id_catalago_productos;
                    option.textContent = category.descripcion;
                    if (selectedValue && category.id_catalago_productos == selectedValue) {
                        option.selected = true;
                    }
                    select.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error loading categories:', error);
                alert('Error al cargar las categorías. Por favor, intenta de nuevo.');
            });
    }

    function loadPrices2(selectId = 'productPrice', selectedValue = null) {
        fetch('ajax/getCatalogsPrice.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('La respuesta de red no fue correcta');
                }
                return response.json();
            })
            .then(data => {
                const select = document.getElementById(selectId);
                select.innerHTML = '';

                const defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Selecciona un precio';
                select.appendChild(defaultOption);

                data.forEach(price => {
                    const option = document.createElement('option');
                    option.value = price.id_catalago_precio;
                    option.textContent = price.precio;
                    if (selectedValue && price.id_catalago_precio == selectedValue) {
                        option.selected = true;
                    }
                    select.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Error al cargar precios:', error);
                alert('Error, try again');
            });
    }

    function insertProduct() {
        document.getElementById('addProductForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('ajax/addProducts.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('La respuesta de red no fue correcta');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        this.reset();
                        $('#addProductModal').modal('hide'); // Cerrar el modal
                        $('#productsTable').DataTable().ajax.reload(); // Recargar la tabla de productos
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al guardar el producto. Por favor, intenta de nuevo.');
                });
        });
    }

    // Función para abrir el modal de edición y cargar los datos del producto
    function openEditModal(productId) {

        fetch(`ajax/getProductById.php?id=${productId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('La respuesta de red no fue correcta');
                }
                return response.json();
            })
            .then(data => {
                // Llenar el formulario con los datos del producto
                document.getElementById('editProductId').value = data.id_producto;
                document.getElementById('editProductName').value = data.nombre_producto;
                document.getElementById('editProductDescription').value = data.descripcion;
                document.getElementById('editProductStatus').value = data.activo;

                // Cargar categorías y precios
                loadCategories2('editProductCategory', data.catalago_productos);
                loadPrices2('editProductPrice', data.catalago_precio);

                // Abrir el modal
                $('#editProductModal').modal('show');
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error al cargar los datos del producto. Por favor, intenta de nuevo.');
            });
    }

    // Función para enviar los datos actualizados
    function updateProduct() {
        document.getElementById('editProductForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const formData = new FormData(this);

            fetch('ajax/updateProducts.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('La respuesta de red no fue correcta');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        $('#editProductModal').modal('hide'); // Cerrar el modal
                        $('#productsTable').DataTable().ajax.reload(); // Recargar la tabla de productos

                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al actualizar el producto. Por favor, intenta de nuevo.');
                });
        });
    }

    function deleteProduct(productId) {
        if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
            fetch(`ajax/deleteProduct.php?id=${productId}`, {
                    method: 'DELETE'
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('La respuesta de red no fue correcta');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        $('#productsTable').DataTable().ajax.reload(); // Recargar la tabla de productos
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error al eliminar el producto. Por favor, intenta de nuevo.');
                });
        }
    }

    $(document).ready(function() {
        updateProduct();
    });
</script>