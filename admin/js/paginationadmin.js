document.addEventListener("DOMContentLoaded", function () {
    const itemsPerPage = 8; // Số sản phẩm hiển thị trên mỗi trang
    const table = document.querySelector(".row.row-cols-1.row-cols-md-4.g-4"); // Vùng chứa sản phẩm
    const pagination = document.querySelector(".pagination"); // Vùng chứa nút phân trang

    if (!table || !pagination) return;

    // Lấy toàn bộ sản phẩm từ server đã tải về
    const products = Array.from(table.children);

    // Hiển thị sản phẩm theo trang
    function showPage(page) {
        // Xóa sản phẩm cũ
        table.innerHTML = "";

        // Lấy sản phẩm cần hiển thị
        const start = (page - 1) * itemsPerPage;
        const end = start + itemsPerPage;
        const itemsToShow = products.slice(start, end);

        // Hiển thị sản phẩm
        itemsToShow.forEach((item) => table.appendChild(item));
    }

    // Tạo phân trang
    function createPagination() {
        pagination.innerHTML = "";

        // Tính tổng số trang
        const totalPages = Math.ceil(products.length / itemsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement("li");
            li.className = `page-item ${i === 1 ? "active" : ""}`;

            const a = document.createElement("a");
            a.className = "page-link";
            a.href = "#";
            a.textContent = i;

            // Gán sự kiện click cho từng nút phân trang
            a.addEventListener("click", function (e) {
                e.preventDefault();

                // Hiển thị trang được chọn
                showPage(i);

                // Cập nhật nút "active"
                document.querySelector(".page-item.active").classList.remove("active");
                li.classList.add("active");
            });

            li.appendChild(a);
            pagination.appendChild(li);
        }

        // Hiển thị trang đầu tiên khi khởi tạo
        if (totalPages > 0) {
            showPage(1);
        } else {
            table.innerHTML = "<p class='text-center'>Không có sản phẩm nào.</p>";
        }
    }

    // Khởi tạo phân trang
    createPagination();
});
