let slideIndex = 0;

function showSlides() {
    let slides = document.getElementsByClassName("mySlides");

    for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");
    }

    slideIndex++;
    if (slideIndex > slides.length) { 
        slideIndex = 1; 
    }

    slides[slideIndex - 1].classList.add("active");

    setTimeout(showSlides, 5000); 
}

showSlides();


