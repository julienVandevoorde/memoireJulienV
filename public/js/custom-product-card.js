document.addEventListener("DOMContentLoaded", function () {
    // Sélectionner tous les boutons 'buy' et ajouter un événement de clic
    const buyButtons = document.querySelectorAll('.buy');
    buyButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            const bottomElement = this.closest('.bottom');  // Trouver l'élément parent .bottom
            const incrementButton = document.querySelector(`.btn-increment[data-product-id='${productId}']`);
            const incrementValue = incrementButton.getAttribute('data-increment');

            if (bottomElement) {
                bottomElement.classList.add('clicked');  // Ajouter la classe 'clicked'

                // Mettre à jour le texte pour indiquer le nombre d'articles ajoutés
                const addedMessage = document.getElementById(`added-message-${productId}`);
                addedMessage.textContent = `Added ${incrementValue} to your cart`;
            }
        });
    });

    // Sélectionner tous les boutons 'remove' et ajouter un événement de clic
    const removeButtons = document.querySelectorAll('.remove');
    removeButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const bottomElement = this.closest('.bottom');  // Trouver l'élément parent .bottom
            if (bottomElement) {
                bottomElement.classList.remove('clicked');  // Retirer la classe 'clicked'
            }
        });
    });

    // Sélectionner tous les boutons 'increment' et ajouter un événement de clic
    const incrementButtons = document.querySelectorAll('.btn-increment');
    incrementButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            let incrementValue = parseInt(this.getAttribute('data-increment'));

            // Incrémente la valeur
            incrementValue += 1;
            this.setAttribute('data-increment', incrementValue);
            this.textContent = `+${incrementValue}`;  // Mettre à jour le texte du bouton

            // Affiche le bouton -1 lorsque la quantité est supérieure à 1
            const decrementButton = document.querySelector(`.btn-decrement[data-product-id='${productId}']`);
            if (incrementValue > 1) {
                decrementButton.style.display = 'inline-block';
            }

            // Appeler la fonction pour mettre à jour le prix en fonction de la quantité
            updatePrice(productId, incrementValue);
        });
    });

    // Sélectionner tous les boutons 'decrement' et ajouter un événement de clic
    const decrementButtons = document.querySelectorAll('.btn-decrement');
    decrementButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            let incrementValue = parseInt(document.querySelector(`.btn-increment[data-product-id='${productId}']`).getAttribute('data-increment'));

            // Décrémente la valeur si elle est supérieure à 1
            if (incrementValue > 1) {
                incrementValue -= 1;
                document.querySelector(`.btn-increment[data-product-id='${productId}']`).setAttribute('data-increment', incrementValue);
                document.querySelector(`.btn-increment[data-product-id='${productId}']`).textContent = `+${incrementValue}`;  // Mettre à jour le texte du bouton
                updatePrice(productId, incrementValue);

                // Cacher le bouton -1 si la quantité est de nouveau 1
                if (incrementValue === 1) {
                    this.style.display = 'none';
                }
            }
        });
    });
});

/**
 * Fonction pour mettre à jour la quantité d'un produit et son prix total.
 */
function updatePrice(productId, quantity) {
    const priceElement = document.getElementById(`price-${productId}`);
    let basePrice = parseFloat(priceElement.dataset.basePrice);

    // Calcule le nouveau prix en fonction de la quantité
    let newPrice = basePrice * quantity;
    
    // Mettre à jour l'affichage du prix
    priceElement.innerText = newPrice.toFixed(2);
}
