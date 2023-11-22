document.addEventListener("DOMContentLoaded", function() {
    const contentContainer = document.getElementById('content');
    const commentContainer = document.getElementById('comment-container');

    // Fonction pour afficher les commentaires sur l'image
    function showCommentsOnImage(imageData) {
        contentContainer.innerHTML = '';

        imageData.forEach(imageInfo => {
            const img = document.createElement('img');
            img.src = imageInfo.image_link;

            img.addEventListener('click', (event) => {
                const rect = event.target.getBoundingClientRect();
                const x = event.clientX - rect.left;
                const y = event.clientY - rect.top;

                // Ajouter un commentaire à la base de données
                const commentText = prompt('Laissez un commentaire :');
                if (commentText) {
                    addComment(imageInfo.image_link, x, y, commentText);
                    showCommentsOnImage(imageData);
                }
            });

            contentContainer.appendChild(img);

            // Afficher les points translucides et lier les commentaires
            imageInfo.comments.forEach(comment => {
                const point = document.createElement('div');
                point.className = 'comment-point';
                point.style.left = `${comment.x}px`;
                point.style.top = `${comment.y}px`;

                point.addEventListener('click', () => {
                    alert(`${comment.username}: ${comment.comment_text}`);
                });

                commentContainer.appendChild(point);
            });
        });
    }

    // Fonction pour ajouter un commentaire à la base de données
    function addComment(imageLink, x, y, commentText) {
        // Vous devez implémenter la logique pour ajouter un commentaire à la base de données ici.
        // Assurez-vous de stocker la position (x, y), le texte du commentaire, l'ID de l'image associée
        // et l'ID de l'utilisateur associé (peut être récupéré à partir de la session de l'utilisateur).
        // Après avoir ajouté le commentaire à la base de données, vous devrez peut-être recharger les données.
    }

    // Fonction pour charger les données depuis le serveur
    function loadData() {
        fetch('get_images.php')
            .then(response => response.json())
            .then(data => showCommentsOnImage(data))
            .catch(error => console.error('Error fetching data:', error));
    }

    // Charger les données au chargement de la page
    loadData();
});
