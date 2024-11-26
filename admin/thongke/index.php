<?php
include "../database/header.php";
include '../database/sidebar.php';
include "../database/database.php";

$db = new Database();
$conn = $db->conn;

// Lấy dữ liệu từ form (GET)
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : null;
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : null;

$total_revenue = 0;

// Kiểm tra nếu người dùng chọn khoảng thời gian
if ($start_date && $end_date) {
    // Truy vấn doanh thu trong khoảng thời gian
    $sql_revenue = "
        SELECT SUM(total_amount) AS total_revenue
        FROM cart
        WHERE cart_status = 2 
          AND DATE(cart_date) BETWEEN ? AND ?";
    $stmt = $conn->prepare($sql_revenue);
    $stmt->bind_param('ss', $start_date, $end_date); // Bind tham số
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    $total_revenue = $row['total_revenue'] ? $row['total_revenue'] : 0;
}
?>

<div class="admin-content-right">
    <div class="admin-content-right-statistics">
        <h1>Thống kê doanh thu</h1>

        <!-- Form chọn khoảng thời gian -->
        <form method="GET" action="">
            <label for="start_date">Từ ngày:</label>
            <input type="date" id="start_date" name="start_date" required>
            <label for="end_date">Đến ngày:</label>
            <input type="date" id="end_date" name="end_date" required>
            <button type="submit">Xem thống kê</button>
        </form>

        <!-- Hiển thị doanh thu -->
        <?php if ($start_date && $end_date) { ?>
            <h2>Doanh thu từ ngày <?php echo htmlspecialchars($start_date); ?> đến ngày <?php echo htmlspecialchars($end_date); ?>:</h2>
            <p><strong><?php echo number_format($total_revenue, 0, ',', '.'); ?> VND</strong></p>
        <?php } ?>
    </div>
</div>
</body>
</html>
