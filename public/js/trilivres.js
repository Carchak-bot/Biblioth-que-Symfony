document.addEventListener('DOMContentLoaded', function() {
    // Réinitialiser les filtres lorsque le bouton de réinitialisation est cliqué
    document.getElementById('resetFilter').addEventListener('click', function() {
        // Réinitialiser les valeurs des sélecteurs
        document.getElementById('authorTri').value = 'none';
        document.getElementById('categoryTri').value = 'none';
        document.getElementById('dateTri').value = 'none';
        document.getElementById('titreTri').value = 'none';

        // Soumettre le formulaire
        document.getElementById('filterForm').submit();
    });
});