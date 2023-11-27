$(document).ready(function() {
    // Créer une liste unique de statuts
    var uniqueStatuts = {};
    $('.membre').each(function() {
        var statut = $(this).data('statut');
        uniqueStatuts[statut] = true;
    });

    // Remplir le sélecteur de statuts
    var statutSelect = $('#statutTri');
    statutSelect.empty();
    statutSelect.append('<option value="none" selected disabled hidden>-- Please choose an option --</option>');
    for (var statut in uniqueStatuts) {
        statutSelect.append('<option value="' + statut + '">' + statut + '</option>');
    }

    // Créer une liste unique de noms
    var uniqueNoms = {};
    $('.membre').each(function() {
        var nom = $(this).data('nom');
        uniqueNoms[nom] = true;
    });

    // Remplir le sélecteur de noms
    var nomSelect = $('#nomTri');
    nomSelect.empty();
    nomSelect.append('<option value="none" selected disabled hidden>-- Please choose an option --</option>');
    for (var nom in uniqueNoms) {
        nomSelect.append('<option value="' + nom + '">' + nom + '</option>');
    }

    // Créer une liste unique de prénoms
    var uniquePrenoms = {};
    $('.membre').each(function() {
        var prenom = $(this).data('prenom');
        uniquePrenoms[prenom] = true;
    });

    // Remplir le sélecteur de prénoms
    var prenomSelect = $('#prenomTri');
    prenomSelect.empty();
    prenomSelect.append('<option value="none" selected disabled hidden>-- Please choose an option --</option>');
    for (var prenom in uniquePrenoms) {
        prenomSelect.append('<option value="' + prenom + '">' + prenom + '</option>');
    }

    // Fonction pour trier les membres par statut
    $('#statutTri').change(function() {
        var selectedStatut = $(this).val();
        console.log('Tri par statut:', selectedStatut);

        // Masquer tous les membres
        $('.membre').hide();

        // Afficher uniquement les membres avec le statut sélectionné
        $('.membre[data-statut="' + selectedStatut + '"]').show();

        // Réinitialiser les autres sélecteurs
        $('#nomTri').val('none');
        $('#prenomTri').val('none');
    });

    // Fonction pour trier les membres par nom
    $('#nomTri').change(function() {
        var selectedNom = $(this).val();
        console.log('Tri par nom:', selectedNom);

        // Masquer tous les membres
        $('.membre').hide();

        // Afficher uniquement les membres avec le nom sélectionné
        $('.membre[data-nom="' + selectedNom + '"]').show();

        // Réinitialiser les autres sélecteurs
        $('#statutTri').val('none');
        $('#prenomTri').val('none');
    });

    // Fonction pour trier les membres par prénom
    $('#prenomTri').change(function() {
        var selectedPrenom = $(this).val();
        console.log('Tri par prénom:', selectedPrenom);

        // Masquer tous les membres
        $('.membre').hide();

        // Afficher uniquement les membres avec le prénom sélectionné
        $('.membre[data-prenom="' + selectedPrenom + '"]').show();

        // Réinitialiser les autres sélecteurs
        $('#statutTri').val('none');
        $('#nomTri').val('none');
    });
});