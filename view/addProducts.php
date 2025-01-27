            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Add Products</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Products / Add Products</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Product Information</h3>
                                </div>
                                <form id="addProductForm">
                                    <div class="card-body">
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
                                    </div>

                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary">Add Product</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </div>


            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    loadCategories();
                });

                function loadCategories() {
                    fetch('ajax/getCategories.php')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('La respuesta de red no fue correcta');
                            }
                            return response.json();
                        })
                        .then(data => {
                            const select = document.getElementById('productCategory');
                            // Limpiar opciones existentes
                            select.innerHTML = '';

                            // Agregar una opción por defecto
                            const defaultOption = document.createElement('option');
                            defaultOption.value = '';
                            defaultOption.textContent = 'Selecciona una categoría';
                            select.appendChild(defaultOption);

                            // Agregar categorías
                            data.forEach(category => {
                                const option = document.createElement('option');
                                option.value = category.id_catalago_productos;
                                option.textContent = category.descripcion;
                                select.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error al cargar categorías:', error);
                            alert('Error al cargar las categorías. Por favor, intenta de nuevo.');
                        });
                }

                function loadPrices() {
                    fetch('ajax/getCategoriePrice.php')
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('La respuesta de red no fue correcta');
                            }
                            return response.json();
                        })
                        .then(data => {
                            const select = document.getElementById('productPrice');
                            // Limpiar opciones existentes
                            select.innerHTML = '';

                            // Agregar una opción por defecto
                            const defaultOption = document.createElement('option');
                            defaultOption.value = '';
                            defaultOption.textContent = 'Selecciona un precio';
                            select.appendChild(defaultOption);

                            // Agregar categorías
                            data.forEach(price => {
                                const option = document.createElement('option');
                                option.value = price.id_catalago_precio;
                                option.textContent = price.precio;
                                select.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error al cargar categorías:', error);
                            alert('Error al cargar las categorías. Por favor, intenta de nuevo.');
                        });
                }
            </script>