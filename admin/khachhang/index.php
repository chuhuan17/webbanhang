<?php
include 'header.php';
$db = new Database();
?>
<style>
    /* Cấu trúc slider */
    #slider .aspect-ratio-169 {
        position: relative;
        width: 100%;
        overflow: hidden;
        /* Đảm bảo chỉ hiển thị slide hiện tại */
        display: flex;
        /* Sử dụng flex để các slide xếp ngang nhau */
        transition: transform 1s ease;
        /* Thêm hiệu ứng chuyển động */
    }

    #slider .aspect-ratio-169 img {
        min-width: 100%;
        /* Đảm bảo mỗi ảnh chiếm toàn bộ chiều rộng */
        height: auto;
        object-fit: cover;
        /* Ảnh không bị méo */
        flex-shrink: 0;
        /* Không co giãn ảnh */
    }


    .dot-container {
        text-align: center;
        margin-top: 10px;
    }

    .dot {
        display: inline-block;
        width: 10px;
        height: 10px;
        margin: 0 5px;
        background-color: #bbb;
        border-radius: 50%;
        cursor: pointer;
    }

    .dot.active {
        background-color: #333;
    }



    /* Cấu trúc của danh sách sản phẩm */
    #product-slider {
        margin: 30px 0;
    }

    #product-slider .title-section h2 {
        font-size: 24px;
        font-weight: 600;
        color: #333;
        margin-bottom: 15px;
    }

    .slider-container {
        position: relative;
        overflow: hidden;
    }

    .product-slide {
        display: flex;
        transition: transform 0.5s ease;
    }

    .product {
        margin-right: 20px;
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        width: 249px;
    }

    .product:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    .product img {
        width: 100%;
        height: 370px;
        object-fit: cover;
        transition: transform 0.3s ease;
        border-radius: 8px;
    }

    .product:hover img {
        transform: scale(1.05);
    }

    .product h3 {
        font-size: 15px;
        text-align: center;
        margin-top: 10px;
        color: #333;
        font-weight: 600;
    }

    .product p {
        font-size: 16px;
        color: #d9534f;
        margin-bottom: 10px;
        text-align: center;
    }

    .link-product {
        margin-top: 20px;
        text-align: center;
    }

    .link-product a {
        text-decoration: none;
        color: #007bff;
        font-size: 16px;
        font-weight: 600;
        transition: color 0.3s ease;
    }

    .link-product a:hover {
        color: #0056b3;
    }

    /* Các hiệu ứng chuyển động cho nút next, prev */

    /* Responsive */
    @media (max-width: 1200px) {
        .product-slide {
            flex-wrap: wrap;
        }

        .product {
            margin-right: 15px;
        }

        #product-slider .title-section h2 {
            font-size: 20px;
        }
    }

    @media (max-width: 768px) {
        .product-list {
            grid-template-columns: repeat(2, 1fr);
            /* 2 cột trên màn hình nhỏ */
        }

        .product {
            width: 100%;
            /* Full-width sản phẩm trên màn hình nhỏ */
        }

        button.prev,
        button.next {
            font-size: 20px;
        }
    }

    @media (max-width: 480px) {
        #product-slider .title-section h2 {
            font-size: 18px;
        }

        .product {
            width: 100%;
            /* Full-width sản phẩm trên điện thoại */
        }

        button.prev,
        button.next {
            font-size: 18px;
        }
    }

    .buy-now-btn {
        background-color: #ff6f61;
        /* Button color */
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
        margin-top: 10px;
        display: inline-block;
        text-decoration: none;
        margin-left: 60px;
    }

    .buy-now-btn:hover {
        background-color: #e55b50;
        /* Darker shade on hover */
    }
</style>
<section id="slider">
    <div class="aspect-ratio-169">
        <img src="../../img/slide.webp" alt="">
        <img src="../../img/s" alt="">
        <img src="../../img/slide3.jpg" alt="">
    </div>
    <div class="dot-container">
        <div class="dot active"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
