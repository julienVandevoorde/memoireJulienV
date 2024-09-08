document.addEventListener("DOMContentLoaded", function () {
    // Fonction pour soumettre le formulaire de téléchargement de photo de profil
    function submitForm() {
        var form = document.getElementById('upload-photo-form');
        var formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Mise à jour de l'image affichée
                document.getElementById('output').src = URL.createObjectURL(document.getElementById('file').files[0]);
            } else {
                console.error('Erreur lors de la mise à jour de la photo de profil.');
            }
        })
        .catch(error => console.error('Erreur:', error));
    }

    window.submitForm = submitForm; // Rendre la fonction disponible globalement

    // Logique pour les champs éditables
    document.querySelectorAll('.edit-button').forEach(button => {
        button.addEventListener('click', function() {
            const container = this.parentElement;
            container.querySelector('.field-value').style.display = 'none';
            container.querySelector('.field-input').style.display = 'inline';
            this.style.display = 'none';
            container.querySelector('.save-button').style.display = 'inline';
        });
    });

    document.querySelectorAll('.save-button').forEach(button => {
        button.addEventListener('click', function() {
            const container = this.parentElement;
            const field = container.getAttribute('data-field');
            const inputElement = container.querySelector('.field-input');
            let newValue;

            if (field === 'styles') {
                newValue = Array.from(inputElement.selectedOptions).map(option => option.value);
            } else {
                newValue = inputElement.tagName.toLowerCase() === 'textarea' ? inputElement.value : inputElement.value;
            }

            fetch('/profile/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify({ field, value: newValue })
            })
            .then(response => response.json().catch(() => {
                return response.text().then(text => {
                    console.error('Erreur complète de la réponse AJAX:', text);
                    throw new Error('Invalid JSON: ' + text);
                });
            }))
            .then(data => {
                if (data.success) {
                    if (field === 'styles') {
                        container.querySelector('.field-value').textContent = Array.from(inputElement.selectedOptions).map(option => option.text).join(', ');
                    } else {
                        container.querySelector('.field-value').textContent = newValue;
                    }
                    container.querySelector('.field-value').style.display = 'inline';
                    inputElement.style.display = 'none';
                    container.querySelector('.edit-button').style.display = 'inline';
                    this.style.display = 'none';
                } else {
                    console.error('Erreur:', data.message);
                }
            })
            .catch(error => console.error('Erreur:', error));
        });
    });
});
