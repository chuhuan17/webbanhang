<?php
include 'header.php';
$db = new Database();
$conn = $db->conn;

// Kiểm tra nếu người dùng đã nhấn nút tìm kiếm
$keyword = '';
if (isset($_POST['search'])) {
    $keyword = $_POST['keyword'];
}

// Câu truy vấn tìm kiếm sản phẩm dựa trên từ khóa
$sql = "SELECT * FROM products WHERE product_name LIKE ? ORDER BY product_id DESC";
$stmt = $conn->prepare($sql);
$searchKeyword = "%" . $keyword . "%";
$stmt->bind_param("s", $searchKeyword);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="container">
    <div class="row">
        <div class="category-right row">
            <div class="category-right-top-item">
                <p style="font-family: 'Arial', sans-serif;">Kết quả tìm kiếm cho từ khóa: <?php echo htmlspecialchars($keyword); ?></p>
                <div id="Table" class="category-right-content-item">
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                        <div class="product-item">
                            <form method="post" action="cart.php?action=add&id=<?php echo $row["product_id"]; ?>">
                                <div class="product-image">
                                    <a href="product.php?product_id=<?php echo $row['product_id']; ?>" style="text-decoration: none; color: inherit;">
                                        <img src="../uploads/<?php echo htmlspecialchars($row['product_image']); ?>" alt="Product Image" class="img-fluid">
                                        <h2><?php echo htmlspecialchars($row['product_name']); ?></h2>
                                        <p><?php echo number_format($row['product_price'], 0, ',', '.') . " VND"; ?></p>
                                    </a>
                                </div>
                            </form>
                        </div>
                    <?php
                        }
                    } else {
                        echo "<p>Không tìm thấy sản phẩm nào.</p>";
                    }
                    ?>
                </div>
            </div>

            <div class="pagination-container" style="display: flex; justify-content: center;">
                <div class="pagination" id="pagination" style="align-self: center;">
                    <!-- Phần phân trang sẽ hiển thị ở đây -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$stmt->close();
$conn->close();
include 'footer.php';
?>
<script src="../js/pagination.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