</section>
<!------------------- list product ------------>
<div class="container">
    <section id="product-slider">
        <div class="title-section">
            <h2>Sản phẩm nổi bật</h2>
        </div>
        <div class="slider-container">
            <div class="product-slide">
                <?php
                $query_products = "SELECT * FROM products WHERE remarkable = 1";
                $result_products = $db->conn->query($query_products);

                if ($result_products->num_rows > 0) {
                    while ($row_product = $result_products->fetch_assoc()) {
                ?>
                        <div class="product">
                            <a href="product.php?product_id=<?php echo $row_product['product_id']; ?>" style="text-decoration: none; color: inherit;">
                                <img class="img" src="../uploads/<?php echo $row_product['product_image']; ?>" alt="Product Image">
                                <h3><?php echo $row_product['product_name']; ?></h3>
                                <p><?php echo number_format($row_product['product_price'], 0, ',', '.') . " VND"; ?></p>
                                <button class="buy-now-btn">Mua hàng</button>
                            </a>
                        </div>

                <?php
                    }
                }
                ?>
            </div>
        </div>

        <div class="link-product">
            <a href="productremarkable.php" style="text-decoration: none;">Xem tất cả</a>
        </div>
    </section>
    <section id="product-slider">
        <?php
        $query_brands = "SELECT * FROM brands";
        $result_brands = $db->conn->query($query_brands);

        if ($result_brands->num_rows > 0) {
            while ($row_brand = $result_brands->fetch_assoc()) {
        ?>
                <div class="title-section">
                    <h2><?php echo $row_brand['brand_name']; ?></h2>
                </div>
                <div class="slider-container">
                    <div class="product-slide">
                        <?php
                        $query_products = "SELECT * FROM products WHERE brand_id = ?";
                        $stmt = $db->conn->prepare($query_products);
                        $stmt->bind_param("i", $row_brand['brand_id']);
                        $stmt->execute();
                        $result_products = $stmt->get_result();

                        if ($result_products->num_rows > 0) {
                            while ($row_product = $result_products->fetch_assoc()) {
                        ?>
                                <div class="product">
                                    <a href="product.php?product_id=<?php echo $row_product['product_id']; ?>" style="text-decoration: none; color: inherit;">
                                        <img class="img" src="../uploads/<?php echo $row_product['product_image']; ?>" alt="Product Image">
                                        <h3><?php echo $row_product['product_name']; ?></h3>
                                        <p><?php echo number_format($row_product['product_price'], 0, ',', '.') . " VND"; ?></p>
                                        <button class="buy-now-btn">Mua hàng</button>
                                    </a>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>Không có sản phẩm cho thương hiệu này.</p>";
                        }
                        ?>
                    </div>
                </div>

                <div class="link-product">
                    <a href="products_by_brand.php?brand_id=<?php echo $row_brand['brand_id']; ?>" style="text-decoration: none;">Xem tất cả</a>
                </div>
        <?php
            }
        }
        ?>
    </section>

</div>
<?php
include 'footer.php';
?>


<script>
    const imgPosition = document.querySelectorAll(".aspect-ratio-169 img");
    const imgContainer = document.querySelector('.aspect-ratio-169');
    const dotItem = document.querySelectorAll(".dot");
    let imgNumber = imgPosition.length;
    let index = 0;

    // Xếp ảnh theo thứ tự ngang
    imgPosition.forEach((image, idx) => {
        image.style.transform = `translateX(${idx * 100}%)`;
    });

    function imgSlide() {
        index++;
        if (index >= imgNumber) {
            index = 0;
        }
        slider(index);
    }

    function slider(index) {
        // Di chuyển container ảnh
        imgContainer.style.transform = `translateX(-${index * 100}%)`;
        imgContainer.style.transition = "transform 1s ease";

        // Cập nhật dot
        document.querySelector('.dot.active')?.classList.remove("active");
        dotItem[index].classList.add("active");
    }

    // Thêm sự kiện cho dot
    dotItem.forEach((dot, idx) => {
        dot.addEventListener("click", () => {
            index = idx;
            slider(index);
        });
    });

    // Tự động chuyển slide
    setInterval(imgSlide, 5000);
</script>


</html>