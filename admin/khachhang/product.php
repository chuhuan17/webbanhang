<?php
include 'header.php';
$db = new Database();
$conn = $db->conn;
$product_id = $_GET['product_id'];
$query_chitiet = "SELECT * FROM products, brands WHERE products.brand_id = brands.brand_id AND products.product_id = '$product_id' LIMIT 1";
$result_chitiet = $db->conn->query($query_chitiet);
if ($result_chitiet->num_rows > 0) {
    while ($chitiet = $result_chitiet->fetch_assoc()) {
?>
        <link rel="stylesheet" href="../styles_product.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


        <style>
            a {
                text-decoration: none;
            }
        </style>
        <div class="product py-5">
            <div class="container">
                <!-- Thanh breadcrumb -->
                <div class="row mb-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                            <li class="breadcrumb-item"><?php echo $chitiet['brand_name']; ?></li>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $chitiet['product_name']; ?></li>
                        </ol>
                    </nav>
                </div>

                <form action="addcart.php?product_id=<?php echo $chitiet['product_id']; ?>" method="post">
                    <div class="row">
                        <!-- Phần hình ảnh sản phẩm -->
                        <div class="col-md-8 d-flex">
                            <!-- Ảnh lớn -->
                            <div class="flex-grow-1 me-3">
                                <img src="../uploads/<?php echo $chitiet['product_image']; ?>"
                                    class="img-fluid  rounded w-100 h-100"
                                    style="object-fit: contain; max-height: 500px;"
                                    alt="Product Image">
                            </div>

                            <!-- Ảnh bổ sung theo chiều dọc -->
                            <div class="d-flex flex-column">
                                <?php
                                $query_images = "SELECT img_url FROM product_img WHERE product_id = '$product_id'";
                                $result_images = $db->conn->query($query_images);

                                if ($result_images->num_rows > 0) {
                                    while ($image = $result_images->fetch_assoc()) {
                                ?>
                                        <img src="../uploads/<?php echo $image['img_url']; ?>"
                                            class="img-thumbnail mb-2"
                                            style="width: 100px; height: 100px; object-fit: cover;"
                                            alt="Product Description Image">
                                <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>


                        <!-- Phần thông tin sản phẩm -->
                        <div class="col-md-4">
                            <!-- Tên sản phẩm -->
                            <h1 class="h4 mb-3"><?php echo htmlspecialchars($chitiet['product_name']); ?></h1>

                            <!-- Giá sản phẩm -->
                            <p class="text-danger fw-bold fs-4">
                                <?php echo number_format($chitiet['product_price'], 0, ',', '.') . " VND"; ?>
                            </p>

                            <!-- Màu sắc -->
                            <div class="mb-3">
                                <p class="mb-1 fw-bold">Màu sắc:</p>
                                <p><?php echo htmlspecialchars($chitiet['product_color_name']); ?></p>
                                <img src="../uploads/<?php echo htmlspecialchars($chitiet['product_color_image']); ?>"
                                    class="img-thumbnail rounded border p-1"
                                    style="max-width: 50px; max-height: 50px;"
                                    alt="Color Image">
                            </div>

                            <!-- Kích thước -->
                            <div class="mb-3">
                                <p class="fw-bold mb-1">Size:</p>
                                <div class="d-flex flex-wrap">
                                    <?php
                                    $query_size = "SELECT * FROM product_sizes WHERE product_id = '$product_id'";
                                    $result_size = $db->conn->query($query_size);
                                    if ($result_size->num_rows > 0) {
                                        while ($product_size = $result_size->fetch_assoc()) {
                                    ?>
                                            <div class="form-check me-3">
                                                <input class="form-check-input" type="radio" name="selected_size" id="size_<?php echo $product_size['size_name']; ?>" value="<?php echo $product_size['size_name']; ?>" required>
                                                <label class="form-check-label" for="size_<?php echo $product_size['size_name']; ?>">
                                                    <?php echo htmlspecialchars($product_size['size_name']); ?>
                                                </label>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <!-- Số lượng -->
                            <div class="mb-3">
                                <label class="form-label">Số lượng:</label>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-outline-secondary minus">-</button>
                                    <input type="number" name="quantity" value="1" min="1" max="99" class="form-control mx-2 text-center" style="width: 70px;">
                                    <button type="button" class="btn btn-outline-secondary plus">+</button>
                                </div>
                                <small class="text-muted mt-2 d-block"><?php echo htmlspecialchars($chitiet['product_quantity']); ?> sản phẩm có sẵn</small>
                            </div>

                            <!-- Các nút hành động -->
                            <div class="d-flex gap-2">
                                <button type="submit" name="addcart" class="btn btn-danger">
                                    <i class="fas fa-shopping-cart me-2"></i>Mua hàng
                                </button>
                                <button type="submit" name="add" class="btn btn-primary">
                                    <i class="fa-solid fa-cart-plus me-2"></i>Thêm vào giỏ hàng
                                </button>
                            </div>

                            <!-- Phần chi tiết sản phẩm -->
                            <!-- Phần chi tiết sản phẩm -->
                            <div class="mb-3">
                                <h5 class="fw-bold">Chi tiết sản phẩm:</h5>
                                <div class="collapse" id="product-details">
                                    <?php echo nl2br(htmlspecialchars($chitiet['product_description'])); ?>
                                </div>
                                <button class="btn btn-link p-0 text-primary" type="button" data-bs-toggle="collapse" data-bs-target="#product-details" aria-expanded="false" aria-controls="product-details" id="toggle-button">
                                    Xem thêm
                                </button>
                            </div>

                            <script>
                                // Khởi tạo đối tượng Collapse của Bootstrap
                                var collapseElement = new bootstrap.Collapse(document.getElementById('product-details'), {
                                    toggle: false // Đảm bảo không tự động mở khi trang tải
                                });

                                var toggleButton = document.getElementById('toggle-button');

                                // Lắng nghe sự kiện Bootstrap để thay đổi văn bản của nút khi mở/thu gọn
                                collapseElement._element.addEventListener('shown.bs.collapse', function() {
                                    toggleButton.textContent = 'Thu gọn';
                                    toggleButton.setAttribute('aria-expanded', 'true');
                                });

                                collapseElement._element.addEventListener('hidden.bs.collapse', function() {
                                    toggleButton.textContent = 'Xem thêm';
                                    toggleButton.setAttribute('aria-expanded', 'false');
                                });
                            </script>



                        </div>
                    </div>
                </form>
                <!-- Hiển thị sản phẩm cùng loại -->
                <div class="related-products py-5">
                    <div class="container">
                        <h2 class="h5 mb-4">Sản phẩm cùng loại</h2>
                        <div class="row">
                            <?php
                            // Truy vấn lấy sản phẩm cùng loại
                            $query_related = "
                                SELECT * 
                                FROM products 
                                WHERE brand_id = '{$chitiet['brand_id']}' 
                                AND product_id != '$product_id'
                                LIMIT 4
                                ";
                            $result_related = $db->conn->query($query_related);

                            if ($result_related->num_rows > 0) {
                                while ($related = $result_related->fetch_assoc()) {
                            ?>
                                    <div class="col-md-3">
                                        <div class="card mb-4 shadow-sm">
                                            <img src="../uploads/<?php echo $related['product_image']; ?>"
                                                class="card-img-top"
                                                alt="Product Image"
                                                style="width: 100%; height: 250px; object-fit: contain;">
                                            <div class="card-body">
                                                <h5 class="card-title h6">
                                                    <a href="productdetail.php?product_id=<?php echo $related['product_id']; ?>" class="text-dark">
                                                        <?php echo htmlspecialchars($related['product_name']); ?>
                                                    </a>
                                                </h5>
                                                <p class="text-danger fw-bold">
                                                    <?php echo number_format($related['product_price'], 0, ',', '.') . " VND"; ?>
                                                </p>
                                                <a href="product.php?product_id=<?php echo $related['product_id']; ?>"
                                                    class="btn btn-primary btn-sm w-100">Xem chi tiết</a>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo '<p class="text-muted">Không có sản phẩm cùng loại.</p>';
                            }
                            ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <script>
            const minusBtn = document.querySelector('.minus');
            const plusBtn = document.querySelector('.plus');
            const quantityInput = document.querySelector('input[name="quantity"]');

            minusBtn.addEventListener('click', () => {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue > 1) {
                    quantityInput.value = currentValue - 1;
                }
            });

            plusBtn.addEventListener('click', () => {
                let currentValue = parseInt(quantityInput.value);
                if (currentValue < 99) {
                    quantityInput.value = currentValue + 1;
                }
            });
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php
    }
}
include 'footer.php';
?>