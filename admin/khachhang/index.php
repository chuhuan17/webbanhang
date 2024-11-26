<?php
include 'header.php';
$db = new Database();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- Slider -->
    <section id="slider" class="mb-5">
        <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
            <!-- Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <!-- Slides -->
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <img src="../../img/slide1.webp" class="d-block w-100" alt="Slide 1">

                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                    <img src="../../img/slide.webp" class="d-block w-100" alt="Slide 2">

                </div>
                <!-- Slide 3 -->
                <div class="carousel-item">
                    <img src="../../img/slide3.jpg" class="d-block w-100" alt="Slide 3">

                </div>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>


    <!-- Products -->
    <div class="container">
        <!-- Sản phẩm nổi bật -->
        <section id="product-slider" class="mb-5">
            <h2 class="text-center text-primary mb-4">Sản phẩm nổi bật</h2>
            <div class="row row-cols-1 row-cols-md-4 g-4">
                <?php
                $query_products = "SELECT * FROM products WHERE remarkable = 1";
                $result_products = $db->conn->query($query_products);

                if ($result_products->num_rows > 0) {
                    while ($row_product = $result_products->fetch_assoc()) {
                ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="../uploads/<?php echo htmlspecialchars($row_product['product_image']); ?>" class="card-img-top" alt="Product Image">
                                <div class="card-body text-center">
                                    <h5 class="card-title"><?php echo htmlspecialchars($row_product['product_name']); ?></h5>
                                    <p class="card-text text-danger fw-bold"><?php echo number_format($row_product['product_price'], 0, ',', '.') . " VND"; ?></p>
                                    <a href="product.php?product_id=<?php echo $row_product['product_id']; ?>" class="btn btn-primary">Xem chi tiết</a>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                }
                ?>
            </div>
            <div class="text-center mt-3">
                <a href="productremarkable.php" class="btn btn-outline-primary">Xem tất cả</a>
            </div>
        </section>

        <!-- Sản phẩm theo thương hiệu -->
        <?php
        $query_brands = "SELECT * FROM brands";
        $result_brands = $db->conn->query($query_brands);

        if ($result_brands->num_rows > 0) {
            while ($row_brand = $result_brands->fetch_assoc()) {
        ?>
                <section id="product-slider" class="mb-5">
                    <h2 class="text-center text-success mb-4"><?php echo htmlspecialchars($row_brand['brand_name']); ?></h2>
                    <div class="row row-cols-1 row-cols-md-4 g-4">
                        <?php
                        $query_products = "SELECT * FROM products WHERE brand_id = ?";
                        $stmt = $db->conn->prepare($query_products);
                        $stmt->bind_param("i", $row_brand['brand_id']);
                        $stmt->execute();
                        $result_products = $stmt->get_result();

                        if ($result_products->num_rows > 0) {
                            while ($row_product = $result_products->fetch_assoc()) {
                        ?>
                                <div class="col">
                                    <div class="card h-100">
                                        <img src="../uploads/<?php echo htmlspecialchars($row_product['product_image']); ?>" class="card-img-top" alt="Product Image">
                                        <div class="card-body text-center">
                                            <h5 class="card-title"><?php echo htmlspecialchars($row_product['product_name']); ?></h5>
                                            <p class="card-text text-danger fw-bold"><?php echo number_format($row_product['product_price'], 0, ',', '.') . " VND"; ?></p>
                                            <a href="product.php?product_id=<?php echo $row_product['product_id']; ?>" class="btn btn-primary">Xem chi tiết</a>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p class='text-center'>Không có sản phẩm nào</p>";
                        }
                        ?>
                    </div>
                    <div class="text-center mt-3">
                        <a href="products_by_brand.php?brand_id=<?php echo $row_brand['brand_id']; ?>" class="btn btn-outline-success">Xem tất cả</a>
                    </div>
                </section>
        <?php
            }
        }
        ?>
    </div>

    <?php include 'footer.php'; ?>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
