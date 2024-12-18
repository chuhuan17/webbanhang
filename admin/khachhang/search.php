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
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kết quả tìm kiếm</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-5" id="Table">
        <h2 class="text-center mb-4">Kết quả tìm kiếm cho từ khóa: "<?php echo htmlspecialchars($keyword); ?>"</h2>

        <div class="row row-cols-1 row-cols-md-4 g-4">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
            ?>
                    <div class="col">
                        <div class="card h-100">
                            <a href="product.php?product_id=<?php echo $row['product_id']; ?>" class="text-decoration-none text-dark">
                                <img src="../uploads/<?php echo htmlspecialchars($row['product_image']); ?>" class="card-img-top img-fluid" alt="Product Image">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row['product_name']); ?></h5>
                                    <span style="text-decoration: line-through; color: black; font-weight: bold;">
                                        <?php echo number_format($row['product_price'], 0, ',', '.') . ' VND'; ?>
                                    </span><br>
                                    <span style="font-weight: bold; font-size: 1.2em; color: #f2231d;">
                                        <?php echo number_format($row['price_sale'], 0, ',', '.') . ' VND'; ?>
                                    </span>
                                    <br>
                                    <small style="color: green; font-weight: bold;">
                                        Giảm <?php echo $row['product_sale']; ?>%
                                    </small>
                                    <br>
                                    <a href="product.php?product_id=<?php echo $row['product_id']; ?>" class="btn btn-primary">Xem chi tiết</a>
                                </div>
                            </a>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<p class='text-center text-muted'>Không tìm thấy sản phẩm nào.</p>";
            }
            ?>
        </div>

        <!-- Pagination placeholder -->
        <div class="row">
            <nav>
                <ul class="pagination justify-content-center" id="pagination"></ul>
            </nav>
        </div>
    </div>

    <?php
    $stmt->close();
    $conn->close();
    include 'footer.php';
    ?>
    <script src="../js/paginationadmin.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>