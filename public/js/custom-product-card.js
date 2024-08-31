document.addEventListener("DOMContentLoaded", function () {
    // Sélectionner tous les boutons 'buy' et ajouter un événement de clic
    const buyButtons = document.querySelectorAll('.buy');
    buyButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            const incrementButton = document.querySelector(`.btn-increment[data-product-id='${productId}']`);
            const quantity = parseInt(incrementButton.getAttribute('data-increment'));
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Envoyer la requête AJAX pour ajouter au panier
            fetch('/cart/add', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({ product_id: productId, quantity: quantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Mettre à jour le compteur de panier
                    const cartCount = document.getElementById('cart-count');
                    const currentCount = parseInt(cartCount.textContent) || 0;
                    cartCount.textContent = currentCount + quantity;
                }
            })
            .catch(error => console.error('Erreur:', error));
        });
    });

    // Sélectionner tous les boutons 'increment' et ajouter un événement de clic
    const incrementButtons = document.querySelectorAll('.btn-increment');
    incrementButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            let incrementValue = parseInt(this.getAttribute('data-increment'));

            incrementValue += 1;
            this.setAttribute('data-increment', incrementValue);
            this.textContent = `+${incrementValue}`;

            const decrementButton = document.querySelector(`.btn-decrement[data-product-id='${productId}']`);
            if (incrementValue > 1) {
                decrementButton.style.display = 'inline-block';
            }

            updatePrice(productId, incrementValue);
        });
    });

    // Sélectionner tous les boutons 'decrement' et ajouter un événement de clic
    const decrementButtons = document.querySelectorAll('.btn-decrement');
    decrementButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            let incrementValue = parseInt(document.querySelector(`.btn-increment[data-product-id='${productId}']`).getAttribute('data-increment'));

            if (incrementValue > 1) {
                incrementValue -= 1;
                document.querySelector(`.btn-increment[data-product-id='${productId}']`).setAttribute('data-increment', incrementValue);
                document.querySelector(`.btn-increment[data-product-id='${productId}']`).textContent = `+${incrementValue}`;
                updatePrice(productId, incrementValue);

                if (incrementValue === 1) {
                    this.style.display = 'none';
                }
            }
        });
    });
});

function updatePrice(productId, quantity) {
    const priceElement = document.getElementById(`price-${productId}`);
    let basePrice = parseFloat(priceElement.dataset.basePrice);

    let newPrice = basePrice * quantity;
    priceElement.innerText = newPrice.toFixed(2);
}
