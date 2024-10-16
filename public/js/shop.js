document.addEventListener("DOMContentLoaded", function () {
    // Sélectionner tous les boutons 'Add to Cart' et attacher des événements de clic
    const addToCartButtons = document.querySelectorAll('.btn-add-to-cart');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            addToCart(productId);
        });
    });

    // Gestion du flash message
    const flashMessage = document.querySelector('.flash-message');
    
    if (flashMessage) {
        // Affiche le flash message
        flashMessage.style.display = 'block';
        
        // Cache le message après 5 secondes
        setTimeout(() => {
            flashMessage.style.display = 'none';
        }, 10000);
    }
});

function addToCart(productId) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify({ product_id: productId, quantity: 1 })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartCount(data.cartCount);
        }
    })
    .catch(error => console.error('Erreur:', error));
}

function updateCartCount(count) {
    const cartCountElement = document.getElementById('cart-count');
    cartCountElement.textContent = count;
}
