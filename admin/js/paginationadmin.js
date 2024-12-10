document.addEventListener("DOMContentLoaded", function () {
    const itemsPerPage = 8; // Số sản phẩm trên mỗi trang
    const table = document.getElementById("Table"); // Vùng chứa sản phẩm
    const pagination = document.getElementById("pagination"); // Phân trang
  
    // Lấy toàn bộ sản phẩm từ server
    const products = Array.from(table.children);
  
    // Hiển thị sản phẩm theo trang
    function showPage(page) {
      // Xóa sản phẩm cũ
      table.innerHTML = "";
  
      // Lấy sản phẩm cần hiển thị
      const start = (page - 1) * itemsPerPage;
      const end = start + itemsPerPage;
  
      const itemsToShow = products.slice(start, end);
      itemsToShow.forEach((item) => table.appendChild(item));
    }
  
    // Tạo phân trang
    function createPagination() {
      pagination.innerHTML = "";
  
      const totalPages = Math.ceil(products.length / itemsPerPage);
  
      for (let i = 1; i <= totalPages; i++) {
        const li = document.createElement("li");
        li.className = `page-item ${i === 1 ? "active" : ""}`;
  
        const a = document.createElement("a");
        a.className = "page-link";
        a.href = "#";
        a.textContent = i;
  
        a.addEventListener("click", function (e) {
          e.preventDefault();
  
          // Hiển thị trang
          showPage(i);
  
          // Cập nhật active
          document.querySelector(".page-item.active").classList.remove("active");
          li.classList.add("active");
        });
  
        li.appendChild(a);
        pagination.appendChild(li);
      }
  
      // Hiển thị trang đầu tiên khi tạo phân trang
      if (totalPages > 0) {
        showPage(1);
      } else {
        table.innerHTML = "<p class='text-center'>Không có sản phẩm nào.</p>";
      }
    }
  
    // Hiển thị phân trang và dữ liệu ban đầu
    createPagination();
  });
  