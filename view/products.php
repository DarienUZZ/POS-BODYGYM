<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Inventory</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Products / Inventory</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-12">
                <button type="button" class="btn btn-primary float-right" onclick="loadContent('view/addProducts.php', 'content-wrapper')">
                    <i class="fas fa-plus"></i> Add New Product
                </button>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Products List</h3>
                    </div>
                    <div class="card-body">
                        <table id="productsTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Actions</th>
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



<script>
    function loadProducts() {
        const table = $('#productsTable').DataTable({
            ajax: {
                url: 'ajax/getProducts.php',
                dataSrc: ''
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
                        <button class="btn btn-sm btn-warning" onclick="editProduct(${data.id_producto})">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="deleteProduct(${data.id_producto})">
                            <i class="fas fa-trash"></i>
                        </button>
                    `;
                    }
                }
            ],
            responsive: true,
            autoWidth: false
        });
    }

    // function editProduct(id) {
    //     // Implementar la edición
    //     console.log('Editing product:', id);
    // }

    // function deleteProduct(id) {
    //     if (confirm('¿Estás seguro de que deseas eliminar este producto?')) {
    //         fetch(`ajax/deleteProduct.php?id=${id}`, {
    //                 method: 'DELETE'
    //             })
    //             .then(response => response.json())
    //             .then(data => {
    //                 if (data.success) {
    //                     $('#productsTable').DataTable().ajax.reload();
    //                     alert('Producto eliminado exitosamente');
    //                 } else {
    //                     alert(data.message);
    //                 }
    //             })
    //             .catch(error => {
    //                 console.error('Error:', error);
    //                 alert('Error al eliminar el producto');
    //             });
    //     }
    // }
</script>