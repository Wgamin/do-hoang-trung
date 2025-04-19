document.addEventListener('DOMContentLoaded', function() {
    // Toggle form liên hệ
    const toggleFormBtn = document.querySelector('.toggle-form');
    const sideForm = document.querySelector('.side-form');
    
    toggleFormBtn.addEventListener('click', function() {
        sideForm.classList.toggle('translate-x-full');
        this.querySelector('i').classList.toggle('rotate-180');
    });
});