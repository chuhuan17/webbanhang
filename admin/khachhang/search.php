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
    <div class="container my-5">
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
                                    <p class="card-text text-danger fw-bold"><?php echo number_format($row['product_price'], 0, ',', '.') . " VND"; ?></p>
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
        <nav aria-label="Page navigation" class="d-flex justify-content-center mt-4">
            <ul class="pagination" id="pagination">
                <!-- Nội dung phân trang -->
            </ul>
        </nav>
    </div>

    <?php
    $stmt->close();
    $conn->close();
    include 'footer.php';
    ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
