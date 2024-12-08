document.addEventListener("DOMContentLoaded", function () {
  const itemsPerPage = 8; // Số sản phẩm trên mỗi trang
  const table = document.getElementById("Table"); // Vùng chứa sản phẩm
  const pagination = document.getElementById("pagination"); // Phân trang
  const priceFilter = document.getElementById("priceFilter"); // Bộ lọc giá

  // Lấy toàn bộ sản phẩm từ server
  const products = Array.from(table.children);

  let filteredProducts = [...products]; // Sản phẩm sau khi lọc

  // Hiển thị sản phẩm theo trang
  function showPage(page, productList) {
    // Xóa sản phẩm cũ
    table.innerHTML = "";

    // Lấy sản phẩm cần hiển thị
    const start = (page - 1) * itemsPerPage;
    const end = start + itemsPerPage;

    const itemsToShow = productList.slice(start, end);
    itemsToShow.forEach((item) => table.appendChild(item));
  }

  // Tạo phân trang
  function createPagination(productList) {
    pagination.innerHTML = "";

    const totalPages = Math.ceil(productList.length / itemsPerPage);

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
        showPage(i, productList);

        // Cập nhật active
        document.querySelector(".page-item.active").classList.remove("active");
        li.classList.add("active");
      });

      li.appendChild(a);
      pagination.appendChild(li);
    }

    // Hiển thị trang đầu tiên khi tạo phân trang
    if (totalPages > 0) {
      showPage(1, productList);
    } else {
      table.innerHTML =
        "<p class='text-center'>Không có sản phẩm nào phù hợp</p>";
    }
  }

  // Lọc sản phẩm theo giá
  function filterProductsByPrice() {
    const value = priceFilter.value;
    console.log("Lọc theo giá trị:", value);

    filteredProducts = products.filter((product) => {
      const priceText = product
        .querySelector("span:nth-of-type(2)")
        .textContent.replace(/\./g, "")
        .replace(/[^0-9]/g, "");
      const price = parseInt(priceText, 10);

      console.log("Giá sản phẩm:", price);

      if (value === "all") return true;

      const [min, max] = value.split("-");
      if (!max) return price >= parseInt(min, 10);
      return price >= parseInt(min, 10) && price <= parseInt(max, 10);
    });

    console.log("Sản phẩm sau khi lọc:", filteredProducts);

    createPagination(filteredProducts);
  }

  // Gắn sự kiện lọc giá
  priceFilter.addEventListener("change", filterProductsByPrice);

  // Hiển thị phân trang và dữ liệu ban đầu
  createPagination(filteredProducts);
});
