<?php
include 'header.php';
$db = new Database();
$conn = $db->conn;
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center my-4">Hàng mới về</h1>
            <div class="row" id = "Table">
                <?php
                // Truy vấn dữ liệu sản phẩm
                $query = "SELECT products.*, brands.brand_name 
                          FROM products 
                          INNER JOIN brands ON products.brand_id = brands.brand_id 
                          ORDER BY products.product_id";

                $stmt = $conn->prepare($query); // Chuẩn bị câu truy vấn

                if ($stmt->execute()) { // Thực thi câu truy vấn
                    $result = $stmt->get_result(); // Lấy kết quả

                    if ($result && $result->num_rows > 0) {
                        // Hiển thị thông tin sản phẩm
                        while ($product = $result->fetch_assoc()) {
                ?>
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="card">
                                    <img src="../uploads/<?php echo htmlspecialchars($product['product_image']); ?>" class="card-img-top" alt="Product Image">
                                    <div class="card-body text-center">
                                        <h5 class="card-title"><?php echo htmlspecialchars($product['product_name']); ?></h5>
                                        <p class="card-text text-success fw-bold"><?php echo number_format($product['product_price'], 0, ',', '.'); ?> VND</p>
                                        <a href="product.php?product_id=<?php echo $product['product_id']; ?>" class="btn btn-primary">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    } else {
                        echo "<div class='col-12'><p class='text-center'>Không có sản phẩm nào</p></div>";
                    }
                } else {
                    echo "<div class='col-12'><p class='text-center text-danger'>Lỗi truy vấn dữ liệu</p></div>";
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 text-center">
            <nav>
                <ul class="pagination justify-content-center" id="pagination"></ul>
            </nav>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
<script src="../js/pagination.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>