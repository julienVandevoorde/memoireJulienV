document.addEventListener("DOMContentLoaded", function () {
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
});
