// js phần slide
const imgPosition = document.querySelectorAll(".aspect-ratio-169 img");
const imgContainer = document.querySelector('.aspect-ratio-169');
const dotItem = document.querySelectorAll(".dot");
let imgNumber = imgPosition.length
let index = 0

imgPosition.forEach(function(image, index) {
    image.style.left = index * 100 + "%";
    dotItem[index].addEventListener("click", function() {
        slider(index);
    })
})

function imgSlide() {
    index++;
    console.log(index)
    if (index >= imgNumber) {
        index = 0
    }
    slider(index)
}

function slider(index) {
    imgContainer.style.left = "-" + index * 100 + "%"
    const dotActive = document.querySelector('.active')
    dotActive.classList.remove("active")
    dotItem[index].classList.add("active")
}

setInterval(imgSlide, 5000)


// js phần danh sách sản phẩm
let currentSlide = 0;
const productsPerPage = 5; // Hiển thị 5 sản phẩm trên một hàng
const productSlide = document.querySelector('.product-slide');
const slides = document.querySelectorAll('.product');
const totalSlides = slides.length;

function showSlide(index) {
    // Nếu vượt quá sản phẩm cuối cùng thì quay lại sản phẩm đầu
    if (index >= totalSlides) {
        currentSlide = 0;
    } else if (index < 0) {
        // Nếu quay ngược về trước sản phẩm đầu tiên thì quay lại cuối cùng
        currentSlide = totalSlides - productsPerPage;
    } else {
        currentSlide = index;
    }

    // Tính toán vị trí dịch chuyển dựa trên chiều rộng của một sản phẩm
    const slideWidth = slides[0].offsetWidth;
    const offset = -currentSlide * slideWidth;

    // Dịch chuyển danh sách sản phẩm
    productSlide.style.transform = `translateX(${offset}px)`;
}

function nextSlide() {
    if (currentSlide + productsPerPage < totalSlides) {
        showSlide(currentSlide + 1); // Chuyển một sản phẩm
    } else {
        showSlide(0); // Quay lại đầu khi hết danh sách
    }
}

function prevSlide() {
    if (currentSlide > 0) {
        showSlide(currentSlide - 1); // Chuyển ngược một sản phẩm
    } else {
        showSlide(totalSlides - productsPerPage); // Quay lại cuối khi quay ngược từ đầu
    }
}

// Đảm bảo khởi tạo trạng thái ban đầu của slider
window.addEventListener('resize', () => {
    // Cập nhật lại vị trí khi thay đổi kích thước màn hình
    showSlide(currentSlide);
});
