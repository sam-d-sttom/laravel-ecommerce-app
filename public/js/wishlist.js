document.querySelectorAll('.wishlish-btn').forEach(button => {
    button.addEventListener('click', function() {
        let productId = this.dataset.productId;
        let button = this;

        console.log(productId)

        fetch(`/wishlist/toggle/${productId}`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "Content-Type": "application/json"
            },
        })
        .catch(error => console.error('Error:', error));
    });
});