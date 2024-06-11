document.addEventListener('DOMContentLoaded', () => {
    const urlParams = new URLSearchParams(window.location.search);
    const productId = urlParams.get('product_id');
    let selectedRating = 0;

    const starRows = document.querySelectorAll('.star-row');
    const submitBtn = document.getElementById('submit-btn');
    const reviewForm = document.getElementById('reviewForm');
    const ratingInput = document.getElementById('rating');
    const productIdInput = document.getElementById('product_id');

    productIdInput.value = productId;

    starRows.forEach(row => {
        row.addEventListener('click', () => {
            selectedRating = row.getAttribute('data-value');
            ratingInput.value = selectedRating;
            starRows.forEach(r => r.classList.remove('selected'));
            row.classList.add('selected');
        });

        row.addEventListener('mouseenter', () => {
            row.classList.add('hovered');
        });

        row.addEventListener('mouseleave', () => {
            row.classList.remove('hovered');
        });
    });

    submitBtn.addEventListener('click', () => {
        if (selectedRating > 0 && productId) {
            reviewForm.submit();
        }
    });
});
