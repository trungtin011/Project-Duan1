<div class="modal fade" id="discountModal" tabindex="-1" aria-labelledby="discountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="bg-white p-4 modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title text-3xl font-bold" id="discountModalLabel">Bộ lọc</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="product.php" method="get">
                    <!-- Lọc giá -->
                    <div class="filter-section">
                        <p class="text-lg font-semibold text-danger">Tầm giá</p>
                        <input type="number" name="minPrice" class="form-control mb-2" placeholder="Giá thấp nhất"
                            value="<?php echo htmlspecialchars($_GET['minPrice'] ?? ''); ?>">
                        <input type="number" name="maxPrice" class="form-control" placeholder="Giá cao nhất"
                            value="<?php echo htmlspecialchars($_GET['maxPrice'] ?? ''); ?>">
                    </div>

                    <!-- Lọc màu sắc -->
                    <div class="filter-options mt-4">
                        <p class="text-sm">Màu sắc</p>
                        <div class="flex gap-2 mt-2">
                            <input type="checkbox" name="colors[]" value="black"
                                <?php echo (in_array('black', $_GET['colors'] ?? [])) ? 'checked' : ''; ?>> Đen
                            <input type="checkbox" name="colors[]" value="white"
                                <?php echo (in_array('white', $_GET['colors'] ?? [])) ? 'checked' : ''; ?>> Trắng
                            <input type="checkbox" name="colors[]" value="red"
                                <?php echo (in_array('red', $_GET['colors'] ?? [])) ? 'checked' : ''; ?>> Đỏ
                            <input type="checkbox" name="colors[]" value="blue"
                                <?php echo (in_array('blue', $_GET['colors'] ?? [])) ? 'checked' : ''; ?>> Xanh
                        </div>
                    </div>

                    <!-- Lọc kích cỡ -->
                    <div class="filter-section mt-4">
                        <p class="text-sm">Kích cỡ</p>
                        <div class="flex gap-2 mt-2">
                            <input type="checkbox" name="sizes[]" value="S"
                                <?php echo (in_array('S', $_GET['sizes'] ?? [])) ? 'checked' : ''; ?>> S
                            <input type="checkbox" name="sizes[]" value="M"
                                <?php echo (in_array('M', $_GET['sizes'] ?? [])) ? 'checked' : ''; ?>> M
                            <input type="checkbox" name="sizes[]" value="L"
                                <?php echo (in_array('L', $_GET['sizes'] ?? [])) ? 'checked' : ''; ?>> L
                            <input type="checkbox" name="sizes[]" value="XL"
                                <?php echo (in_array('XL', $_GET['sizes'] ?? [])) ? 'checked' : ''; ?>> XL
                        </div>
                    </div>

                    <!-- Lọc loại sản phẩm -->
                    <div class="filter-section mt-4">
                        <p class="text-sm">Loại sản phẩm</p>
                        <div class="form-product flex flex-wrap gap-2">
                            <?php foreach ($categories as $category) { ?>
                                <div class="flex gap-2 items-center">
                                    <input type="checkbox" name="product_types[]"
                                        value="<?php echo $category['category_id']; ?>"
                                        <?php echo (in_array($category['category_id'], $_GET['product_types'] ?? [])) ? 'checked' : ''; ?>>
                                    <label><?php echo htmlspecialchars($category['name']); ?></label>
                                </div>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="modal-footer border-0 flex gap-2 mt-4">
                        <button type="reset" class="bg-gray-200 px-4 py-3 text-md font-semibold w-50 text-gray-500">Xóa
                            tất cả</button>
                        <button type="submit" class="bg-black text-light px-4 py-3 text-md font-semibold w-50">Hoàn
                            tất</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>