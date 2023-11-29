document.addEventListener('DOMContentLoaded', function() {
    // Réinitialiser les filtres lorsque le bouton de réinitialisation est cliqué
    document.getElementById('resetFilter').addEventListener('click', function() {
        // Réinitialiser les valeurs des sélecteurs
        document.getElementById('statutTri').value = 'none';
        document.getElementById('nomTri').value = 'none';
        document.getElementById('prenomTri').value = 'none';
       

        // Soumettre le formulaire
        document.getElementById('filterForm').submit();
    });
});