<?php
include 'header.php';
$db = new Database();
$conn = $db->conn;
?>
<div class="container">
    <div class="row">
        <div class="category-right row">
            <div class="category-right-top-item">
                <h1>Hàng mới về</h1>
                <!-- <select name="" id="">
                    <option value="">Sắp xếp</option>
                    <option value="low-to-high">Giá thấp đến cao</option>
                    <option value="high-to-low">Giá cao đến thấp</option>
                </select> -->
                <div id="Table" class="category-right-content-item">

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
                                <a href="product.php?product_id=<?php echo $product['product_id']; ?>" style="text-decoration: none; color: inherit;">
                                    <img src="../uploads/<?php echo htmlspecialchars($product['product_image']); ?>" alt="Product Image">
                                    <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
                                    <p><?php echo number_format($product['product_price'], 0, ',', '.') . " VND"; ?></p>
                                </a>
                    <?php
                            }
                        } else {
                            echo "<p>Không có sản phẩm nào</p>";
                        }
                    } else {
                        echo "<p>Lỗi truy vấn dữ liệu</p>";
                    }
                    ?>
                </div>
            </div>
            <div class="pagination-container" style="display: flex; justify-content: center;">
                <div class="pagination" id="pagination" style="align-self: center;">
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>
<script src="../js/pagination.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>