<?php
include 'header.php'; // Include tệp header (giả sử kết nối CSDL có trong đây)

if (isset($_GET['brand_id'])) {
    $brand_id = $_GET['brand_id'];

    // Truy vấn danh sách sản phẩm dựa trên brand_id
    $query = "SELECT * FROM products WHERE brand_id = $brand_id";
    $result = $conn->query($query);

    // Truy vấn tên thương hiệu dựa trên brand_id
    $query_brand = "SELECT brand_name FROM brands WHERE brand_id = $brand_id";
    $result_brand = $conn->query($query_brand);
    $brand_name = $result_brand->fetch_assoc()['brand_name'];
} else {
    echo "Không tìm thấy thương hiệu!";
    exit();
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($brand_name); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        a{
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Tên thương hiệu -->
                <h1 class="text-center my-4"><?php echo htmlspecialchars($brand_name); ?></h1>
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
                    // Kiểm tra và hiển thị danh sách sản phẩm
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <div class="col-md-3 col-sm-6 mb-4">
                                <div class="card">
                                    <img src="../uploads/<?php echo htmlspecialchars($row['product_image']); ?>" class="card-img-top" alt="Product Image">
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

                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "<div class='col-12'><p class='text-center'>Không có sản phẩm nào</p></div>";
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

    <!-- Bootstrap JS -->
    
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../js/pagination.js"></script>
</html>
<?php
include 'footer.php';
?>
