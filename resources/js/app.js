// Flash message auto-hide functionality
document.addEventListener('DOMContentLoaded', function() {
    const flashMessage = document.querySelector('.flash-message');

    if (flashMessage) {
        setTimeout(function() {
            flashMessage.style.transition = 'opacity 0.5s ease';
            flashMessage.style.opacity = '0';

            // Remove from DOM after fade out
            setTimeout(function() {
                flashMessage.remove();
            }, 500);
        }, 2000); // 2 seconds
    }
});
