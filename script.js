const backToTop = document.getElementById("back-to-top");



function goToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function scroll() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) backToTop.style.display = "block";
    else backToTop.style.display = "none";
}

window.onscroll = function() {scroll()};

let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
    showSlides(slideIndex += n);
}

function currentSlide(n) {
    showSlides(slideIndex = n);
}

function showSlides(n) {
    let i;
    let slides = document.getElementsByClassName("mySlides");
    let dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    // dots[slideIndex-1].className += " active";
}