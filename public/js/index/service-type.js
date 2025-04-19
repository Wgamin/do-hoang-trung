document.addEventListener('DOMContentLoaded', function() {
    const track = document.querySelector('.slider-track');
    const prev = document.querySelector('.prev-btn');
    const next = document.querySelector('.next-btn');

    if (track && prev && next) {
        let currentPage = 0;
        const itemsPerPage = 8; // 4 columns x 2 rows
        const totalItems = document.querySelectorAll('.service-card').length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);

        next.addEventListener('click', () => {
            if (currentPage < totalPages - 1) {
                currentPage++;
                updateSlider();
            }
        });

        prev.addEventListener('click', () => {
            if (currentPage > 0) {
                currentPage--;
                updateSlider();
            }
        });

        function updateSlider() {
            const offset = currentPage * itemsPerPage;
            const cards = Array.from(track.children);
            
            cards.forEach((card, index) => {
                if (index >= offset && index < offset + itemsPerPage) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Initialize the slider
        updateSlider();
    }
});