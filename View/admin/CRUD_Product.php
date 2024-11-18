    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Product Management</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
            <i class="bi bi-plus-lg"></i> Add New Product
        </button>
    </div>

    <div class="row mb-3">
        <div class="col-md-3">
            <select class="form-select">
                <option value="">All Categories</option>
                <option value="clothing">Clothing</option>
                <option value="accessories">Accessories</option>
                <option value="footwear">Footwear</option>
            </select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://images.unsplash.com/photo-1521572163474-6864f9cf17ab" class="rounded" width="40" height="40" alt="Product">
                            <span class="ms-2">Basic T-Shirt</span>
                        </div>
                    </td>
                    <td>Clothing</td>
                    <td>$29.99</td>
                    <td>150</td>
                    <td><span class="badge bg-success">In Stock</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil">Delete</i></button>
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash">Edit</i></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://images.unsplash.com/photo-1542272604-787c3835535d" class="rounded" width="40" height="40" alt="Product">
                            <span class="ms-2">Slim Fit Jeans</span>
                        </div>
                    </td>
                    <td>Clothing</td>
                    <td>$59.99</td>
                    <td>80</td>
                    <td><span class="badge bg-success">In Stock</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil">Delete</i></button>
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash">Edit</i></button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="https://images.unsplash.com/photo-1434389677669-e08b4cac3105" class="rounded" width="40" height="40" alt="Product">
                            <span class="ms-2">Summer Dress</span>
                        </div>
                    </td>
                    <td>Clothing</td>
                    <td>$45.99</td>
                    <td>0</td>
                    <td><span class="badge bg-danger">Out of Stock</span></td>
                    <td>
                        <button class="btn btn-sm btn-outline-primary me-1"><i class="bi bi-pencil">Delete</i></button>
                        <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash">Edit</i></button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <nav aria-label="Page navigation" class="mt-4">
        <ul class="pagination justify-content-center">
            <li class="page-item disabled">
                <a class="page-link" href="#">Previous</a>
            </li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
    </main>
    </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Product Name</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select">
                                <option value="clothing">Clothing</option>
                                <option value="accessories">Accessories</option>
                                <option value="footwear">Footwear</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stock Quantity</label>
                            <input type="number" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Product Image</label>
                            <input type="file" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Add Product</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>