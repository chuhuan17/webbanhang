<?php
include 'header.php';
$db = new Database();
$conn = $db->conn;
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center my-4">Hàng mới về</h1>
            <div class="filter-section text-center my-4">
                <label for="priceFilter" class="mr-2">Lọc theo giá:</label>
                <select id="priceFilter" class="form-control d-inline-block w-auto">
                    <option value="all">Tất cả</option>
                    <option value="0-100000">Dưới 100.000 VND</option>
                    <option value="100000-500000">100.000 - 500.000 VND</option>
                    <option value="500000-1000000">500.000 - 1.000.000 VND</option>
                    <option value="1000000-">Trên 1.000.000 VND</option>
                </select>
            </div>

            <div class="row" id="Table">
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
                                    <span style="text-decoration: line-through; color: black; font-weight: bold;">
                                        <?php echo number_format($product['product_price'], 0, ',', '.') . ' VND'; ?>
                                    </span><br>
                                    <span style="font-weight: bold; font-size: 1.2em; color: #f2231d;">
                                        <?php echo number_format($product['price_sale'], 0, ',', '.') . ' VND'; ?>
                                    </span>
                                    <br>
                                    <small style="color: green; font-weight: bold;">
                                        Giảm <?php echo $product['product_sale']; ?>%
                                    </small>
                                    <br>
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
        <nav>
            <ul class="pagination justify-content-center" id="pagination"></ul>
        </nav>
    </div>
</div>

<?php
include 'footer.php';
?>
<script src="../js/pagination.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
