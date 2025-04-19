document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.banner-slide');
    const dotsContainer = document.querySelector('.banner-dots');
    const prevBtn = document.querySelector('.prev-btn');
    const nextBtn = document.querySelector('.next-btn');
    let currentSlide = 0;

    // Create dots for slider
    slides.forEach((_, index) => {
        const dot = document.createElement('div');
        dot.classList.add('w-3', 'h-3', 'rounded-full', 'bg-white/50', 'cursor-pointer', 'transition-all', 'duration-300');
        if (index === 0) dot.classList.add('bg-white');
        dot.addEventListener('click', () => showSlide(index));
        dotsContainer.appendChild(dot);
    });

    // Initialize slides
    slides.forEach((slide, index) => {
        slide.style.opacity = index === 0 ? '1' : '0';
        slide.style.transition = 'opacity 0.5s ease-in-out';
    });

    function showSlide(index) {
        // Hide current slide
        slides[currentSlide].style.opacity = '0';
        document.querySelectorAll('.banner-dots div')[currentSlide].classList.remove('bg-white');
        document.querySelectorAll('.banner-dots div')[currentSlide].classList.add('bg-white/50');
        
        // Show new slide
        currentSlide = index;
        slides[currentSlide].style.opacity = '1';
        document.querySelectorAll('.banner-dots div')[currentSlide].classList.remove('bg-white/50');
        document.querySelectorAll('.banner-dots div')[currentSlide].classList.add('bg-white');
    }

    function nextSlide() {
        const next = (currentSlide + 1) % slides.length;
        showSlide(next);
    }

    function prevSlide() {
        const prev = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prev);
    }

    // Add click events
    prevBtn.addEventListener('click', prevSlide);
    nextBtn.addEventListener('click', nextSlide);

    // Auto-slide every 2 seconds
    setInterval(nextSlide, 2000);
});