<?php
require_once '../Model/DBUntil.php';

if (isset($_POST['submit'])) {
    $db = new DBUntil();
    $data = [
        'code' => $_POST['code'],
        'discount' => $_POST['discount'],
        'start_date' => $_POST['start_date'],
        'end_date' => $_POST['end_date'],
        'description' => $_POST['description']
    ];
    $lastInsertId = $db->insert('promotions', $data);
    if ($lastInsertId) {
        echo "
            <script>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Thêm khuyến mãi thành công',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true
                });
                setTimeout(function() {
                    window.location.href = 'admin_dashboard.php?action=admin_coupon';
                }, 1500);
            </script>
        ";
    } else {
        echo "
            <script>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Thêm khuyến mãi không thành công',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true
                });
                setTimeout(function() {
                    window.location.href = 'admin_dashboard.php?action=admin_coupon';
                }, 1500);
            </script>
        ";
    }
}

$db = new DBUntil();
$sql = "SELECT * FROM promotions";
$promotions = $db->select($sql);

if (isset($_GET['edit'])) {
    $promotion_id = $_GET['edit'];
    $db = new DBUntil();
    $sql = "SELECT * FROM promotions WHERE promotion_id = :promotion_id";
    $params = [':promotion_id' => $promotion_id];
    $promotion = $db->select($sql, $params);
    if ($promotion) {
        $promotion = $promotion[0];
    }
}

if (isset($_POST['update'])) {
    $promotion_id = $_POST['promotion_id'];
    $data = [
        'code' => $_POST['code'],
        'discount' => $_POST['discount'],
        'start_date' => $_POST['start_date'],
        'end_date' => $_POST['end_date'],
        'description' => $_POST['description']
    ];

    $condition = "promotion_id = :promotion_id";
    $conditionParams = [':promotion_id' => $promotion_id];

    $updateCount = $db->update('promotions', $data, $condition, $conditionParams);

    if ($updateCount > 0) {
        echo "
            <script>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Cập nhật mã khuyến mãi thành công',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = 'admin_dashboard.php?action=admin_coupon';
                });
            </script>
        ";
    } else {
        echo "
            <script>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: 'Cập nhật mã khuyến mãi không thành công',
                    showConfirmButton: false,
                    timer: 1500
                });
            </script>
        ";
    }
}

?>


<div class="">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <span class="h2">Mã khuyến mãi</span>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPromotionModal">
            <i class="fa fa-plus-circle"></i> Thêm mã khuyến mãi
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead class="table-dark">
                <tr class="text-center align-middle">
                    <th>#</th>
                    <th>Mã</th>
                    <th>Giảm giá (%)</th>
                    <th>Ngày bắt đầu</th>
                    <th>Ngày kết thúc</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody class="table-group-divider text-center">
                <?php if (!empty($promotions)): ?>
                    <?php foreach ($promotions as $index => $promo): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $promo['code']; ?></td>
                            <td><?php echo $promo['discount']; ?></td>
                            <td><?php echo $promo['start_date']; ?></td>
                            <td><?php echo $promo['end_date']; ?></td>
                            <td class="w-25"><?php echo $promo['description']; ?></td>
                            <td>
                                <!-- Nút Sửa -->
                                <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editCouponModal_<?= $promo['promotion_id'] ?>">
                                    <i class="fa fa-pencil-square"></i> Sửa
                                </button>
                                <!-- Nút Xóa -->
                                <a href="#" class="btn btn-danger delete-coupon" data-coupon-id="<?= $promo['promotion_id'] ?>">
                                    <i class="fa fa-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>

                        <!-- Modal Sửa Mã Khuyến Mãi -->
                        <div class="modal fade" id="editCouponModal_<?= $promo['promotion_id'] ?>" tabindex="-1" aria-labelledby="editCouponModalLabel_<?= $promo['promotion_id'] ?>" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header border-0 bg-red-600 text-white">
                                        <h5 class="modal-title h5" id="editCouponModalLabel_<?= $promo['promotion_id'] ?>">Sửa mã khuyến mãi</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="admin_dashboard.php?action=admin_coupon">
                                        <input type="hidden" name="promotion_id" value="<?= $promo['promotion_id'] ?>">
                                        <div class="p-3 py-4 bg-white text-dark">
                                            <label class="form-label" for="code">Mã khuyến mãi:</label>
                                            <input class="form-control" type="text" name="code" value="<?= $promo['code'] ?>" required>

                                            <label class="form-label" for="discount">Giảm giá (%):</label>
                                            <input class="form-control" type="number" name="discount" value="<?= $promo['discount'] ?>" required>

                                            <label class="form-label" for="start_date">Ngày bắt đầu:</label>
                                            <input class="form-control" type="date" name="start_date" value="<?= $promo['start_date'] ?>" required>

                                            <label class="form-label" for="end_date">Ngày kết thúc:</label>
                                            <input class="form-control" type="date" name="end_date" value="<?= $promo['end_date'] ?>" required>

                                            <label class="form-label" for="description">Mô tả:</label>
                                            <textarea class="form-control" name="description" required><?= $promo['description'] ?></textarea>
                                            
                                            <button type="submit" name="update" class="btn btn-primary mt-4 w-full font-bold">Cập nhật</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Không có mã khuyến mãi nào.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="addPromotionModal" tabindex="-1" aria-labelledby="addPromotionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0 bg-red-600 text-white">
                <h5 class="modal-title h5" id="addPromotionModalLabel">Thêm mã khuyến mãi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST" class="p-3 py-4 bg-white text-dark">
                <div class="form-group">
                    <label class="form-label" for="code">Mã khuyến mãi:</label>
                    <input class="form-control" type="text" id="code" name="code" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="discount">Giảm giá (%):</label>
                    <input class="form-control" type="number" id="discount" name="discount" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="start_date">Ngày bắt đầu:</label>
                    <input class="form-control" type="date" id="start_date" name="start_date" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="end_date">Ngày kết thúc:</label>
                    <input class="form-control" type="date" id="end_date" name="end_date" required>
                </div>

                <div class="form-group">
                    <label class="form-label" for="description">Mô tả:</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>

                <button type="submit" name="submit" class="btn btn-warning mt-4 w-full font-bold">Thêm</button>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-coupon');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const couponId = this.getAttribute('data-coupon-id');

                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: "Mã khuyến mãi này sẽ bị xóa vĩnh viễn!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Đồng ý xóa',
                    cancelButtonText: 'Hủy bỏ'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`./function-CRUD/Delete_Coupon.php?id=${couponId}`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error(`HTTP error! Status: ${response.status}`);
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data.success) {
                                    Swal.fire({
                                        toast: true,
                                        position: "top-end",
                                        icon: "success",
                                        title: data.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    }).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire({
                                        toast: true,
                                        position: "top-end",
                                        icon: "error",
                                        text: data.message,
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                }
                            })
                            .catch(error => {
                                console.error('Lỗi:', error);
                                Swal.fire({
                                    toast: true,
                                    position: "top-end",
                                    text: 'Không thể xóa mã khuyến mãi. Vui lòng thử lại.',
                                    icon: 'error',
                                    showConfirmButton: false
                                });
                            });
                    }
                });
            });
        });
    });
</script>