<div class="slideshow-container">
    <a href="">
        <div class="mySlides fade">
            <div class="numbertext">1 / 3</div>
            <img src="{{ asset('assets/offers-img/offer1.jpg') }}" style="width:100%">
            {{-- <div class="text">Caption Text</div> --}}
        </div>
    </a>
    <a href="">
        <div class="mySlides fade">
            <div class="numbertext">2 / 3</div>
            <img src="{{ asset('assets/offers-img/offer2.jpeg') }}" style="width:100%">
            {{-- <div class="text">Caption Two</div> --}}
        </div>
    </a>

    <a href="">
        <div class="mySlides fade">
            <div class="numbertext">3 / 3</div>
            <img src="{{ asset('assets/offers-img/offer3.jpeg') }}" style="width:100%">
            {{-- <div class="text">Caption Three</div> --}}
        </div>
    </a>

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>
<br>

<div style="text-align:center">
    <span class="dot" onclick="currentSlide(1)"></span>
    <span class="dot" onclick="currentSlide(2)"></span>
    <span class="dot" onclick="currentSlide(3)"></span>
</div>
<script>
    let slideIndex = 1;
    let slideInterval;

    showSlides(slideIndex);
    startSlideshow();

    function startSlideshow() {
        slideInterval = setInterval(function() {
            plusSlides(1);
        }, 5000);
    }

    function pauseSlideshow() {
        clearInterval(slideInterval);
    }

    function plusSlides(n) {
        pauseSlideshow();
        showSlides(slideIndex += n);
        startSlideshow();
    }

    function currentSlide(n) {
        pauseSlideshow();
        showSlides(slideIndex = n);
        startSlideshow();
    }

    function showSlides(n) {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        let dots = document.getElementsByClassName("dot");
        if (n > slides.length) {
            slideIndex = 1
        }
        if (n < 1) {
            slideIndex = slides.length
        }
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
        slides[slideIndex - 1].style.display = "block";
        dots[slideIndex - 1].className += " active";
    }
</script>
