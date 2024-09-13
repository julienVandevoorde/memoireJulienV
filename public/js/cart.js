document.addEventListener('DOMContentLoaded', function () {
    const incrementButtons = document.querySelectorAll('.btn-increment');
    const decrementButtons = document.querySelectorAll('.btn-decrement');
    const removeButtons = document.querySelectorAll('.btn-remove');

    incrementButtons.forEach(button => button.addEventListener('click', updateQuantity));
    decrementButtons.forEach(button => button.addEventListener('click', updateQuantity));
    removeButtons.forEach(button => button.addEventListener('click', removeFromCart));
});

function updateQuantity(event) {
    const productId = event.target.getAttribute('data-product-id');
    const action = event.target.classList.contains('btn-increment') ? 'increment' : 'decrement';

    fetch('/cart/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ product_id: productId, action: action })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}

function removeFromCart(event) {
    const productId = event.target.getAttribute('data-product-id');

    fetch('/cart/remove', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => console.error('Error:', error));
}
