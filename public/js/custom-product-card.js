document.addEventListener("DOMContentLoaded", function () {
    // Sélectionner tous les boutons 'buy', 'increment' et 'decrement' et attacher des événements de clic
    attachEventListeners();
});

function attachEventListeners() {
    const buyButtons = document.querySelectorAll('.buy');
    const incrementButtons = document.querySelectorAll('.btn-increment');
    const decrementButtons = document.querySelectorAll('.btn-decrement');

    buyButtons.forEach(button => button.addEventListener('click', handleBuyClick));
    incrementButtons.forEach(button => button.addEventListener('click', handleIncrementClick));
    decrementButtons.forEach(button => button.addEventListener('click', handleDecrementClick));
}

// Fonction pour gérer l'événement de clic sur les boutons 'buy'
function handleBuyClick() {
    const productId = this.getAttribute('data-product-id');
    const incrementButton = document.querySelector(`.btn-increment[data-product-id='${productId}']`);
    const quantity = parseInt(incrementButton.getAttribute('data-increment'));
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Appel AJAX pour ajouter au panier
    ajaxRequest('/cart/add', 'POST', { product_id: productId, quantity: quantity }, token)
        .then(data => {
            if (data.success) {
                updateCartCount(quantity);
            }
        })
        .catch(error => console.error('Erreur:', error));
}

// Fonction pour gérer l'événement de clic sur les boutons 'increment'
function handleIncrementClick() {
    const productId = this.getAttribute('data-product-id');
    let incrementValue = parseInt(this.getAttribute('data-increment')) + 1;

    this.setAttribute('data-increment', incrementValue);
    this.textContent = `+${incrementValue}`;

    toggleDecrementButton(productId, incrementValue > 1);
    updatePrice(productId, incrementValue);
}

// Fonction pour gérer l'événement de clic sur les boutons 'decrement'
function handleDecrementClick() {
    const productId = this.getAttribute('data-product-id');
    const incrementButton = document.querySelector(`.btn-increment[data-product-id='${productId}']`);
    let incrementValue = parseInt(incrementButton.getAttribute('data-increment'));

    if (incrementValue > 1) {
        incrementValue -= 1;
        incrementButton.setAttribute('data-increment', incrementValue);
        incrementButton.textContent = `+${incrementValue}`;

        toggleDecrementButton(productId, incrementValue > 1);
        updatePrice(productId, incrementValue);
    }
}

// Fonction utilitaire pour afficher/masquer le bouton de décrémentation
function toggleDecrementButton(productId, show) {
    const decrementButton = document.querySelector(`.btn-decrement[data-product-id='${productId}']`);
    decrementButton.style.display = show ? 'inline-block' : 'none';
}

// Fonction pour mettre à jour le prix
function updatePrice(productId, quantity) {
    const priceElement = document.getElementById(`price-${productId}`);
    let basePrice = parseFloat(priceElement.dataset.basePrice);

    let newPrice = basePrice * quantity;
    priceElement.innerText = newPrice.toFixed(2);
}

// Fonction utilitaire pour mettre à jour le compteur de panier
function updateCartCount(quantity) {
    const cartCount = document.getElementById('cart-count');
    const currentCount = parseInt(cartCount.textContent) || 0;
    cartCount.textContent = currentCount + quantity;
}

// Fonction générique pour effectuer des requêtes AJAX
function ajaxRequest(url, method, body, token) {
    return fetch(url, {
        method: method,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        },
        body: JSON.stringify(body)
    })
    .then(response => response.json());
}
